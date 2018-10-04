<?php

namespace JoggApp\MailViewer;

use Exception;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;
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
        $eloquentFactory = app(EloquentFactory::class);

        foreach (config('mailviewer.mailables', []) as $mailable => $dependencies) {
            $reflection = new ReflectionClass($mailable);

            if ($reflection->getShortName() === $mail) {
                $args = [];

                foreach ($dependencies as $dependency) {
                    $factoryStates = [];

                    if (is_array($dependency)) {
                        if (in_array('states', array_keys($dependency))) {
                            $factoryStates = $dependency['states'];
                            $dependency = $dependency['class'];
                        }
                    }

                    if (is_string($dependency) && class_exists($dependency)) {
                        if (isset($eloquentFactory[$dependency])) {
                            $args[] = factory($dependency)->states($factoryStates)->make();
                        } else {
                            $args[] = app($dependency);
                        }
                    } else {
                        $args[] = $dependency;
                    }
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
                if (is_array($dependency)) {
                    if (in_array('states', array_keys($dependency))) {
                        $dependency = $dependency['class'];
                    }
                }

                $givenParameters[] = is_string($dependency) && class_exists($dependency)
                    ? (new ReflectionClass($dependency))->getName()
                    : getType($dependency);
            }

            $constructorParameters = [];

            foreach ($reflection->getConstructor()->getParameters() as $parameter) {
                $constructorParameters[] = $parameter->getType()->getName() == 'int' ? 'integer' : $parameter->getType()->getName();
            }

            if ($constructorParameters !== $givenParameters) {
                throw new Exception(
                    "The arguments passed for {$mailable} in the config/mailviewer.php file do not match with the constructor
                    params of the {$mailable} class or the constructor params of the {$mailable} class aren't typehinted"
                );
            }

            $mails[] = $reflection->getShortName();
        }

        return $mails;
    }
}
