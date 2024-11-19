<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function store($params): int
    {
        return $this->userRepository->store($params);
    }

    public function getAllUsers(): array
    {
        return $this->userRepository->fetchAll();
    }

    public function getByEmail($email): object|bool
    {
        return $this->userRepository->getByEmail($email);
    }

    public function getById($id): object|bool
    {
        return $this->userRepository->getById($id);
    }
}
