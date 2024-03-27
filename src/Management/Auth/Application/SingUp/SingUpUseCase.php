<?php

namespace Src\Management\Auth\Application\SingUp;

use Src\Application\People\Application\Create\PeopleCreateUseCase;
use Src\Management\Auth\Application\Auth\JwtAuthenticationUseCase;
use Src\Management\Auth\Domain\Auth;
use Src\Management\Auth\Domain\Contracts\AuthRepositoryContract;
use Src\Management\Auth\Domain\ValueObjects\SingUpValueObject;

final class SingUpUseCase
{
    public function __construct(
        private readonly AuthRepositoryContract $authRepositoryContract,
        private readonly PeopleCreateUseCase $peopleCreateUseCase,
        private readonly JwtAuthenticationUseCase $jwtAuthenticationUseCase
    )
    {

    }
    /**
     * @return Auth
     * @param array<int,mixed> $request
     */
    public function __invoke(array $request): Auth
    {
        $peopleID = $this->createPeople($request);
        $userRequest = $this->resquestUser($request, $peopleID);
        $singUp = $this->authRepositoryContract
            ->singUp(new SingUpValueObject($userRequest));
        return new Auth(
            array_merge(
                $singUp->entity(),
                [
                    "jwt" => $this->jwtAuthenticationUseCase
                    ->__invoke($singUp->entity())
                ]
            )
        );
    }
    /**
     * @return mixed
     * @param array<int,mixed> $request
     */
    private function createPeople(array $request)
    {
       $people = $this->peopleCreateUseCase->__invoke($request) ;
        return $people->entity()["id"];
    }
    /**
     * @return array
     * @param array<int,mixed> $request
     * @param mixed $id
     */
    private function  resquestUser(array $request, $id): array
    {

        return [
            "password"=>$request["password"],
            "username"=>$request["nick"],
            "person_id"=>$id
        ];
    }

}
