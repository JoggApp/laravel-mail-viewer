<?php

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
    | create those factories. Also, don't forget to import
    | these classes at the top :)
    |
    | eg: 'mailables' => [
    |       OrderShipped::class => [
    |          Order::class,
    |         'Personal thank you message',
    |       ],
    |      MailWithNoDependency::class => []
    |    ]
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
