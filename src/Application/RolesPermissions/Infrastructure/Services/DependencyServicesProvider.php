<?php

namespace Src\Application\RolesPermissions\Infrastructure\Services;

use Src\Shared\Infrastructure\Services\DependencyServiceProvider as ServiceProvider;
final class DependencyServicesProvider extends ServiceProvider
{
    public function __construct($app)
    {
        $this->setDependency(
            [
                [
                    "useCase"=>[
                        \Src\Application\RolesPermissions\Application\Get\RoleFindByUserUseCase::class,
                        \Src\Application\RolesPermissions\Application\Get\PermissionFindByUserUseCase::class,
                    ],
                    "contract"=>\Src\Application\RolesPermissions\Domain\Contract\RolePermissionsRepositoryContract::class,
                    "repository"=> \Src\Application\RolesPermissions\Infrastructure\Repositories\Eloquent\RolePermissionRepository::class
                ]
            ]
        );
        parent::__construct($app);
    }
}
