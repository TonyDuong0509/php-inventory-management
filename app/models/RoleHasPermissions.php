<?php

namespace App\Models;

class RoleHasPermissions
{
    protected $role_id;
    protected $permission_id;

    public function __construct($role_id, $permission_id)
    {
        $this->role_id = $role_id;
        $this->permission_id = $permission_id;
    }

    /**
     * Get the value of role_id
     */
    public function getRoleId()
    {
        return $this->role_id;
    }

    /**
     * Set the value of role_id
     */
    public function setRoleId($role_id): self
    {
        $this->role_id = $role_id;

        return $this;
    }

    /**
     * Get the value of permission_id
     */
    public function getPermissionId()
    {
        return $this->permission_id;
    }

    /**
     * Set the value of permission_id
     */
    public function setPermissionId($permission_id): self
    {
        $this->permission_id = $permission_id;

        return $this;
    }
}
