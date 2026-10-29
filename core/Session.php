<?php

declare(strict_types=1);

namespace Core;

final class Session
{
    public static function start(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            $lifetime = (int) ($_ENV['SESSION_LIFETIME'] ?? 120) * 60;
            ini_set('session.gc_maxlifetime', (string) $lifetime);
            ini_set('session.use_strict_mode', '1');
            session_set_cookie_params([
                'lifetime' => $lifetime,
                'path'     => '/',
                'secure'   => request_is_https(),
                'httponly' => true,
                'samesite' => 'Lax',
            ]);
            session_start();
        }
    }
}
