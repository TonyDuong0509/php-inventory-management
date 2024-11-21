<?php

namespace App\Models;

use App\Repositories\CategoryRepository;
use App\Repositories\SupplierRepository;
use App\Repositories\UnitRepository;

class Product
{
    private $id;
    private $supplier_id;
    private $unit_id;
    private $category_id;
    private $name;
    private $quantity;
    private $status;
    private $created_by;
    private $updated_by;
    private $created_at;
    private $updated_at;

    public function __construct(
        $id,
        $supplier_id,
        $unit_id,
        $category_id,
        $name,
        $quantity,
        $status,
        $created_by,
        $updated_by,
        $created_at,
        $updated_at
    ) {
        $this->id = $id;
        $this->supplier_id = $supplier_id;
        $this->unit_id = $unit_id;
        $this->category_id = $category_id;
        $this->name = $name;
        $this->quantity = $quantity;
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
     * Get the value of supplier_id
     */
    public function getSupplierId()
    {
        return $this->supplier_id;
    }

    /**
     * Set the value of supplier_id
     */
    public function setSupplierId($supplier_id): self
    {
        $this->supplier_id = $supplier_id;

        return $this;
    }

    /**
     * Get the value of unit_id
     */
    public function getUnitId()
    {
        return $this->unit_id;
    }

    /**
     * Set the value of unit_id
     */
    public function setUnitId($unit_id): self
    {
        $this->unit_id = $unit_id;

        return $this;
    }

    /**
     * Get the value of category_id
     */
    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * Set the value of category_id
     */
    public function setCategoryId($category_id): self
    {
        $this->category_id = $category_id;

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
     * Get the value of quantity
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set the value of quantity
     */
    public function setQuantity($quantity): self
    {
        $this->quantity = $quantity;

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

    public function getSupplier()
    {
        $supplierRepository = new SupplierRepository();
        return $supplierRepository->getById($this->supplier_id);
    }

    public function getUnit()
    {
        $unitRepository = new UnitRepository();
        return $unitRepository->getById($this->unit_id);
    }

    public function getCategory()
    {
        $categoryRepository = new CategoryRepository();
        return $categoryRepository->getById($this->category_id);
    }
}
