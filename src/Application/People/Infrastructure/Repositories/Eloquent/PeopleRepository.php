<?php

namespace Src\Application\People\Infrastructure\Repositories\Eloquent;

use Src\Application\People\Domain\Contracts\PeopleRepositoryContract;
use Src\Application\People\Domain\People;
use Src\Application\People\Domain\ValueObjects\PeopleValueObject;
use Src\Application\People\Infrastructure\Repositories\Eloquent\People as ModelPeople;
use Src\Application\People\Infrastructure\Repositories\Eloquent\Email;

final class PeopleRepository implements PeopleRepositoryContract
{
    public function __construct(
        private  ModelPeople $model,
        private Email $email,
        private Phone $phone
    )
    {
    }
    public function create(PeopleValueObject $peopleValueObject): People
    {
        $people = $this->model->create($peopleValueObject->value());
        return new People($people->toArray());
    }

    public function addEmail(PeopleValueObject $peopleValueObject): People
    {
        $email = $this->email->create($peopleValueObject->value());
        return new People($email->toArray());
    }

    public function getAll(): People
    {
        $people = $this->model->withAllInfo()->get();
        return new People($people->toArray());
    }

    public function personFindByID(PeopleValueObject $peopleValueObject): People
    {
        $people = $this->model->withAllInfo()
            ->find($peopleValueObject->value());
        return new People($people->toArray());
    }

    public function addPhone(PeopleValueObject $peopleValueObject): People
    {
        $phone = $this->phone
        ->create($peopleValueObject->value());
        return new People($phone->toArray());
    }

    public function udpateIsPrimaryFalsePhone(PeopleValueObject $peopleValueObject): People
    {
        $phone =$this->phone
        ->where('person_id',$peopleValueObject->value())
        ->update(['is_primary'=>false]);

        // dd($phone->get());
        // dd($phone->update(['is_primary'=>false]));
        return new People($phone);

    }
}
