<?php

namespace Src\Application\People\Application\Get;

use Src\Application\People\Domain\Contracts\PeopleRepositoryContract;

final class PeopleGetAllUseCase
{
    public function __construct(
        private readonly PeopleRepositoryContract $peopleRepositoryContract
    )
    {

    }
    public function __invoke(){

        return $this->peopleRepositoryContract->getAll();
    }
}
