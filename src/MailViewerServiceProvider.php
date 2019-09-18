<?php

namespace JoaonzangoII\MailViewer;

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
    }

    public function register()
    {
        //
    }
}
