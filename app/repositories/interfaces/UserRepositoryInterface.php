<?php

namespace App\Repositories\Interface;

interface UserRepositoryInterface
{
    public function store($params): int;
    public function fetchAll($condition = null): array;
    public function getByEmail($email): object|bool;
    public function getById($id): object|bool;
    public function getByToken($token): object|bool;
    public function update($user): object|bool;
    public function updatePassword($user): object|bool;
    public function sendPasswordReset($reset_token_hash, $reset_token_expires_at, $email): object|bool;
    public function resetPassword($user): object|bool;
}
