<?php

namespace JoggApp\MailViewer\Tests;

use JoggApp\MailViewer\MailViewerServiceProvider;
use JoggApp\MailViewer\Tests\Stubs\Mail\TestEmailForMailViewer;
use Orchestra\Testbench\TestCase;

class BaseTestCase extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [MailViewerServiceProvider::class];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('app.env', 'local');

        $app['config']->set(
            'mailviewer.mailables',
            [new TestEmailForMailViewer()]
        );

        $app['config']->set('mailviewer.url', 'mails');
        $app['config']->set('mailviewer.allowed_environments', ['local', 'staging', 'testing']);
        $app['config']->set('mailviewer.middlewares', []);
    }
}
