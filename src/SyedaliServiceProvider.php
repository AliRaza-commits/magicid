<?php

namespace Syedali\magicid;

use Illuminate\Support\ServiceProvider;

class SyedaliServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        include __DIR__."/routes.php";  
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                \Commands\MagicCommand::class,
            ]);
        }
    }
}
