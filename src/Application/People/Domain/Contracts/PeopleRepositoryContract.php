<?php

namespace Src\Application\People\Domain\Contracts;

use Src\Application\People\Domain\People;
use Src\Application\People\Domain\ValueObjects\PeopleValueObject;

interface PeopleRepositoryContract
{
    public function create(PeopleValueObject $peopleValueObject):People;
    public function addEmail(PeopleValueObject $peopleValueObject):People;
    public function getAll():People;
    public function personFindByID(PeopleValueObject $peopleValueObject):People;
    public function addPhone(PeopleValueObject $peopleValueObject):People;
    public function udpateIsPrimaryFalsePhone(PeopleValueObject $peopleValueObject):People;
}
