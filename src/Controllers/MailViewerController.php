<?php

namespace JoggApp\MailViewer\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;
use JoggApp\MailViewer\MailViewer;

class MailViewerController extends Controller
{
    public function __construct()
    {
        abort_unless(
            App::environment(config('mailviewer.allowed_environments', ['local'])),
            403
        );
    }

    public function index()
    {
        $mails = MailViewer::all();

        return view('mailviewer::index', compact('mails'));
    }

    public function show($mail)
    {
        return MailViewer::find($mail);
    }
}
