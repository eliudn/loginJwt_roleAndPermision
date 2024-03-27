<?php

namespace Src\Application\RolesPermissions\Domain\Contract;

use Src\Application\RolesPermissions\Domain\Permission;
use Src\Application\RolesPermissions\Domain\Role;
use Src\Application\RolesPermissions\Domain\ValueObject\PermissionValueObject;
use Src\Application\RolesPermissions\Domain\ValueObject\RoleIDValueObject;
use Src\Application\RolesPermissions\Domain\ValueObject\UserIdValueObject;

interface RolePermissionsRepositoryContract
{
    public function getRoles():Role;
    public function getPermissios():Permission;
    public function addPermitionToRole(
        RoleIDValueObject $roleIDValueObject,
        PermissionValueObject $permissionValuaObject
    ):Role;
    public function getRolePermissions(
        RoleIDValueObject $roleIDValueObject
    ):Permission;
    public function removePermissionFromRole(
        RoleIDValueObject $roleIDValueObject,
        PermissionValueObject $permissionValuaObject
    ):Role;
    public function permissionsNotInRole(
        RoleIDValueObject $roleIDValueObject
    ):Permission;
    public function getRoleFindUser(UserIdValueObject $userIdValueObject):Role;
    public function getPermissionFindUser(UserIdValueObject $userIdValueObject):Permission;
}
