<?php

namespace App\Models;

class InvoiceDetails
{
    private $id;
    private $date;
    private $invoice_id;
    private $category_id;
    private $product_id;
    private $selling_qty;
    private $unit_price;
    private $selling_price;
    private $status;
    private $created_at;
    private $updated_at;

    public function __construct(
        $id,
        $date,
        $invoice_id,
        $category_id,
        $product_id,
        $selling_qty,
        $unit_price,
        $selling_price,
        $status,
        $created_at,
        $updated_at
    ) {
        $this->id = $id;
        $this->date = $date;
        $this->invoice_id = $invoice_id;
        $this->category_id = $category_id;
        $this->product_id = $product_id;
        $this->selling_qty = $selling_qty;
        $this->unit_price = $unit_price;
        $this->selling_price = $selling_price;
        $this->status = $status;
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
     * Get the value of invoice_id
     */
    public function getInvoiceId()
    {
        return $this->invoice_id;
    }

    /**
     * Set the value of invoice_id
     */
    public function setInvoiceId($invoice_id): self
    {
        $this->invoice_id = $invoice_id;

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
     * Get the value of selling_qty
     */
    public function getSellingQty()
    {
        return $this->selling_qty;
    }

    /**
     * Set the value of selling_qty
     */
    public function setSellingQty($selling_qty): self
    {
        $this->selling_qty = $selling_qty;

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
     * Get the value of selling_price
     */
    public function getSellingPrice()
    {
        return $this->selling_price;
    }

    /**
     * Set the value of selling_price
     */
    public function setSellingPrice($selling_price): self
    {
        $this->selling_price = $selling_price;

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
