<?php

declare(strict_types=1);

namespace App\Presentation\Http;

final class Request implements IpProviderInterface
{
    public function isAjax(): bool
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH'])
            && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }

    public function method(): string
    {
        return strtoupper((string) ($_SERVER['REQUEST_METHOD'] ?? 'GET'));
    }

    public function post(string $key, mixed $default = null): mixed
    {
        return $_POST[$key] ?? $default;
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $_GET[$key] ?? $default;
    }

    public function ip(): ?string
    {
        $addr = $_SERVER['REMOTE_ADDR'] ?? null;

        // Con un único proxy de confianza, la última entrada de X-Forwarded-For es la que él añadió.
        if (filter_var($_ENV['TRUST_PROXY'] ?? false, FILTER_VALIDATE_BOOLEAN) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $hops = array_map('trim', explode(',', (string) $_SERVER['HTTP_X_FORWARDED_FOR']));
            $client = end($hops);
            if (filter_var($client, FILTER_VALIDATE_IP) !== false) {
                return $client;
            }
        }

        return $addr !== '' ? $addr : null;
    }
}
