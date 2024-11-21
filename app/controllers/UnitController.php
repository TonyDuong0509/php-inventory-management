<?php

namespace App\Controllers;

use App\Services\UnitService;
use App\Services\UserService;

use function Utils\Functions\getDateTime;

class UnitController
{
    private $unitService;
    private $userService;

    public function __construct(
        UnitService $unitService,
        UserService $userService
    ) {
        $this->unitService = $unitService;
        $this->userService = $userService;
    }

    public function unitsAll()
    {
        $units = $this->unitService->getAllUnits();

        require ABSPATH . 'resources/unit/allUnits.php';
    }

    public function unitAdd()
    {
        require ABSPATH . 'resources/unit/addUnit.php';
    }

    public function unitStore()
    {
        $id = $_SESSION['user']['id'] ?? '';

        $user = $this->userService->getById($id);

        $name = $_POST['name'] ?? '';
        $created_by = $user->getId();
        $updated_by = $user->getId();
        $created_at = getDateTime();
        $updated_at = getDateTime();

        $params = [
            'name' => $name,
            'created_by' => $created_by,
            'updated_by' => $updated_by,
            'created_at' => $created_at,
            'updated_at' => $updated_at,
        ];

        $result = $this->unitService->store($params);

        if ($result === -1) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Created unit failed'
            ];
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }

        $_SESSION['toastrNotify'] = [
            'alert-type' => 'success',
            'message' => 'Created unit successfully'
        ];
        header("Location: /all-units");
        exit;
    }

    public function unitEdit($id)
    {
        $unit = $this->unitService->getById($id);
        require ABSPATH . 'resources/unit/editUnit.php';
    }

    public function unitUpdate()
    {
        $id = $_SESSION['user']['id'] ?? '';
        $user = $this->userService->getById($id);

        $unitId = $_POST['unitId'];
        $unit = $this->unitService->getById($unitId);

        if (!$unit) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'This unit is not exist, please try again'
            ];
            header("Location: /all-units");
            exit;
        }

        $name = $_POST['name'] ?? '';
        $updated_by = $user->getId();
        $updated_at = getDateTime();

        $unit->setName($name);
        $unit->setUpdatedBy($updated_by);
        $unit->setUpdatedAt($updated_at);

        $result = $this->unitService->update($unit);
        if (!$result) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Updated unit failed'
            ];
            header("Location: /edit-unit/$unitId");
            exit;
        }

        $_SESSION['toastrNotify'] = [
            'alert-type' => 'success',
            'message' => 'Updated unit successfully'
        ];
        header("Location: /edit-unit/$unitId");
        exit;
    }

    public function unitDelete($id)
    {
        $unit = $this->unitService->getById($id);

        if (!$unit) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'This unit is not exist, please try again'
            ];
            header("Location: /all-units");
            exit;
        }

        $result = $this->unitService->delete($id);
        if (!$result) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Deleted unit failed'
            ];
            header("Location: /all-units");
            exit;
        }

        $_SESSION['toastrNotify'] = [
            'alert-type' => 'success',
            'message' => 'Deleted unit successfully'
        ];
        header("Location: /all-units");
        exit;
    }
}
