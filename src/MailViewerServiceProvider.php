<?php

namespace JoggApp\MailViewer;

use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Illuminate\Support\ServiceProvider;

class MailViewerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/mailviewer.php' => config_path('mailviewer.php'),
        ]);

        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        $this->loadViewsFrom(__DIR__ . '/../views', 'mailviewer');

        if (app()->environment() === 'testing') {
            $this->app->singleton(EloquentFactory::class, function ($app) {
                $faker = $app->make(\Faker\Generator::class);
                $factories_path = __DIR__.'/../tests/Factories';

                return EloquentFactory::construct($faker, $factories_path);
            });
        }
    }

    public function register()
    {
        //
    }
}
