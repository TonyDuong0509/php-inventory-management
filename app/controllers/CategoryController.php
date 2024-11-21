<?php

namespace App\Controllers;

use App\Services\CategoryService;
use App\Services\UserService;

use function Utils\Functions\getDateTime;

class CategoryController
{
    private $categoryService;
    private $userService;

    public function __construct(
        CategoryService $categoryService,
        UserService $userService
    ) {
        $this->categoryService = $categoryService;
        $this->userService = $userService;
    }

    public function categoriesAll()
    {
        $categories = $this->categoryService->getAllCategories();

        require ABSPATH . 'resources/category/allCategories.php';
    }

    public function categoryAdd()
    {
        require ABSPATH . 'resources/category/addCategory.php';
    }

    public function categoryStore()
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

        $result = $this->categoryService->store($params);

        if ($result === -1) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Created category failed'
            ];
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }

        $_SESSION['toastrNotify'] = [
            'alert-type' => 'success',
            'message' => 'Created category successfully'
        ];
        header("Location: /all-categories");
        exit;
    }

    public function categoryEdit($id)
    {
        $category = $this->categoryService->getById($id);
        require ABSPATH . 'resources/category/editCategory.php';
    }

    public function categoryUpdate()
    {
        $id = $_SESSION['user']['id'] ?? '';
        $user = $this->userService->getById($id);

        $categoryId = $_POST['categoryId'];
        $category = $this->categoryService->getById($categoryId);

        if (!$category) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'This category is not exist, please try again'
            ];
            header("Location: /all-categories");
            exit;
        }

        $name = $_POST['name'] ?? '';
        $updated_by = $user->getId();
        $updated_at = getDateTime();

        $category->setName($name);
        $category->setUpdatedBy($updated_by);
        $category->setUpdatedAt($updated_at);

        $result = $this->categoryService->update($category);
        if (!$result) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Updated category failed'
            ];
            header("Location: /edit-category/$categoryId");
            exit;
        }

        $_SESSION['toastrNotify'] = [
            'alert-type' => 'success',
            'message' => 'Updated category successfully'
        ];
        header("Location: /edit-category/$categoryId");
        exit;
    }

    public function categoryDelete($id)
    {
        $category = $this->categoryService->getById($id);

        if (!$category) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'This category is not exist, please try again'
            ];
            header("Location: /all-categories");
            exit;
        }

        $result = $this->categoryService->delete($id);
        if (!$result) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Deleted category failed'
            ];
            header("Location: /all-categories");
            exit;
        }

        $_SESSION['toastrNotify'] = [
            'alert-type' => 'success',
            'message' => 'Deleted category successfully'
        ];
        header("Location: /all-categories");
        exit;
    }
}
