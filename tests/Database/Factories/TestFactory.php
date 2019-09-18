<?php

use JoaonzangoII\MailViewer\Tests\Stubs\Models\Test;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(Test::class, function () {
    return [
        'is_awesome' => 'no'
    ];
});

$factory->state(Test::class, 'is-awesome', [
    'is_awesome' => 'yes'
]);
