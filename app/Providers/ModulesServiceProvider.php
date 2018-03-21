<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ModulesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $modulesPath = [base_path('app/Modules')];

        foreach ($modulesPath as $path) {
            $modules = glob($path . '/*', GLOB_ONLYDIR);
            foreach ($modules as $module) {
                if (!file_exists($module . '/routes.php')) {
                    continue;
                }
               require $module . '/routes.php';

            }
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
