<?php

namespace Src\Application\People\Infrastructure\Services;

use Src\Shared\Infrastructure\Services\RouteServiceProvider as ServiceProvider;
final class RouteServiceProvider extends ServiceProvider
{
    public function __construct($app)
    {

        $appVersion  = env("APP_VERSION");
        $this->setDependency(
            'api/'.$appVersion.'/people',
            'Src\Application\People\Infrastructure\Controllers',
            'src/Application/People/Infrastructure/Routes/Api.php',
            false
        );

        parent::__construct($app);
    }
}

