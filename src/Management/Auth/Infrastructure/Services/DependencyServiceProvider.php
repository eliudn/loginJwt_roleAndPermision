<?php

namespace Src\Management\Auth\Infrastructure\Services;

use Src\Shared\Infrastructure\Services\DependencyServiceProvider as ServiceProvider;
class DependencyServiceProvider extends ServiceProvider
{
    public function __construct($app)
    {
        $this->setDependency(
            [
                [
                    "useCase"=>[
                        \Src\Management\Auth\Application\Login\AuthLoginUseCase::class,
                        \Src\Management\Auth\Application\SingUp\SingUpUseCase::class,
                    ],
                    "contract"=>\Src\Management\Auth\Domain\Contracts\AuthRepositoryContract::class,
                    "repository"=>\Src\Management\Auth\Infrastructure\Repositories\Eloquent\AuhtRepository::class
                ],
                [
                    "useCase"=>[
                        \Src\Management\Auth\Application\Auth\JwtAuthenticationUseCase::class,
                        \Src\Management\Auth\Application\Auth\CheckTokenAutheticationUseCase::class,
                        \Src\Management\Auth\Application\Auth\LoginCheckAuthenticationUseCase::class,
                        \Src\Management\Auth\Application\JWT\DecodeUseCase::class,

                    ],
                    "contract"=>\Src\Management\Auth\Domain\Contracts\JwtAutheticationContract::class,
                    "repository"=>\Src\Management\Auth\Infrastructure\Repositories\FirebaseJwt\JwtAuthentication::class
                ],
                [
                    "useCase"=>[
                        \Src\Management\Auth\Application\AccessToken\Register\RegisterJwtUseCase::class,
                        \Src\Management\Auth\Application\AccessToken\Invalidate\InvalidateJwtUseCase::class,
                        \Src\Management\Auth\Application\AccessToken\Validation\isTokenValidUseCase::class,
                    ],
                    "contract"=>\Src\Management\Auth\Domain\Contracts\AccessTokenRepositoriesContract::class,
                    "repository"=>\Src\Management\Auth\Infrastructure\Repositories\Eloquent\AccessTonkenRepositories::class
                ]
            ]
        );
        parent::__construct($app);
    }
}
