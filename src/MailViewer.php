<?php

namespace JoaonzangoII\MailViewer;

use Exception;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Illuminate\Support\Facades\DB;
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
        DB::beginTransaction();

        $eloquentFactory = app(EloquentFactory::class);

        foreach (config('mailviewer.mailables', []) as $mailable => $dependencies) {
            $reflection = new ReflectionClass($mailable);

            if ($reflection->getName() === $mail) {
                $args = [];

                foreach ($dependencies as $dependency) {
                    $factoryStates = [];

                    if (is_array($dependency)) {
                        if (in_array('states', array_keys($dependency), true)) {
                            $factoryStates = $dependency['states'];
                            $dependency = $dependency['class'];
                        }
                    }

                    if (is_string($dependency) && class_exists($dependency)) {
                        if (isset($eloquentFactory[$dependency])) {
                            $args[] = factory($dependency)->states($factoryStates)->create();
                        } else {
                            $args[] = app($dependency);
                        }
                    } else {
                        $args[] = $dependency;
                    }
                }

                return new $mailable(...$args);
            }

            DB::rollBack();
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
                    if (in_array('states', array_keys($dependency), true)) {
                        $dependency = $dependency['class'];
                    }
                }
                
                if (is_object($dependency)) {
                    $givenParameters[] = get_class($dependency);
                    continue;
                }

                $givenParameters[] = is_string($dependency) && class_exists($dependency)
                    ? (new ReflectionClass($dependency))->getName()
                    : getType($dependency);
            }

            $constructorParameters = [];

            for ($i = 0; $i < count($reflection->getConstructor()->getParameters()); $i++) {
                $parameter = $reflection->getConstructor()->getParameters()[$i];

                if (empty($parameter->getType())) {
                    $constructorParameters[$i] = $givenParameters[$i];
                    continue;
                }

                $constructorParameters[] = $parameter->getType()->getName() == 'int' ? 'integer' : $parameter->getType()->getName();
            }
            
            foreach ($givenParameters as $i => $param) {
                if (! class_exists($param) && $param === $constructorParameters[$i]) {
                    continue;
                }
                
                $class = new ReflectionClass($param);
                $lineage = [];
    
                do {
                    $lineage[] = $class->getName();
                    $lineage = array_unique(array_merge($lineage, $class->getTraitNames(), $class->getInterfaceNames()));
                } while ($class = $class->getParentClass());
                
                if ( count(array_intersect($lineage, $constructorParameters)) !== 0) {
                    continue;
                }
                
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