<?php

namespace Src\Application\RolesPermissions\Application\Get;

use Src\Application\RolesPermissions\Domain\Contract\RolePermissionsRepositoryContract;
use Src\Application\RolesPermissions\Domain\Role;
use Src\Application\RolesPermissions\Domain\ValueObject\UserIdValueObject;

final class RoleFindByUserUseCase
{
    public function __construct(
        private RolePermissionsRepositoryContract $rolePermissionsRepositoryContract
    )
    {

    }
    /**
     * @return Role
     */
    public function __invoke(int $userID): Role
    {

        return $this->rolePermissionsRepositoryContract->getRoleFindUser(
            new UserIdValueObject($userID)
        );
    }
}
