<?php

declare(strict_types=1);

namespace App\Application\Contracts;

interface AuthServiceInterface
{
    public function attempt(string $username, string $password): ?array;

    /** @return array{Usuario: string, Nombres: string, is_admin: bool, clave_ver: string}|null */
    public function findSessionUser(int $userId): ?array;

    public function accountExists(string $username): bool;

    public function issueRememberToken(int $userId): string;

    /** @return array{user: array<string,mixed>, newPlainToken: string, expiresAt: string}|null */
    public function consumeRememberToken(string $plainToken): ?array;

    public function clearRememberToken(int $userId): void;
}
