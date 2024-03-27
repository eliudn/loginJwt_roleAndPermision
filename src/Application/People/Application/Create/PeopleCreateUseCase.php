<?php

namespace Src\Application\People\Application\Create;

use Src\Application\People\Domain\Contracts\PeopleRepositoryContract;
use Src\Application\People\Domain\People;
use Src\Application\People\Domain\ValueObjects\PeopleValueObject;

final class PeopleCreateUseCase
{
    public function __construct(
        private readonly PeopleRepositoryContract $peopleRepositoryContract,
        private readonly AddEmailUseCase $addEmailUseCase,
        private readonly AddPhoneUseCase $addPhoneUseCase
    )
    {

    }
    /**
     * @param array<int,mixed> $request
     */
    public function __invoke(array $request):People
    {
        $personId = $this->PersonId($request);
        $email = $this->addEmail($this->requestEmail($personId,$request["email"]));
        if(array_key_exists('phone',$request)&& !is_null($request['phone']))
        {

            $this->addPhone($this->requestPhone($personId,$request["phone"]));
        }
        $person = $this->personFindByID($personId);
        // dd($personId,$email->entity(),$person->entity());
        return $person;
    }
    /**
     * @return mixed
     * @param mixed $request
     */
    private function PersonId($request)
    {
        $peopleId = $this
            ->peopleRepositoryContract
            ->create(new PeopleValueObject($request));

        return  $peopleId->entity()["id"];
    }
    /**
     * @return People
     * @param mixed $request
     */
    private function addEmail($request): People
    {
        return $this
            ->addEmailUseCase->__invoke($request);
    }
    /**
     * @return array<string,mixed>
     * @param mixed $PersonId
     * @param mixed $email
     */
    private function requestEmail($PersonId, $email): array
    {
        return [
            'person_id'=>$PersonId,
            'email'=>$email,
            'is_primary'=>true
        ];
    }
    /**
     * @return array<string,mixed>
     * @param mixed $person_id
     * @param mixed $phone
     */
    private function requestPhone($person_id, $phone): array
    {
        return [
            'person_id'=>$person_id,
            'phone'=>$phone,
            'is_primary'=>true
        ];
    }
    /**
     * @return People
     * @param mixed $id
     */
    private function personFindByID($id): People
    {
        return $this->peopleRepositoryContract
            ->personFindByID(new PeopleValueObject($id));
    }
    /**
     * @return void
     * @param array<int,mixed> $request
     */
    private function addPhone(array $request): void
    {

        $this->addPhoneUseCase->__invoke($request);
    }
}
