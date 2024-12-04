<?php

namespace App\Models;

class Permissions
{
    protected $id;
    protected $name;
    protected $guard_name;

    public function __construct($id, $name, $guard_name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->guard_name = $guard_name;
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
     * Get the value of guard_name
     */
    public function getGuardName()
    {
        return $this->guard_name;
    }

    /**
     * Set the value of guard_name
     */
    public function setGuardName($guard_name): self
    {
        $this->guard_name = $guard_name;

        return $this;
    }
}
