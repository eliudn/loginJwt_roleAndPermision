<?php

namespace Src\Shared\Infrastructure\Services;

use Illuminate\Support\Facades\Route;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

abstract class RouteServiceProvider extends ServiceProvider
{
    private mixed $prefix;
    private mixed $namespaceName;
    private mixed $group;
    private ?bool $except;

    /**
     * @param mixed $prefix
     * @param mixed $namespaceName
     * @param mixed $group
     * @param bool|null $except
     * @return void
     */
    public function setDependency(
        mixed $prefix,
        mixed $namespaceName,
        mixed $group,
        ?bool $except = null
    ):void
    {
        $this->prefix =$prefix;
        $this->namespaceName =$namespaceName;
        $this->group= $group;
        $this->except=$except;
    }

    /**
     * @return void
     */
    public function boot():void
    {
        parent::boot(); // TODO: Change the autogenerated stub
    }

    /**
     * @return void
     */
    public function map():void{
        $this->mapRoutes();
    }

    /**
     * @return void
     */
    public function mapRoutes():void
    {
        Route::middleware(!$this->except?['api','jwt']:'api')
            ->prefix($this->prefix)
            ->namespace($this->namespaceName)
            ->group(base_path($this->group));
    }
}
