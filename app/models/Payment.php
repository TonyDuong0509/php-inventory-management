<?php

namespace App\Models;

use App\Repositories\CustomerRepository;

class Payment
{
    private $id;
    private $invoice_id;
    private $customer_id;
    private $paid_status;
    private $paid_amount;
    private $due_amount;
    private $total_amount;
    private $discount_amount;
    private $created_at;
    private $updated_at;

    public function __construct(
        $id,
        $invoice_id,
        $customer_id,
        $paid_status,
        $paid_amount,
        $due_amount,
        $total_amount,
        $discount_amount,
        $created_at,
        $updated_at
    ) {
        $this->id = $id;
        $this->invoice_id = $invoice_id;
        $this->customer_id = $customer_id;
        $this->paid_status = $paid_status;
        $this->paid_amount = $paid_amount;
        $this->due_amount = $due_amount;
        $this->total_amount = $total_amount;
        $this->discount_amount = $discount_amount;
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
     * Get the value of customer_id
     */
    public function getCustomerId()
    {
        return $this->customer_id;
    }

    /**
     * Set the value of customer_id
     */
    public function setCustomerId($customer_id): self
    {
        $this->customer_id = $customer_id;

        return $this;
    }

    /**
     * Get the value of paid_status
     */
    public function getPaidStatus()
    {
        return $this->paid_status;
    }

    /**
     * Set the value of paid_status
     */
    public function setPaidStatus($paid_status): self
    {
        $this->paid_status = $paid_status;

        return $this;
    }

    /**
     * Get the value of paid_amount
     */
    public function getPaidAmount()
    {
        return $this->paid_amount;
    }

    /**
     * Set the value of paid_amount
     */
    public function setPaidAmount($paid_amount): self
    {
        $this->paid_amount = $paid_amount;

        return $this;
    }

    /**
     * Get the value of due_amount
     */
    public function getDueAmount()
    {
        return $this->due_amount;
    }

    /**
     * Set the value of due_amount
     */
    public function setDueAmount($due_amount): self
    {
        $this->due_amount = $due_amount;

        return $this;
    }

    /**
     * Get the value of total_amount
     */
    public function getTotalAmount()
    {
        return $this->total_amount;
    }

    /**
     * Set the value of total_amount
     */
    public function setTotalAmount($total_amount): self
    {
        $this->total_amount = $total_amount;

        return $this;
    }

    /**
     * Get the value of discount_amount
     */
    public function getDiscountAmount()
    {
        return $this->discount_amount;
    }

    /**
     * Set the value of discount_amount
     */
    public function setDiscountAmount($discount_amount): self
    {
        $this->discount_amount = $discount_amount;

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

    public function getCustomer()
    {
        $customerRepository = new CustomerRepository();
        return $customerRepository->getById($this->customer_id);
    }
}
