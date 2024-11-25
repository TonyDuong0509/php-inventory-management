<?php

namespace App\Models;

class PaymentDetails
{
    private $id;
    private $invoice_id;
    private $current_paid_amount;
    private $date;
    private $updated_by;
    private $created_at;
    private $updated_at;

    public function __construct($id, $invoice_id, $current_paid_amount, $date, $updated_by, $created_at, $updated_at)
    {
        $this->id = $id;
        $this->invoice_id = $invoice_id;
        $this->current_paid_amount = $current_paid_amount;
        $this->date = $date;
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
     * Get the value of current_paid_amount
     */
    public function getCurrentPaidAmount()
    {
        return $this->current_paid_amount;
    }

    /**
     * Set the value of current_paid_amount
     */
    public function setCurrentPaidAmount($current_paid_amount): self
    {
        $this->current_paid_amount = $current_paid_amount;

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
