<?php

namespace JoggApp\MailViewer;

use Exception;
use Illuminate\Support\Facades\Config;
use ReflectionClass;

class MailViewer
{
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

    public static function all()
    {
        $mailables = config('mailviewer.mailables', []);

        return empty($mailables) ? [] : self::prepareMails($mailables);
    }

    public static function find(string $mail)
    {
        foreach (config('mailviewer.mailables', []) as $mailable => $dependencies) {
            $reflection = new ReflectionClass($mailable);

            if ($reflection->getShortName() === $mail) {
                $args = [];

                foreach ($dependencies as $dep) {
                    $args[] = class_exists($dep) ? factory($dep)->create() : $dep;
                }

                return new $mailable(...$args);
            }
        }

        throw new Exception("No mailable called {$mail} is registered in config/mailviewer.php file");
    }

    public static function prepareMails(array $mailables): array
    {
        $mails = [];

        foreach ($mailables as $mailable => $dependencies) {
            $reflection = new ReflectionClass($mailable);

            $givenParameters = [];

            foreach ($dependencies as $dependency) {
                $givenParameters[] = class_exists($dependency)
                    ? (new ReflectionClass($dependency))->getName()
                    : getType($dependency);
            }

            $constructorParameters = [];

            foreach ($reflection->getConstructor()->getParameters() as $parameter) {
                $constructorParameters[] = $parameter->getType()->getName();
            }

            if ($constructorParameters !== $givenParameters) {
                throw new Exception(
                    "The arguments passed for {$mailable} in the config/mailviewer.php file do not match with the constructor params of the {$mailable} class"
                );
            }

            $mails[] = $reflection->getShortName();
        }

        return $mails;
    }
}
