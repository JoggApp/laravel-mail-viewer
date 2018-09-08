# View all your mailables at a single place

The Design and content team members often need access to the emails your app will be sending out to the users. This is a fairly simple package that makes it possible and tries to minimize developer dependency. By using this package, you can have a dedicated route to view all your mailables at a single place. Having sharebale URLs to view the mails makes the team co-ordination more smooth.

## Installation

You can install this package via composer using this command:

```bash
composer require joggapp/laravel-mail-viewer
```

The package will automatically register itself.

You will have to add the mailables and configure the other settings using the package's config file in order to to use this package. You can publish the config file with:

```bash
php artisan vendor:publish --provider="JoggApp\MailViewer\MailViewerServiceProvider"
```

This will create the package's config file called `mailviewer.php` in the `config` directory. These are the contents of the published config file:

```php
return [
    /*
    |--------------------------------------------------------------------------
    | Only the mailables registered here can be accesed using this package
    |--------------------------------------------------------------------------
    |
    | You have to add the mailables including their dependencies
    | in the following array. When asked for a mailable, the
    | package will search it here for its defination.
    |
    | Eg: [ new OrderShipped(factory(Order::class)->create()) ]
    |
    */

    'mailables' => [],

    /*
    |--------------------------------------------------------------------------
    | URL where you want to view the mails
    |--------------------------------------------------------------------------
    |
    | This is the URL where you can view all the mailables
    | registered in your application.
    |
    */

    'url' => 'mails',

    /*
    |--------------------------------------------------------------------------
    | The environments in which the url should be accesible
    |--------------------------------------------------------------------------
    |
    | If you don't want to use this package in production env
    | at all, you can restrict that using this option
    | rather than by using a middleware.
    |
    */

    'allowed_environments' => ['local', 'staging'],

    /*
    |--------------------------------------------------------------------------
    | Middlewares that should be applied to the URL
    |--------------------------------------------------------------------------
    |
    | The value should be an array of fully qualified
    | class names of the middlware classes.
    |
    | Eg: [Authenticate::class, CheckForMaintenanceMode::class]
    | Don't forget to import the classes at the top!
    |
    */

    'middlewares' => [],
];
```

## Testing

You can run the tests with:

```bash
vendor/bin/phpunit
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Security

If you discover any security related issues, please email [harish@jogg.co](mailto:harish@jogg.co) instead of using the issue tracker.

## Credits

- [Harish Toshniwal](https://github.com/introwit)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.txt) for more information.