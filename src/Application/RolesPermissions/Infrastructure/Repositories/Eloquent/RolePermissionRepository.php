<?php

namespace Src\Application\RolesPermissions\Infrastructure\Repositories\Eloquent;

use Src\Application\RolesPermissions\Domain\Contract\RolePermissionsRepositoryContract;
use Src\Application\RolesPermissions\Domain\Permission;
use Src\Application\RolesPermissions\Domain\Role;
use Src\Application\RolesPermissions\Domain\ValueObject\PermissionValueObject;
use Src\Application\RolesPermissions\Domain\ValueObject\RoleIDValueObject;
use Src\Application\RolesPermissions\Domain\ValueObject\UserIdValueObject;
use Src\Application\RolesPermissions\Infrastructure\Repositories\Eloquent\Role as ModelRole;
use Src\Application\RolesPermissions\Infrastructure\Repositories\Eloquent\Permission as ModelPermission;

final class RolePermissionRepository implements RolePermissionsRepositoryContract
{
    public function __construct(
        private ModelRole $modelRole,
        private ModelPermission $modelPermission
    ){}
    public function getRoles(): Role
    {
    }

    public function getPermissios(): Permission
    {
    }

    public function addPermitionToRole(RoleIDValueObject $roleIDValueObject, PermissionValueObject $permissionValuaObject): Role
    {
    }

    public function getRolePermissions(RoleIDValueObject $roleIDValueObject): Permission
    {
    }

    public function removePermissionFromRole(RoleIDValueObject $roleIDValueObject, PermissionValueObject $permissionValuaObject): Role
    {
    }

    public function permissionsNotInRole(RoleIDValueObject $roleIDValueObject): Permission
    {
    }

    public function getRoleFindUser(UserIdValueObject $userIdValueObject): Role
    {
        $roles = $this->modelRole->whereHas(
            'user',
            function($query)use($userIdValueObject){
                $query->where('user_id',$userIdValueObject->value());
            }
        )->get();
        return new Role($roles);
    }

    public function getPermissionFindUser(UserIdValueObject $userIdValueObject): Permission
    {
        $permission = $this->modelPermission->whereHas(
            'user',
            function($query)use($userIdValueObject){
                $query->where('user_id',$userIdValueObject->value());
            }
        )->get();

        return new Permission($permission);
    }
}
