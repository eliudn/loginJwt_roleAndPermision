<?php

namespace Src\Management\Auth\Infrastructure\Repositories\Eloquent;

use Illuminate\Support\Facades\DB;
use Src\Management\Auth\Domain\Auth;
use Src\Management\Auth\Domain\Contracts\AuthRepositoryContract;
use Src\Management\Auth\Domain\ValueObjects\AuthValueObject;
use Src\Management\Auth\Domain\ValueObjects\LoginValueObject;
use Src\Management\Auth\Domain\ValueObjects\SingUpValueObject;
use Src\Management\Auth\Infrastructure\Repositories\Eloquent\User as Model;

final class AuhtRepository implements AuthRepositoryContract
{
    public function __construct(

        private Model $model,
        private DB $db
    ){

    }
    public function login(LoginValueObject $loginValueObject): Auth
    {
        $user = $this->userbyEmailOrNickName($loginValueObject->value()['email']);
        if(!$user)
        {
            return new Auth(null, 'USER_OR_PASSWORD_INCORRECT');
        }

        $check = $loginValueObject->checkPassword($user["password"]);
        if(!$check)
        {
            return new Auth(null, 'USER_OR_PASSWORD_INCORRECT');
        }
        return new Auth($user);
    }

    public function logout(AuthValueObject $authValueObject): Auth
    {
    }

    public function singUp(SingUpValueObject $singUpValueObject): Auth
    {
        $user = $this->model->create($singUpValueObject->handler());
        return new Auth($user->toArray());
    }
    /**
     * @return array
     */
    private function userbyEmailOrNickName(string $value): ?array
    {
        $user = $this->db::table('users')
        ->join('people', 'users.person_id','=','people.id')
        ->join('emails', 'people.id','=','emails.person_id')
        ->select('users.id','users.username','users.password','people.name','people.last_name','emails.email')
        ->where('email',$value)
        ->orWhere('username',$value)
        ->first();

        return (array) $user;
    }
}
