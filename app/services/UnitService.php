<?php

namespace App\Services;

use App\Repositories\UnitRepository;

class UnitService
{
    private $unitRepository;

    public function __construct(UnitRepository $unitRepository)
    {
        $this->unitRepository = $unitRepository;
    }

    public function store($params): int
    {
        return $this->unitRepository->store($params);
    }

    public function getAllUnits(): array
    {
        return $this->unitRepository->fetchAll(null, "id DESC");
    }

    public function getById($id): object
    {
        return $this->unitRepository->getById($id);
    }

    public function update($unit): object|bool
    {
        return $this->unitRepository->update($unit);
    }

    public function delete($id): bool
    {
        return $this->unitRepository->delete($id);
    }
}
