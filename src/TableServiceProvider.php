<?php

namespace MrShaneBarron\Table;

use Illuminate\Support\ServiceProvider;

class TableServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/sb-table.php', 'sb-table');
    }

    public function boot(): void
    {
        if (class_exists(\Livewire\Livewire::class)) {
            \Livewire\Livewire::component('sb-table', Livewire\Table::class);
        }

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'sb-table');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/sb-table.php' => config_path('sb-table.php'),
            ], 'sb-table-config');
        }
    }
}
