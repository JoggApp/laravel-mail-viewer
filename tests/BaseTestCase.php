<?php

namespace JoggApp\MailViewer\Tests;

use JoggApp\MailViewer\MailViewerServiceProvider;
use JoggApp\MailViewer\Tests\Stubs\Mail\NamespaceOne\TestEmail as TestEmailInNamespaceOne;
use JoggApp\MailViewer\Tests\Stubs\Mail\NamespaceTwo\TestEmail as TestEmailInNamespaceTwo;
use JoggApp\MailViewer\Tests\Stubs\Mail\TestEmailForMailViewer;
use JoggApp\MailViewer\Tests\Stubs\Mail\TestEmailWithDependencies;
use JoggApp\MailViewer\Tests\Stubs\Mail\TestEmailWithNoConstructor;
use JoggApp\MailViewer\Tests\Stubs\Mail\TestEmailWithState;
use JoggApp\MailViewer\Tests\Stubs\Models\Test;
use Orchestra\Testbench\TestCase;

class BaseTestCase extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->withFactories(__DIR__ . '/Database/Factories');

        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');

        $this->artisan('migrate', ['--database' => 'testing']);
    }

    protected function getPackageProviders($app)
    {
        return [MailViewerServiceProvider::class];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('app.env', 'local');

        $app['config']->set(
            'mailviewer.mailables',
            [
                TestEmailForMailViewer::class => [],
                TestEmailWithNoConstructor::class => [],
                TestEmailWithDependencies::class => [
                    [],
                    \stdClass::class,
                    'Some name',
                    7,
                    null
                ],
                TestEmailWithState::class => [
                    [
                        'class' => Test::class,
                        'states' => ['is-awesome']
                    ]
                ],
                TestEmailInNamespaceOne::class => [],
                TestEmailInNamespaceTwo::class => []
            ]
        );

        $app['config']->set('mailviewer.url', 'mails');
        $app['config']->set('mailviewer.allowed_environments', ['local', 'staging', 'testing']);
        $app['config']->set('mailviewer.middlewares', []);

        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
           'driver' => 'sqlite',
           'database' => ':memory:',
           'prefix' => '',
        ]);

        $app['config']->set('app.debug', env('APP_DEBUG', true));
    }
}
