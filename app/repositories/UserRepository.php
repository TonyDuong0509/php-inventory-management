<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interface\UserRepositoryInterface;
use Exception;

class UserRepository implements UserRepositoryInterface
{
    public function store($params): int
    {
        global $mysqli;

        try {
            $fullName = $mysqli->real_escape_string($params['fullName']);
            $email = $mysqli->real_escape_string($params['email']);
            $password = $mysqli->real_escape_string($params['password']);
            $phone = $mysqli->real_escape_string($params['phone']);
            $role = $mysqli->real_escape_string($params['role']);
            $created_at = $params['created_at'];
            $updated_at = $params['updated_at'];
            $status = $params['status'];
            $account_activation_hash = $params['account_activation_hash'];

            $sql = "INSERT INTO users (fullName, email, password, phone, role, created_at, updated_at, status, account_activation_hash)
                    VALUES ('$fullName', '$email', '$password', '$phone', '$role', '$created_at', '$updated_at', '$status', '$account_activation_hash')";

            if ($mysqli->query($sql) === true) {
                return $mysqli->insert_id;
            }
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function fetchAll($condition = null): array
    {
        global $mysqli;

        try {
            $users = [];
            $sql = "SELECT * FROM users";

            if ($condition) {
                $sql .= " WHERE $condition";
            }

            $result = $mysqli->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $user = new User(
                        $row['id'],
                        $row['fullName'],
                        $row['email'],
                        $row['password'],
                        $row['phone'],
                        $row['role'],
                        $row['created_at'],
                        $row['updated_at'],
                        $row['status'],
                        $row['avatar'],
                        $row['reset_token_hash'],
                        $row['reset_token_expires_at'],
                        $row['account_activation_hash']
                    );

                    $users[] = $user;
                }
            }

            return $users;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function getByEmail($email): object|bool
    {
        try {
            $condition = "email = '$email'";
            $users = $this->fetchAll($condition);
            return current($users);
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function getById($id): object|bool
    {
        try {
            $condition = "id = '$id'";
            $users = $this->fetchAll($condition);
            return current($users);
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function getByToken($token): object|bool
    {
        try {
            $condition = "reset_token_hash = '$token'";
            $users = $this->fetchAll($condition);
            return current($users);
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function getByActiveToken($token): object|bool
    {
        try {
            $condition = "account_activation_hash = '$token'";
            $users = $this->fetchAll($condition);
            return current($users);
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function update($user): object|bool
    {
        try {
            global $mysqli;

            $id = $user->getId();
            $fullName = $user->getFullName();
            $phone = $user->getPhone();
            $avatar = $user->getAvatar();
            $updated_at = $user->getUpdatedAt();
            $sql = "UPDATE users
                    SET fullName = '$fullName', phone = '$phone', avatar = '$avatar', updated_at = '$updated_at'
                    WHERE id = '$id'";
            if ($mysqli->query($sql) === true) return true;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function updatePassword($user): object|bool
    {
        try {
            global $mysqli;

            $id = $user->getId();
            $password = $user->getPassword();
            $sql = "UPDATE users
                    SET password = '$password'
                    WHERE id = '$id'";
            if ($mysqli->query($sql) === true) return true;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function sendPasswordReset($reset_token_hash, $reset_token_expires_at, $email): object|bool
    {
        try {
            global $mysqli;

            $sql = "UPDATE users
                    SET reset_token_hash = '$reset_token_hash', reset_token_expires_at = '$reset_token_expires_at'
                    WHERE email = '$email'";
            if ($mysqli->query($sql) === true) return true;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function resetPassword($user): object|bool
    {
        try {
            global $mysqli;

            $id = $user->getId();
            $password = $user->getPassword();
            $sql = "UPDATE users
                    SET password = '$password', reset_token_hash = NULL, reset_token_expires_at = NULL
                    WHERE id = '$id'";
            if ($mysqli->query($sql) === true) return true;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function activeAccount($id): object|bool
    {
        try {
            global $mysqli;

            $sql = "UPDATE users
                    SET account_activation_hash = null
                    WHERE id = '$id'";
            if ($mysqli->query($sql) === true) return true;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }
}
