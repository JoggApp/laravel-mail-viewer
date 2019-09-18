<?php

namespace JoaonzangoII\MailViewer\Tests;

class MailViewerTest extends BaseTestCase
{
    protected $packageUrl;

    public function setUp(): void
    {
        parent::setUp();

        $this->packageUrl = config('mailviewer.url');

        $router = $this->app['router'];

        $middlewares = config('mailviewer.middlewares');

        $router->get($this->packageUrl, 'JoaonzangoII\MailViewer\Controllers\MailViewerController@index')
            ->middleware($middlewares);

        $router->get($this->packageUrl . '/{mail}', 'JoaonzangoII\MailViewer\Controllers\MailViewerController@show')
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
    public function it_renders_the_mailable_without_dependencies_on_its_dedicated_route()
    {
        $this->get(route('mv-mailviewer', 'JoaonzangoII\MailViewer\Tests\Stubs\Mail\TestEmailForMailViewer'))
            ->assertSee('The test email view');
    }

    /** @test */
    public function it_renders_the_mailable_with_dependencies_on_its_dedicated_route()
    {
        $this->get(route('mv-mailviewer', 'JoaonzangoII\MailViewer\Tests\Stubs\Mail\TestEmailWithDependencies'))
            ->assertSee('The test email view');
    }

    /** @test */
    public function it_renders_the_mailable_with_state_on_its_dedicated_route()
    {
        $this->get(route('mv-mailviewer', 'JoaonzangoII\MailViewer\Tests\Stubs\Mail\TestEmailWithState'))
            ->assertSee('The test email view')
            ->assertSee('Is awesome: yes');
    }

    /** @test */
    public function it_renders_the_correct_mailable_having_similar_class_name_as_another_mailable_in_different_namespace()
    {
        $this->get(route('mv-mailviewer', 'JoaonzangoII\MailViewer\Tests\Stubs\Mail\NamespaceOne\TestEmail'))
            ->assertSee('The test email view for email in namespace one.');

        $this->get(route('mv-mailviewer', 'JoaonzangoII\MailViewer\Tests\Stubs\Mail\NamespaceTwo\TestEmail'))
            ->assertSee('The test email view for email in namespace two.');
    }
}
