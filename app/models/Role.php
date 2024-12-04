<?php

namespace App\Models;

use App\Repositories\PermissionsRepository;

class Role
{
    private $id;
    private $name;
    private $permissions = [];

    public function __construct($id, $name, $permissions = '')
    {
        $this->id = $id;
        $this->name = $name;
        $this->permissions = explode(',', $permissions);
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
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     */
    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of permissions
     */


    public function getPermissions()
    {
        return $this->permissions;
    }

    public function getPermissionName()
    {
        $permissions = $this->permissions;
        $data = [];
        for ($i = 0; $i < count($permissions); $i++) {
            $permissionsRepository = new PermissionsRepository();
            $obj = $permissionsRepository->getById($permissions[$i]->getPermissionId());
            $data[] = $obj;
        }
        return $data;
    }

    /**
     * Set the value of 
     */
    public function setPermissions($permissions): self
    {
        $this->permissions = $permissions;

        return $this;
    }

    public function hasPermissionTo($permissionName)
    {
        if (empty($this->getPermissionName())) {
            echo "Permissions array is empty or not initialized";
            return false;
        }

        foreach ($this->getPermissionName() as $permission) {
            if ($permission->getName() !== null && $permission->getName() === $permissionName) {
                return true;
            }
        }
        return false;
    }
}
