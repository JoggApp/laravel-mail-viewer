<?php

namespace JoggApp\MailViewer;

use Exception;
use Illuminate\Support\Facades\Config;
use ReflectionClass;

class MailViewer
{
    public static function all()
    {
        $mailables = config('mailviewer.mailables', []);

        $mails = [];

        foreach ($mailables as $mailable) {
            $reflection = new ReflectionClass($mailable);

            $mails[] = $reflection->getShortName();
        }

        return $mails;
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
        return config('mailviewer.url', 'mails');
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
