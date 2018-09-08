<?php

namespace JoggApp\MailViewer\Tests;

class MailViewerTest extends BaseTestCase
{
    protected $packageUrl;

    public function setUp()
    {
        parent::setUp();

        $router = $this->app['router'];

        $this->packageUrl = config('mailviewer.url');

        $middlewares = config('mailviewer.middlewares');

        $router->get($this->packageUrl, 'JoggApp\MailViewer\Controllers\MailViewerController@index')
            ->middleware($middlewares);

        $router->get($this->packageUrl . '/{mail}', 'JoggApp\MailViewer\Controllers\MailViewerController@show')
            ->middleware($middlewares)
            ->name('mv-mailviewer');
    }

    /** @test */
    public function it_lists_all_the_mailables_on_the_url_configured_in_config_file()
    {
        $this->get($this->packageUrl)
            ->assertSee('All Mails')
            ->assertSee('TestEmailForMailViewer');
    }

    /** @test */
    public function it_renders_the_mailable_on_its_dedicated_route()
    {
        $this->get(route('mv-mailviewer', 'TestEmailForMailViewer'))
            ->assertSee('The test email view');
    }
}
