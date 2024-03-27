<?php

namespace Src\Application\People\Infrastructure\Services;

use Src\Shared\Infrastructure\Services\DependencyServiceProvider as ServiceProvider;
final class DependencyServiceProvider extends ServiceProvider
{
    public function __construct($app)
    {
        $this->setDependency(
            [
                [
                    "useCase"=>[
                        \Src\Application\People\Application\Create\PeopleCreateUseCase::class,
                        \Src\Application\People\Application\Create\AddEmailUseCase::class,
                        \Src\Application\People\Application\Get\PeopleGetAllUseCase::class,
                        \Src\Application\People\Application\Create\AddPhoneUseCase::class,


                    ],
                    "contract"=>\Src\Application\People\Domain\Contracts\PeopleRepositoryContract::class,
                    "repository"=>\Src\Application\People\Infrastructure\Repositories\Eloquent\PeopleRepository::class
                ]
            ]
        );
        parent::__construct($app);
    }

}
