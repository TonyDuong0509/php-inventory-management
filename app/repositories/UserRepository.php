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
            if (!isset($params['fullName'], $params['email'], $params['password'], $params['phone'], $params['role'])) {
                throw new Exception('Missing required fields');
            }

            $fullName = $mysqli->real_escape_string($params['fullName']);
            $email = $mysqli->real_escape_string($params['email']);
            $password = $mysqli->real_escape_string($params['password']);
            $phone = $mysqli->real_escape_string($params['phone']);
            $role = $mysqli->real_escape_string($params['role']);
            $created_at = $params['created_at'];
            $updated_at = $params['updated_at'];
            $status = $params['status'];

            $sql = "INSERT INTO users (fullName, email, password, phone, role, created_at, updated_at, status)
                    VALUES ('$fullName', '$email', '$password', '$phone', '$role', '$created_at', '$updated_at', '$status')";

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
                        $row['updated_at']
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
}
