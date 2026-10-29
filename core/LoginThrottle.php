<?php

declare(strict_types=1);

namespace Core;

final class LoginThrottle
{
    private const WINDOW_SECONDS = 900;
    private const MAX_PER_IP = 20;
    private const MAX_PER_PAIR = 5;

    /**
     * Reserva un intento de login; devuelve false si la IP o el par usuario+IP agotaron su cupo.
     * Comprobar y registrar ocurre bajo un solo lock para que peticiones paralelas no lo excedan.
     * No hay contador solo por usuario: bloquearía al dueño de la cuenta ante cualquier atacante.
     */
    public static function acquire(?string $ip, string $username): bool
    {
        $allowed = false;

        self::locked(static function (array $store) use ($ip, $username, &$allowed): array {
            $ipKey   = self::key('ip', $ip ?? '-');
            $pairKey = self::key('pair', ($ip ?? '-') . '|' . self::normalize($username));

            $allowed = count($store[$ipKey] ?? []) < self::MAX_PER_IP
                && count($store[$pairKey] ?? []) < self::MAX_PER_PAIR;

            if ($allowed) {
                $store[$ipKey][]   = time();
                $store[$pairKey][] = time();
            }

            return $store;
        });

        return $allowed ?: !self::storeWritable();
    }

    /** Login correcto: devuelve el intento reservado y limpia solo el par; el contador de la IP no se reinicia. */
    public static function release(?string $ip, string $username): void
    {
        self::locked(static function (array $store) use ($ip, $username): array {
            $ipKey = self::key('ip', $ip ?? '-');
            if (!empty($store[$ipKey])) {
                array_pop($store[$ipKey]);
            }
            unset($store[self::key('pair', ($ip ?? '-') . '|' . self::normalize($username))]);

            return $store;
        });
    }

    // Replica el plegado de utf8mb4_general_ci: sin mayúsculas, acentos ni espacios finales.
    private static function normalize(string $username): string
    {
        $value = mb_strtolower(trim($username));

        if (class_exists(\Normalizer::class)) {
            $value = preg_replace('/\p{Mn}/u', '', \Normalizer::normalize($value, \Normalizer::FORM_D) ?: $value) ?? $value;
        } elseif (function_exists('iconv')) {
            $value = @iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $value) ?: $value;
        }

        return $value;
    }

    private static function key(string $scope, string $value): string
    {
        return hash('sha256', $scope . ':' . $value);
    }

    private static function storeWritable(): bool
    {
        return is_writable(dirname(self::path()));
    }

    /** @param callable(array<string, int[]>): array<string, int[]> $mutate */
    private static function locked(callable $mutate): void
    {
        $handle = @fopen(self::path(), 'c+');
        if ($handle === false || !flock($handle, LOCK_EX)) {
            error_log('LoginThrottle: no se pudo abrir storage/logs; el límite de intentos no se aplica.');
            return;
        }

        $decoded = json_decode((string) stream_get_contents($handle), true);
        $limit = time() - self::WINDOW_SECONDS;
        $store = [];
        foreach (is_array($decoded) ? $decoded : [] as $key => $times) {
            $recent = array_values(array_filter((array) $times, static fn($t) => (int) $t > $limit));
            if ($recent !== []) {
                $store[$key] = $recent;
            }
        }

        $store = $mutate($store);

        ftruncate($handle, 0);
        rewind($handle);
        fwrite($handle, json_encode($store));
        fflush($handle);
        flock($handle, LOCK_UN);
        fclose($handle);
    }

    private static function path(): string
    {
        return dirname(__DIR__) . '/storage/logs/login_throttle.json';
    }
}
