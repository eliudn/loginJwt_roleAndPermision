<?php

namespace Src\Application\People\Application\Create;

use Src\Application\People\Domain\Contracts\PeopleRepositoryContract;
use Src\Application\People\Domain\People;
use Src\Application\People\Domain\ValueObjects\PeopleValueObject;

final class AddEmailUseCase
{
    public function __construct(
        private readonly PeopleRepositoryContract $peopleRepositoryContract
    )
    {

    }
    /**
     * @param array<int,mixed> $request
     */
    public function __invoke(array $request):People
    {
        // dd($this->peopleRepositoryContract
        //     ->addEmail(new PeopleValueObject($request)));
        return $this->peopleRepositoryContract
            ->addEmail(new PeopleValueObject($request));
    }
}
