<?php

namespace GustavoSantarosa\ValidateTrait;

use Illuminate\Support\Str;

trait ValidateTrait
{
    /**
     * Validate function.
     */
    public function validate(object|string $requestClass = null, bool $toArray = false): object|array
    {
        if (!$requestClass) {
            $requestClass = $this->defineClassBindRequest();
        }

        $request = app($requestClass)->validated();

        return $toArray ? (array) $request : (object) $request;
    }

    /**
     * DefineClassBindRequest function.
     *
     * @throws Exception request file not found
     */
    private function defineClassBindRequest(): string
    {
        $action = Request()->route()->getActionMethod();

        $requestPrefixes = ['App', 'HTTP', 'Requests'];

        foreach (explode('\\', static::class) as $prefix) {
            if ('App' !== $prefix && 'Services' !== $prefix && $prefix !== class_basename(static::class)) {
                $requestPrefixes[] = $prefix;
            }
        }

        $requestPrefixes[] = Str::Replace('Service', '', class_basename(static::class));
        $requestPrefixes[] = Str::ucfirst(Str::camel($action)) . 'Request';

        $class = implode('\\', $requestPrefixes);

        if (!class_exists($class)) {
            throw new \Exception("The Request file {$class} does not exists.");
        }

        return $class;
    }
}
