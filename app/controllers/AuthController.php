<?php

namespace App\Controllers;

use App\Services\PermissionsService;
use App\Services\RoleHasPermissionsService;
use App\Services\RoleService;
use App\Services\UserService;
use Exception;

use function Utils\Functions\getDateTime;
use function Utils\Functions\mailer;

class AuthController
{
    private $userService;
    private $permissionsService;
    private $roleService;
    private $roleHasPermissionsService;

    public function __construct(
        UserService $userService,
        PermissionsService $permissionsService,
        RoleService $roleService,
        RoleHasPermissionsService $roleHasPermissionsService,
    ) {
        $this->userService = $userService;
        $this->permissionsService = $permissionsService;
        $this->roleService = $roleService;
        $this->roleHasPermissionsService = $roleHasPermissionsService;
    }

    public function registerForm()
    {
        require ABSPATH . 'resources/auth/registerForm.php';
    }

    public function register()
    {
        $fullName = $_POST['fullName'] ?? '';
        $email = $_POST['email'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $password = $_POST['password'] ?? '';
        $role = "Employee";
        $status = 0;

        $this->userService->getAllUsers() ? $role = $role : $role = "Admin";
        if ($role === 'Admin') $status = 1;


        if ($this->userService->getByEmail($email)) {
            $_SESSION['formData'] = [
                'fullName' => $fullName,
                'email' => $email,
                'phone' => $phone,
            ];

            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'This email already exist, please try another email'
            ];

            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }

        $activation_token = bin2hex(random_bytes(16));
        $activation_token_hash = hash('sha256', $activation_token);

        $params = [
            'fullName' => $fullName,
            'email' => $email,
            'phone' => $phone,
            'password' => password_hash($password, PASSWORD_BCRYPT),
            'role' => $role,
            'created_at' => getDateTime(),
            'updated_at' => getDateTime(),
            'status' => $status,
            'account_activation_hash' => $activation_token_hash
        ];

        $this->userService->store($params);

        $mail = mailer();

        $mail->setFrom("duonganhhao4751@gmail.com");
        $mail->addAddress($email);
        $mail->Subject = "Activation Account";
        $mail->Body = <<<END
        Click <a href="http://inventory.com/active-account?active-token=$activation_token">here</a> to activate your account
        END;

        try {
            $mail->send();
        } catch (Exception $error) {
            echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
        }

        $_SESSION['toastrNotify'] = [
            'alert-type' => 'success',
            'message' => 'Sign up successfully'
        ];

        header("Location: /active-account-page");
        exit;
    }

