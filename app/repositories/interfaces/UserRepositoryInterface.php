<?php

namespace App\Repositories\Interface;

interface UserRepositoryInterface
{
    public function store($params): int;
    public function fetchAll($condition = null): array;
    public function getByEmail($email): object|bool;
    public function getById($id): object|bool;
}
