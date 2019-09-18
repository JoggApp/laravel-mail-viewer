<?php

use Illuminate\Support\Facades\Route;
use JoaonzangoII\MailViewer\MailViewer;

Route::get(MailViewer::url(), 'JoaonzangoII\MailViewer\Controllers\MailViewerController@index')
    ->middleware(MailViewer::middlewares());

Route::get(MailViewer::url() . '/{mail}', 'JoaonzangoII\MailViewer\Controllers\MailViewerController@show')
    ->middleware(MailViewer::middlewares())
    ->name('mv-mailviewer');
