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

    public function update($user): object|bool
    {
        return $this->userRepository->update($user);
    }

    public function updatePassword($user): object|bool
    {
        return $this->userRepository->updatePassword($user);
    }

    public function sendPasswordReset($reset_token_hash, $reset_token_expires_at, $email): object|bool
    {
        return $this->userRepository->sendPasswordReset($reset_token_hash, $reset_token_expires_at, $email);
    }

    public function getByToken($token): object|bool
    {
        return $this->userRepository->getByToken($token);
    }

    public function resetPassword($user): object|bool
    {
        return $this->userRepository->resetPassword($user);
    }
}
