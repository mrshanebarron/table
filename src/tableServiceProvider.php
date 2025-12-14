<?php

namespace MrShaneBarron\table;

use Illuminate\Support\ServiceProvider;
use MrShaneBarron\table\Livewire\table;
use MrShaneBarron\table\View\Components\table as Bladetable;
use Livewire\Livewire;

class tableServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/ld-table.php', 'ld-table');
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'ld-table');

        Livewire::component('ld-table', table::class);

        $this->loadViewComponentsAs('ld', [
            Bladetable::class,
        ]);

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/ld-table.php' => config_path('ld-table.php'),
            ], 'ld-table-config');

            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/ld-table'),
            ], 'ld-table-views');
        }
    }
}
