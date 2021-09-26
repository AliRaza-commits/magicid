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
         $this->load(__DIR__ . '/Commands');
       
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
                \Syedali\magicid\Commands\MagicCommand::class,
            ]);
        }
    }
}
