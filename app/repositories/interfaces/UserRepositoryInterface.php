<?php

namespace App\Repositories\Interface;

interface UserRepositoryInterface
{
    public function store($params): int;
    public function fetchAll($condition = null): array;
    public function getByEmail($email): object|bool;
    public function getById($id): object|bool;
    public function update($user): object|bool;
    public function updatePassword($user): object|bool;
}
