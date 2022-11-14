<?php

namespace Jmnn\MapVi;

use Illuminate\Support\ServiceProvider;
use Jmnn\MapVi\Commands\MapViCommand;

class MapViServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    public function boot()
    {
        $this->commands([
            MapViCommand::class
        ]);
    }
}
