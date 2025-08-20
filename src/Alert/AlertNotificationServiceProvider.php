<?php

namespace Alert;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;

class AlertNotificationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('alert', function ($app) {
            return new AlertNotificationManager($app['config']->get('alert-notification', []));
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Publish configuration
        $this->publishes([
            __DIR__.'/../../config/alert-notification.php' => config_path('alert-notification.php'),
        ], 'config');

        // Publish assets
        $this->publishes([
            __DIR__.'/../../resources/css' => public_path('notification'),
            __DIR__.'/../../resources/js' => public_path('notification'),
        ], 'assets');

        // Load configuration
        $this->mergeConfigFrom(__DIR__.'/../../config/alert-notification.php', 'alert-notification');

        // Register Blade directives
        $this->registerBladeDirectives();

        // Register view composer
        View::composer('*', function ($view) {
            $view->with('alertNotificationConfig', config('alert-notification'));
        });
    }

    /**
     * Register custom Blade directives
     */
    protected function registerBladeDirectives(): void
    {
        // @alertStyles directive
        Blade::directive('alertStyles', function () {
            return "<?php echo app('alert')->renderStyles(); ?>";
        });

        // @alertScripts directive  
        Blade::directive('alertScripts', function () {
            return "<?php echo app('alert')->renderScripts(); ?>";
        });

        // @alertNotifications directive
        Blade::directive('alertNotifications', function ($expression) {
            return "<?php echo app('alert')->renderNotifications($expression); ?>";
        });
    }
}
