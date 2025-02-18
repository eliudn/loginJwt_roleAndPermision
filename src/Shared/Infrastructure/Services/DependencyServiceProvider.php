<?php

namespace Src\Shared\Infrastructure\Services;

use Illuminate\Support\ServiceProvider as Service;

abstract class  DependencyServiceProvider extends Service
{
    private array $dependencies;
    /**
     * @param array<int,mixed> $dependencies
     */
    public function setDependency(array $dependencies):void{
        $this->dependencies =$dependencies;

    }

    public function register():void
    {
        foreach ($this->dependencies as $value){
            $this->app
                ->when($value["useCase"])
                ->needs($value["contract"])
                ->give($value["repository"]);
        }
    }
}
