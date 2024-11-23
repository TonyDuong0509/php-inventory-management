<?php

namespace App\Models;

use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Repositories\SupplierRepository;

class Purchase
{
    private $id;
    private $supplier_id;
    private $category_id;
    private $product_id;
    private $purchase_no;
    private $date;
    private $description;
    private $buying_qty;
    private $unit_price;
    private $buying_price;
    private $status;
    private $created_by;
    private $updated_by;
    private $created_at;
    private $updated_at;

    public function __construct(
        $id,
        $supplier_id,
        $category_id,
        $product_id,
        $purchase_no,
        $date,
        $description,
        $buying_qty,
        $unit_price,
        $buying_price,
        $status,
        $created_by,
        $updated_by,
        $created_at,
        $updated_at
    ) {
        $this->id = $id;
        $this->supplier_id = $supplier_id;
        $this->category_id = $category_id;
        $this->product_id = $product_id;
        $this->purchase_no = $purchase_no;
        $this->date = $date;
        $this->description = $description;
        $this->buying_qty = $buying_qty;
        $this->unit_price = $unit_price;
        $this->buying_price = $buying_price;
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
     * Get the value of product_id
     */
    public function getProductId()
    {
        return $this->product_id;
    }

    /**
     * Set the value of product_id
     */
    public function setProductId($product_id): self
    {
        $this->product_id = $product_id;

        return $this;
    }

    /**
     * Get the value of purchase_no
     */
    public function getPurchaseNo()
    {
        return $this->purchase_no;
    }

    /**
     * Set the value of purchase_no
     */
    public function setPurchaseNo($purchase_no): self
    {
        $this->purchase_no = $purchase_no;

        return $this;
    }

    /**
     * Get the value of date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     */
    public function setDate($date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     */
    public function setDescription($description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of buying_qty
     */
    public function getBuyingQty()
    {
        return $this->buying_qty;
    }

    /**
     * Set the value of buying_qty
     */
    public function setBuyingQty($buying_qty): self
    {
        $this->buying_qty = $buying_qty;

        return $this;
    }

    /**
     * Get the value of unit_price
     */
    public function getUnitPrice()
    {
        return $this->unit_price;
    }

    /**
     * Set the value of unit_price
     */
    public function setUnitPrice($unit_price): self
    {
        $this->unit_price = $unit_price;

        return $this;
    }

    /**
     * Get the value of buying_price
     */
    public function getBuyingPrice()
    {
        return $this->buying_price;
    }

    /**
     * Set the value of buying_price
     */
    public function setBuyingPrice($buying_price): self
    {
        $this->buying_price = $buying_price;

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

    public function getCategory()
    {
        $categoryRepository = new CategoryRepository();
        return $categoryRepository->getById($this->category_id);
    }

    public function getProduct()
    {
        $productRepository = new ProductRepository();
        return $productRepository->getById($this->product_id);
    }
}
