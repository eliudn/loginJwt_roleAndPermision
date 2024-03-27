<?php

namespace Src\Application\RolesPermissions\Application\Get;

use Src\Application\RolesPermissions\Domain\Contract\RolePermissionsRepositoryContract;
use Src\Application\RolesPermissions\Domain\Permission;
use Src\Application\RolesPermissions\Domain\Role;
use Src\Application\RolesPermissions\Domain\ValueObject\UserIdValueObject;

final class PermissionFindByUserUseCase
{
    public function __construct(
        private RolePermissionsRepositoryContract $rolePermissionsRepositoryContract
    ){}
    /**
     * @return Role
     */
    public function __invoke(int $request): Permission
    {
        return $this->rolePermissionsRepositoryContract->getPermissionFindUser(
            new UserIdValueObject($request)
        );
    }
}