    public function activeAccount()
    {
        $active_token = $_GET['active-token'];
        $active_token_hash = hash('sha256', $active_token);

        $user = $this->userService->getByActiveToken($active_token_hash);
        if ($user === null) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Token not found'
            ];
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }
        $this->userService->activeAccount($user->getId());

        $_SESSION['toastrNotify'] = [
            'alert-type' => 'success',
            'message' => 'Actived account, you can log in'
        ];

        header("Location: /login-form");
        exit;
    }

    public function loginForm()
    {
        require ABSPATH . 'resources/auth/loginForm.php';
    }

    public function login()
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = $this->userService->getByEmail($email);

        if (!$user) {
            $_SESSION['formData'] = [
                'email' => $email,
            ];

            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Email is not exist, please try again or register new account'
            ];

            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }

        if ($user->getAccountActivationHash() !== null) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Your account is inactive, please check your email to active !'
            ];

            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }

        if (!password_verify($password, $user->getPassword())) {
            $_SESSION['formData'] = [
                'email' => $email,
            ];

            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Password incorrect, please try again'
            ];

            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }

        $_SESSION['user'] = [
            'id' => $user->getId(),
            'fullName' => $user->getFullName(),
            'email' => $user->getEmail(),
            'role' => $user->getRole(),
        ];

        $_SESSION['toastrNotify'] = [
            'alert-type' => 'success',
            'message' => 'Login successfully'
        ];

        header("Location: /");
        exit;
    }

    public function logout()
    {
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'success',
                'message' => 'Logout successfully'
            ];
        }

        header("Location: /login-form");
        exit;
    }

    public function forgotPasswordPage()
    {
        require ABSPATH . 'resources/auth/forgot-password.php';
    }

    public function confirmEmailPage()
    {
        require ABSPATH . 'resources/auth/confirmEmailPage.php';
    }


    public function activeAccountPage()
    {
        require ABSPATH . 'resources/auth/activeAccountPage.php';
    }

    public function sendPasswordReset()
    {
        $email = $_POST['email'];

        if (!$this->userService->getByEmail($email)) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Email is not exist, please try again'
            ];
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }

        $token = bin2hex(random_bytes(16));
        $token_hash = hash('sha256', $token);
        $expiry = date('Y-m-d H:i:s', time() + 60 * 30);

        $this->userService->sendPasswordReset($token_hash, $expiry, $email);

        $mail = mailer();

        $mail->setFrom("duonganhhao4751@gmail.com");
        $mail->addAddress($email);
        $mail->Subject = "Password Reset";
        $mail->Body = <<<END
        Click <a href="http://inventory.com/reset-password?token=$token">here</a> to reset your password
        END;

        try {
            $mail->send();
        } catch (Exception $error) {
            echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
        }

        header("Location: /confirm-email-page");
        exit;
    }

    public function resetPasswordPage()
    {
        $token = $_GET['token'];
        $token_hash = hash('sha256', $token);

        $user = $this->userService->getByToken($token_hash);
        if ($user === null) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Token not found'
            ];
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }

        if (strtotime($user->getResetTokenExpiresAt() <= time())) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Token is valid and has not expired'
            ];
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }
        require ABSPATH . 'resources/auth/resetPasswordPage.php';
    }

    public function resetPassword()
    {
        $token = $_POST['token'];
        $token_hash = hash('sha256', $token);

        $user = $this->userService->getByToken($token_hash);
        if ($user === null) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Token not found'
            ];
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }

        if (strtotime($user->getResetTokenExpiresAt() <= time())) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Token is valid and has not expired'
            ];
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }

        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $user->setPassword($password);

        $result = $this->userService->resetPassword($user);

        if (!$result) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Reset password failed, please try again'
            ];
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }

        $_SESSION['toastrNotify'] = [
            'alert-type' => 'success',
            'message' => 'Reseted Password successfully, you can login'
        ];
        header("Location: /login-form");
        exit;
    }

    public function allPermissions()
    {
        $userId = $_SESSION['user']['id'];
        $user = $this->userService->getById($userId);

        $permissions = $this->permissionsService->getAllPermissions();

        require ABSPATH . 'resources/permission/allPermissions.php';
    }

    public function addPermission()
    {
        $userId = $_SESSION['user']['id'];
        $user = $this->userService->getById($userId);

        require ABSPATH . 'resources/permission/addPermission.php';
    }

    public function storePermission()
    {
        $name = $_POST['name'];
        $guard_name = $_POST['guard_name'];

        $params = [
            'name' => $name,
            'guard_name' => $guard_name
        ];

        $result = $this->permissionsService->store($params);

        if (!$result) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Create permission failed'
            ];
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }

        $_SESSION['toastrNotify'] = [
            'alert-type' => 'success',
            'message' => 'Created permission successfully'
        ];
        header("Location: /all-permissions");
        exit;
    }

    public function editPermission($id)
    {
        $userId = $_SESSION['user']['id'];
        $user = $this->userService->getById($userId);
        $permission = $this->permissionsService->getById($id);

        require ABSPATH . 'resources/permission/editPermission.php';
    }

    public function updatePermission()
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $guard_name = $_POST['guard_name'];

        $permission = $this->permissionsService->getById($id);
        $permission->setName($name);
        $permission->setGuardName($guard_name);

        $result = $this->permissionsService->update($permission);

        if (!$result) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Update permission failed'
            ];
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }

        $_SESSION['toastrNotify'] = [
            'alert-type' => 'success',
            'message' => 'Updated permission successfully'
        ];
        header("Location: /all-permissions");
        exit;
    }

    public function deletePermission($id)
    {
        $result = $this->permissionsService->delete($id);

        if (!$result) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Delete permission failed'
            ];
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }

        $_SESSION['toastrNotify'] = [
            'alert-type' => 'success',
            'message' => 'Deleted permission successfully'
        ];
        header("Location: /all-permissions");
        exit;
    }

    public function allRoles()
    {
        $userId = $_SESSION['user']['id'];
        $user = $this->userService->getById($userId);

        $roles = $this->roleService->getAllRoles();

        $this->roleHasPermissionsService->checkPermission('Role', $user->getRolePermission()->getId());

        require ABSPATH . 'resources/role/allRoles.php';
    }

    public function addRole()
    {
        $userId = $_SESSION['user']['id'];
        $user = $this->userService->getById($userId);

        $this->roleHasPermissionsService->checkPermission('Role', $user->getRolePermission()->getId());

        require ABSPATH . 'resources/role/addRole.php';
    }

    public function storeRole()
    {
        $name = $_POST['name'] ?? '';

        $params = [
            'name' => $name,
            'permissions' => []
        ];

        $result = $this->roleService->store($params);

        if (!$result) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Create role failed'
            ];
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }

        $_SESSION['toastrNotify'] = [
            'alert-type' => 'success',
            'message' => 'Created role successfully'
        ];
        header("Location: /all-roles");
        exit;
    }

    public function editRole($id)
    {
        $userId = $_SESSION['user']['id'];
        $user = $this->userService->getById($userId);
        $role = $this->roleService->getById($id);

        require ABSPATH . 'resources/role/editRole.php';
    }

    public function updateRole()
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $permissions = [];

        $role = $this->roleService->getById($id);
        $role->setName($name);

        $result = $this->roleService->update($role);

        if (!$result) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Update role failed'
            ];
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }

        $_SESSION['toastrNotify'] = [
            'alert-type' => 'success',
            'message' => 'Updated role successfully'
        ];
        header("Location: /all-roles");
        exit;
    }

    public function deleteRole($id)
    {
        $result = $this->roleService->delete($id);

        if (!$result) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => 'Delete role failed'
            ];
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }

        $_SESSION['toastrNotify'] = [
            'alert-type' => 'success',
            'message' => 'Deleted role successfully'
        ];
        header("Location: /all-roles");
        exit;
    }

    public function addRolePermissions()
    {
        $userId = $_SESSION['user']['id'];
        $user = $this->userService->getById($userId);

        $roles = $this->roleService->getAllRoles();
        $permissions = $this->permissionsService->getAllPermissions();
        $permissions_groups = $this->permissionsService->getAllGuardName();

        $permissions_groups_byName = [];
        foreach ($permissions_groups as $group) {
            $guard_name = $group['guard_name'];
            $permissions = $this->permissionsService->getByGuardName($guard_name);
            $permissions_groups_byName[$guard_name] = $permissions;
        }

        require ABSPATH . 'resources/rolePermissions/addRolePermissions.php';
    }

    public function rolePermissionsStore()
    {
        $data = [];
        $permissions = $_POST['permission'] ?? [];
        foreach ($permissions as $key => $permission) {
            $data['role_id'] = $_POST['role_id'];
            $data['permission_id'][] = $permission;
        }

        $role = $this->roleService->getById($_POST['role_id']);
        if (!$role) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => "Role not found"
            ];
            header("Location: "  . $_SERVER['HTTP_REFERER']);
            exit;
        }
        $role->setPermissions($permissions);
        $this->roleService->updatePermissions($role);

        $result = $this->roleHasPermissionsService->store($data);

        if (!$result) {
            $_SESSION['toastrNotify'] = [
                'alert-type' => 'error',
                'message' => "Role Permissions Add failed"
            ];
            header("Location: "  . $_SERVER['HTTP_REFERER']);
            exit;
        }

        $_SESSION['toastrNotify'] = [
            'alert-type' => 'success',
            'message' => "Role Permissions Added successfully"
        ];
        header("Location: /all-role-permissions");
        exit;
    }

    public function allRolePermissions()
    {
        $userId = $_SESSION['user']['id'];
        $user = $this->userService->getById($userId);

        $roles = $this->roleService->getAllRoles();
        foreach ($roles as $role) {
            $permissions = $this->roleHasPermissionsService->getPermissionsByRoleId($role->getId());
            $role->setPermissions($permissions);
        }

        require ABSPATH . 'resources/rolePermissions/allRolePermissions.php';
    }

    public static function roleHasPermissions($role, $permissions)
    {
        $hasPermission = true;
        foreach ($permissions as $permission) {
            if (!$role->hasPermissionTo($permission->getPermissionId())) {
                $hasPermission = false;
            }
        }
        return $hasPermission;
    }

    public function editRolePermissions($id)
    {
        $userId = $_SESSION['user']['id'];
        $user = $this->userService->getById($userId);

        $role = $this->roleService->getById($id);
        $permissionsAll = $this->permissionsService->getAllPermissions();
        $permissions_groups = $this->permissionsService->getAllGuardName();

        $rolePermissions = $this->roleHasPermissionsService->getPermissionsByRoleId($id);
        $role->setPermissions($rolePermissions);

        $permissions_groups_byName = [];
        foreach ($permissions_groups as $group) {
            $guard_name = $group['guard_name'];
            $permissions = $this->permissionsService->getByGuardName($guard_name);
            $permissions_groups_byName[$guard_name] = $permissions;
        }

        $checkRoleHasPermissions = $this->roleHasPermissions($role, $rolePermissions);

        require ABSPATH . 'resources/rolePermissions/editRolePermissions.php';
    }

    private function syncPermissions($roleId, $newPermissions)
    {
        $currentPermissions = $this->roleHasPermissionsService->getPermissionsByRoleId($roleId);
        $currentPermissions = array_map(function ($permission) {
            return $permission->getPermissionId();
        }, $currentPermissions);

        $permissionsToAdd = array_diff($newPermissions, $currentPermissions);
        $permissionsToRemove = array_diff($currentPermissions, $newPermissions);

        if (!empty($permissionsToAdd)) {
            $this->roleHasPermissionsService->store([
                'role_id' => $roleId,
                'permission_id' => $permissionsToAdd
            ]);
        }

        if (!empty($permissionsToRemove)) {
            $this->roleHasPermissionsService->removePermissions($roleId, $permissionsToRemove);
        }
    }

    public function updateRolePermissions($id)
    {
        $role = $this->roleService->getById($id);
        $permissions = $_POST['permission'] ?? [];

        if (!empty($permissions)) {
            $this->syncPermissions($role->getId(), $permissions);
        }

        $_SESSION['toastrNotify'] = [
            'alert-type' => 'success',
            'message' => 'Role Permissions Updated successfully'
        ];
        header("Location: /edit-role-permissions/$id");
        exit;
    }

    public function deleteRolePermissions($id)
    {
        $role = $this->roleService->getById($id);
        if (!is_null($role)) {
            $this->roleService->delete($id);
        }

        $_SESSION['toastrNotify'] = [
            'alert-type' => 'success',
            'message' => 'Role Permissions Deleted successfully'
        ];
        header("Location: /all-role-permissions");
        exit;
    }
}
