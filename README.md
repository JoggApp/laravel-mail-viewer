# View all your mailables at a single place

[![Latest Version](https://img.shields.io/github/release/JoaonzangoII/laravel-mail-viewer.svg?style=flat-rounded)](https://github.com/JoaonzangoII/laravel-mail-viewer/releases)
[![Build Status](https://travis-ci.org/JoaonzangoII/laravel-mail-viewer.svg?branch=master)](https://travis-ci.org/JoaonzangoII/laravel-mail-viewer)
[![Total Downloads](https://img.shields.io/packagist/dt/JoaonzangoII/laravel-mail-viewer.svg?style=flat-rounded&colorB=brightgreen)](https://packagist.org/packages/JoaonzangoII/laravel-mail-viewer)

The Design and content team members often need access to the emails your app will be sending out to the users. This is a fairly simple package that makes it possible and tries to minimize developer dependency. By using this package, you can have a dedicated route to view all your mailables at a single place. Having shareable URLs to view the mails makes the team co-ordination more smooth.

## Installation

You can install this package via composer using this command:

```bash
composer require JoaonzangoII/laravel-mail-viewer
```

The package will automatically register itself.

You will have to add the mailables and configure the other settings using the package's config file in order to to use this package. Please read the comments/description for each config key thoroughly and set their values. You can publish the config file with:

```bash
php artisan vendor:publish --provider="JoaonzangoII\MailViewer\MailViewerServiceProvider"
```

This will create the package's config file called `mailviewer.php` in the `config` directory. These are the contents of the published config file:

```php
return [
    /*
    |--------------------------------------------------------------------------
    | Only the mailables registered here can be accessed using this package
    |--------------------------------------------------------------------------
    |
    | You have to add the mailables including their dependencies
    | in the following array. When asked for a mailable, the
    | package will search it here for its definition.
    |
    | Add the mailable definition as shown below in the example.
    | The mailable class will be the key and the dependencies
    | of the mailable class will be defined in an array as well.
    |
    | The package will look for the equivalent factory if the
    | dependency is an eloquent model. So don't forget to
    | create those factories. If you want a specific state to
    | be used for your dependency you will have to pass an array
    | with 'class' and 'states' keys. The class key will have the
    | name of the dependency and states should contain an array of
    | factory states you want to apply to the factory, see the
    | MailWithDependencyStates example below.
    |
    | Please note that the factory times/count feature isn't
    | supported for the factories.
    | Eg:
    | What the package supports: factory(Order::class)->create();
    | What the package doesn't support: factory(Order::class, 5)->create();
    |
    | The package will try to resolve all other non-eloquent objects
    | using the Laravel's service container.
    |
    | Also, don't forget to import these classes at the top :)
    |
    | eg:
    | 'mailables' => [
    |     OrderShipped::class => [
    |         Order::class,
    |         'Personal thank you message',
    |     ],
    |     MailWithDependencyStates::class => [
    |         [
    |             'class' => Order::class,
    |             'states' => ['state1', 'state2']
    |         ]
    |     ],
    |     MailWithNoDependency::class => []
    | ]
    |
    */

    'mailables' => [],

    /*
    |--------------------------------------------------------------------------
    | URL where you want to view the mails
    |--------------------------------------------------------------------------
    |
    | This is the URL where you can view all the
    | mailables registered above.
    |
    */

    'url' => 'mails',

    /*
    |--------------------------------------------------------------------------
    | The environments in which the url should be accessible
    |--------------------------------------------------------------------------
    |
    | If you don't want to use this package in production env
    | at all, you can restrict that using this option
    | rather than by using a middleware.
    |
    */

    'allowed_environments' => ['local', 'staging', 'testing'],

    /*
    |--------------------------------------------------------------------------
    | Middlewares that should be applied to the URL
    |--------------------------------------------------------------------------
    |
    | The value should be an array of fully qualified
    | class names of the middleware classes.
    |
    | Eg: [Authenticate::class, CheckForMaintenanceMode::class]
    | Don't forget to import the classes at the top!
    |
    */

    'middlewares' => [],
];
```

## How to use

- After setting up the config values as described above, you can see the list of all mailables by visiting the `/mails` route (considering the default url is 'mails' in the config file). You can modify it to whatever you want as per your needs.

- You can also restrict the environments the package should list the mailables in. By default, the `allowed_environments` config is set to allow 3 environments: `local`, `staging` & `testing`. You can further secure it using the `middlewares` config.

- Default view:

List of all mails             |  A particular mail rendered
:-------------------------:|:-------------------------:
![](https://user-images.githubusercontent.com/11228182/45781093-bb59ef00-bc7c-11e8-9d03-64cf245fd82c.png)  |  ![](https://user-images.githubusercontent.com/11228182/45780701-c3fdf580-bc7b-11e8-9f48-0d883a640010.png)

- This package supports the option of overriding the package views that Laravel provides. You can modify the view using [these instructions from the Laravel docs](https://laravel.com/docs/packages#views), as per your needs.

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
