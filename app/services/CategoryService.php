<?php

namespace App\Services;

use App\Repositories\CategoryRepository;

class CategoryService
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function store($params): int
    {
        return $this->categoryRepository->store($params);
    }

    public function getAllCategories()
    {
        return $this->categoryRepository->fetchAll(null, 'id DESC');
    }

    public function getById($id): object
    {
        return $this->categoryRepository->getById($id);
    }

    public function update($unit): object|bool
    {
        return $this->categoryRepository->update($unit);
    }

    public function delete($id): bool
    {
        return $this->categoryRepository->delete($id);
    }
}
