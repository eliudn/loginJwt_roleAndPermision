<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;
use Src\Management\Auth\Application\AccessToken\Invalidate\InvalidateJwtUseCase;
use Src\Management\Auth\Application\AccessToken\Register\RegisterJwtUseCase;
use Src\Management\Auth\Domain\Contracts\AccessTokenRepositoriesContract;

class AccessTokenTest extends TestCase
{
    use RefreshDatabase;
    private readonly RegisterJwtUseCase $registerJwtUseCase;
    private InvalidateJwtUseCase $invalidateJwtUseCase;
    private readonly AccessTokenRepositoriesContract $accessTokenRepository;
    protected  function setUp():void
    {
        parent::setUp();
        $this->accessTokenRepository = $this->createMock(AccessTokenRepositoriesContract::class);
        $this->registerJwtUseCase = new RegisterJwtUseCase($this->accessTokenRepository);
        // $this->invalidateJwtUseCase = new InvalidateJwtUseCase();
    }
    /**
     * A basic unit test example.
     */

    public function test_registerJwtToken():void
    {
        $token = [
            "user_id"=>1,
            "token"=>"token_test"
        ];
        $accesstoken = $this->registerJwtUseCase->__invoke($token);
        $this->assertTrue($accesstoken->entity());
    }

}
