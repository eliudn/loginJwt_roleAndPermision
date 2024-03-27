<?php

namespace Src\Application\People\Application\Create;

use Src\Application\People\Domain\Contracts\PeopleRepositoryContract;
use Src\Application\People\Domain\People;
use Src\Application\People\Domain\ValueObjects\PeopleValueObject;

final class AddPhoneUseCase
{
    public function __construct(
        private readonly PeopleRepositoryContract $peopleRepositoryContract
    )
    {

    }
    /**
     * @return People
     * @param array<int,mixed> $request
     */
    public function __invoke(array $request): People
    {
        $this->updateIsPrimaryFalse($request['is_primary']);
        // dd($this->peopleRepositoryContract->addPhone(new PeopleValueObject($request)));
        return $this->peopleRepositoryContract->addPhone(new PeopleValueObject($request));
    }
    /**
     * @return void
     * @param mixed $id
     */
    private function updateIsPrimaryFalse($id): void
    {
        $this
        ->peopleRepositoryContract
        ->udpateIsPrimaryFalsePhone(
            new PeopleValueObject($id)
        );
    }
}
