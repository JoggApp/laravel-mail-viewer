<?php

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
