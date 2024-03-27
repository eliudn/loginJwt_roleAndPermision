<?php

namespace Src\Application\RolesPermissions\Infrastructure\Services;

use Src\Shared\Infrastructure\Services\RouteServiceProvider as ServiceProvider;
final class RouteServicesProvider extends ServiceProvider
{
        public function __construct($app)
    {

        $appVersion  = env("APP_VERSION");
        $this->setDependency(
            'api/'.$appVersion.'',
            'Src\Application\People\Infrastructure\Controllers',
            'src/Application/People/Infrastructure/Routes/Api.php',
            true
        );

        parent::__construct($app);
    }

}
