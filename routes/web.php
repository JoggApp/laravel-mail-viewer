<?php

use Illuminate\Support\Facades\Route;
use JoggApp\MailViewer\MailViewer;

Route::get(MailViewer::url(), 'JoggApp\MailViewer\Controllers\MailViewerController@index')
    ->middleware(MailViewer::middlewares());

Route::get(MailViewer::url() . '/{mail}', 'JoggApp\MailViewer\Controllers\MailViewerController@show')
    ->middleware(MailViewer::middlewares())
    ->name('mv-mailviewer');
