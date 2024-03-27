<?php

namespace Src\Management\Auth\Application\Login;

use Src\Application\People\Application\Create\PeopleCreateUseCase;
use Src\Application\RolesPermissions\Application\Get\PermissionFindByUserUseCase;
use Src\Application\RolesPermissions\Application\Get\RoleFindByUserUseCase;
use Src\Management\Auth\Application\AccessToken\Register\RegisterJwtUseCase;
use Src\Management\Auth\Application\Auth\JwtAuthenticationUseCase;
use Src\Management\Auth\Domain\Auth;
use Src\Management\Auth\Domain\Contracts\AuthRepositoryContract;
use Src\Management\Auth\Domain\UserAccessToken;
use Src\Management\Auth\Domain\ValueObjects\LoginValueObject;

final class AuthLoginUseCase
{
    public function __construct(
        private readonly AuthRepositoryContract $authRepositoryContract,
        private readonly PeopleCreateUseCase $PeopleCreateUseCase,
        private readonly JwtAuthenticationUseCase $jwtAuthenticationUseCase,
        private readonly RoleFindByUserUseCase $roleFindByUserUseCase,
        private readonly PermissionFindByUserUseCase $permissionFindByUserUseCase,
        private readonly RegisterJwtUseCase $registerJwtUseCase
    )
    {

    }
    /**
     * @return Auth
     * @param array<int,mixed> $request
     */
    public function __invoke(array $request): Auth
    {
        $login = $this->authRepositoryContract->login(new LoginValueObject($request));
        $user = $this->RequestUser(
            $login->handler(),
            $this->role($login->handler()["id"]),
            $this->permission($login->handler()["id"])
        );

        $loginJwt = $this->jwtAuthenticationUseCase
        ->__invoke($user);

        $checkRegisterToken = $this->registerToken($login->handler()["id"],$loginJwt);

        $auth = new Auth(
            array_merge(
                $user,
                [
                    "jwt"=>$loginJwt
                ]
            )
        );
        return $checkRegisterToken->entity() ? $auth
            : new Auth(null, "USER_ERROR_SINGUP");
    }
    /**
     * @return mixed
     * @param mixed $request
     */
    private function role($request)
    {
        return $this->roleFindByUserUseCase->__invoke($request)->entity();
    }
    /**
     * @return mixed
     * @param mixed $request
     */
    private function permission($request)
    {
        return $this->permissionFindByUserUseCase->__invoke($request)->entity();
    }
    /**
     * @return array<string,mixed>@param mixed $login
     * @param mixed $role
     * @param mixed $permission
     */
    private function RequestUser($login, $role, $permission): array
    {
        return array_merge(
            $login,
            [
                "roles"=>$role,
                "permissions"=>$permission
            ]
        );
    }
    /**
     * @return UserAccessToken
     * @param mixed $userID
     * @param mixed $token
     */
    private function registerToken($userID, $token): UserAccessToken
    {
        $userToken = $this->registerJwtUseCase->__invoke([
            "user_id"=>$userID,
            "token"=>$token
        ]);
        return $userToken;
    }
}
