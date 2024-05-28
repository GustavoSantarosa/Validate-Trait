<?php

namespace GustavoSantarosa\ValidateTrait;

use Illuminate\Support\Str;
use GustavoSantarosa\ValidateTrait\Data;

trait ValidateTrait
{
    /**
     * Validate function.
     */
    public function validate(object|string|null $requestClass = null, bool $toArray = false, bool $toUpperCamelCase = false): object|array
    {
        if (!$requestClass) {
            $requestClass = $this->defineClassBindRequest();
        }

        $request = app($requestClass)->validated();

        $data = $toUpperCamelCase ? $this->arrayKeyUcfirst($request) : $request;
        $data = new Data($data);
        $data = $toArray ? $data->toArray() : $data->toObject();

        return $data;
    }

    // preciso fazer um metodo magico para fazer get de atributos que podem nao existir
    /*  public function __get(string $name): mixed
     {
         return $this->$name;
     } */

    /**
     * DefineClassBindRequest function.
     *
     * @throws Exception request file not found
     */
    private function defineClassBindRequest(): string
    {
        $action = Request()->route()->getActionMethod();

        $requestPrefixes = ['App', 'Http', 'Requests'];

        foreach (explode('\\', static::class) as $prefix) {
            if ('App' !== $prefix && 'Services' !== $prefix && $prefix !== class_basename(static::class)) {
                $requestPrefixes[] = $prefix;
            }
        }

        $requestPrefixes[] = Str::Replace('Service', '', class_basename(static::class));
        $requestPrefixes[] = Str::ucfirst(Str::camel($action)).'Request';

        $class = implode('\\', $requestPrefixes);

        if (!class_exists($class)) {
            throw new \Exception("The Request file {$class} does not exists.");
        }

        return $class;
    }

    private function arrayKeyUcfirst(array|object $data, array $exception = []): array
    {
        $data_modify = [];
        foreach ($data as $key => $value) {
            if (!in_array($key, $exception)) {
                if (is_string($value) || is_numeric($value)) {
                    $data_modify[ucfirst(Str::camel($key))] = $value;
                } elseif (is_array($value)) {
                    $data_modify[ucfirst(Str::camel($key))] = $this->arrayKeyUcfirst($value, $exception);
                }
            }
        }

        return $data_modify;
    }
}
