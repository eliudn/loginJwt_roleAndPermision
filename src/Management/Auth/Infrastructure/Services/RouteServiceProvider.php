<?php

namespace Src\Management\Auth\Infrastructure\Services;

use Src\Shared\Infrastructure\Services\RouteServiceProvider as ServiceProvider;

final class RouteServiceProvider extends ServiceProvider
{
    public function __construct($app)
    {

        $appVersion  = env("APP_VERSION");
        $this->setDependency(
            'api/'.$appVersion.'/auth',
            'Src\Management\Auth\Infrastructure\Controllers',
            'src/Management/Auth/Infrastructure/Routes/Api.php',
            true
        );

        parent::__construct($app);
    }
}
