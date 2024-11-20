<?php

namespace App\Services;

use App\Repositories\CustomerRepository;

class CustomerService
{
    private $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function store($params): int
    {
        return $this->customerRepository->store($params);
    }

    public function getAllCustomers()
    {
        return $this->customerRepository->fetchAll(null, 'id DESC');
    }

    public function getByEmail($email)
    {
        return $this->customerRepository->getByEmail($email);
    }

    public function getById($id)
    {
        return $this->customerRepository->getById($id);
    }

    public function update($customer): object|bool
    {
        return $this->customerRepository->update($customer);
    }

    public function delete($id): bool
    {
        return $this->customerRepository->delete($id);
    }
}
