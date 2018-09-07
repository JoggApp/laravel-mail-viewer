<?php

namespace JoggApp\MailViewer;

use Exception;
use Illuminate\Support\Facades\Config;
use ReflectionClass;

class MailViewer
{
    public static function all()
    {
        $files = scandir(app_path('Mail'));

        $mails = [];

        foreach ($files as $file) {
            $mails[] = str_before($file, '.');
        }

        return array_slice($mails, 2);
    }

    public static function find(string $mail)
    {
        foreach (config('mailviewer.mailables', []) as $mailable) {
            $reflection = new ReflectionClass($mailable);

            if ($reflection->getShortName() === $mail) {
                return $mailable;
            }
        }

        throw new Exception("No mailable called {$mail} is registered in config/mailviewer.php file");
    }

    public static function url()
    {
        $url = config('mailviewer.url', 'mails');

        if ((!empty($url)) && is_string($url)) {
            return $url;
        }

        throw new Exception('Please set a valid URL to view the mails');
    }

    public static function middlewares()
    {
        $middlewares = config('mailviewer.middlewares', []);

        if (is_array($middlewares)) {
            return $middlewares;
        }

        throw new Exception('The middlewares config value only excepts an array');
    }
}
