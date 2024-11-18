<?php

namespace App\Models;

class Supplier
{
    private $id;
    private $name;
    private $mobile_no;
    private $email;
    private $address;
    private $status = 1;
    private $created_by;
    private $updated_by = null;
    private $created_at;
    private $updated_at = null;

    public function __construct($id, $name, $mobile_no, $email, $address, $status, $created_by, $updated_by, $created_at, $updated_at)
    {
        $this->id = $id;
        $this->name = $name;
        $this->mobile_no = $mobile_no;
        $this->email = $email;
        $this->address = $address;
        $this->status = $status;
        $this->created_by = $created_by;
        $this->updated_by = $updated_by;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
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
     * Get the value of mobile_no
     */
    public function getMobileNo()
    {
        return $this->mobile_no;
    }

    /**
     * Set the value of mobile_no
     */
    public function setMobileNo($mobile_no): self
    {
        $this->mobile_no = $mobile_no;

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
     * Get the value of address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set the value of address
     */
    public function setAddress($address): self
    {
        $this->address = $address;

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
     * Get the value of created_by
     */
    public function getCreatedBy()
    {
        return $this->created_by;
    }

    /**
     * Set the value of created_by
     */
    public function setCreatedBy($created_by): self
    {
        $this->created_by = $created_by;

        return $this;
    }

    /**
     * Get the value of updated_by
     */
    public function getUpdatedBy()
    {
        return $this->updated_by;
    }

    /**
     * Set the value of updated_by
     */
    public function setUpdatedBy($updated_by): self
    {
        $this->updated_by = $updated_by;

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
}
