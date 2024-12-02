<?php

namespace App\Models;

class User
{
    private $id;
    private $fullName;
    private $email;
    private $password;
    private $phone;
    private $role;
    private $created_at;
    private $updated_at;
    private $status;
    private $avatar;
    private $reset_token_hash;
    private $reset_token_expires_at;
    private $account_activation_hash;

    public function __construct($id, $fullName, $email, $password, $phone, $role, $created_at, $updated_at, $status, $avatar, $reset_token_hash, $reset_token_expires_at, $account_activation_hash)
    {
        $this->id = $id;
        $this->fullName = $fullName;
        $this->email = $email;
        $this->password = $password;
        $this->phone = $phone;
        $this->role = $role;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        $this->status = $status;
        $this->avatar = $avatar;
        $this->reset_token_hash = $reset_token_hash;
        $this->reset_token_expires_at = $reset_token_expires_at;
        $this->account_activation_hash = $account_activation_hash;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of fullName
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * Set the value of fullName
     */
    public function setFullName($fullName): self
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     */
    public function setEmail($email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     */
    public function setPassword($password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of phone
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set the value of phone
     */
    public function setPhone($phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get the value of role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     */
    public function setRole($role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get the value of created_at
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     */
    public function setCreatedAt($created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of updated_at
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set the value of updated_at
     */
    public function setUpdatedAt($updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     */
    public function setStatus($status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of avatar
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Set the value of avatar
     */
    public function setAvatar($avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get the value of reset_token_hash
     */
    public function getResetTokenHash()
    {
        return $this->reset_token_hash;
    }

    /**
     * Set the value of reset_token_hash
     */
    public function setResetTokenHash($reset_token_hash): self
    {
        $this->reset_token_hash = $reset_token_hash;

        return $this;
    }

    /**
     * Get the value of reset_token_expires_at
     */
    public function getResetTokenExpiresAt()
    {
        return $this->reset_token_expires_at;
    }

    /**
     * Set the value of reset_token_expires_at
     */
    public function setResetTokenExpiresAt($reset_token_expires_at): self
    {
        $this->reset_token_expires_at = $reset_token_expires_at;

        return $this;
    }

    /**
     * Get the value of account_activation_hash
     */
    public function getAccountActivationHash()
    {
        return $this->account_activation_hash;
    }

    /**
     * Set the value of account_activation_hash
     */
    public function setAccountActivationHash($account_activation_hash): self
    {
        $this->account_activation_hash = $account_activation_hash;

        return $this;
    }
}
