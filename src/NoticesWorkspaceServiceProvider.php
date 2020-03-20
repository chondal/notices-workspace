<?php
namespace Chondal\NoticesWorkspace;

use Illuminate\Support\ServiceProvider;

class NoticesWorkspaceServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        $this->loadViewsFrom(__DIR__ . '/../resources/views/', 'NoticesWorkspace');

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->publishes([
            __DIR__ . '/../database/migrations' => database_path('migrations'),
        ], 'notices-workspace-migrations');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/NoticesWorkspace'),
        ], 'notices-workspace-views');

        $this->publishes([
            __DIR__ . '/../config/notices-workspace.php' => base_path('config/notices-workspace.php'),
        ], 'notices-workspace-config');

    }

    public function register()
    {
        $this->app->bind('notices-workspace', function () {
            return new Notice;
        });

        $this->mergeConfigFrom(__DIR__ . '/../config/notices-workspace.php', 'notices-workspace');
    }
}
