<?php

namespace BeyondCode\DuskDashboard;

use Illuminate\Support\ServiceProvider;

class DuskDashboardServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     */
    public function register()
    {
        $this->commands([
            Console\StartDashboardCommand::class,
        ]);
    }
}
