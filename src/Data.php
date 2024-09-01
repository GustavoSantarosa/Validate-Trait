<?php

namespace GustavoSantarosa\ValidateTrait;

use Illuminate\Support\Str;

class Data
{
    public function __construct(array|object $data)
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    public function __get(string $name): mixed
    {
        return $this->$name ?? null;
    }

    public function __set(string $name, mixed $value): void
    {
        $this->$name = $value;
    }

    public function toArray(): array
    {
        return (array) $this;
    }

    public function toObject(): object
    {
        return json_decode(json_encode($this));
    }

    public function toJson(): string
    {
        return json_encode($this);
    }

    public function toUpperCamelCase(
        array $exception = [],
        bool $excludeException = true
    ): object {
        $data = $this->toArray();
        $data = $this->arrayKeyUcfirst(
            $data,
            $exception,
            $excludeException
        );

        return new Data($data);
    }

    private function arrayKeyUcfirst(
        array|object $data,
        array $exception = [],
        bool $excludeException = true
    ): array {
        $data_modify = [];

        foreach ($data as $key => $value) {
            if (!in_array($key, $exception)) {
                if (is_string($value) || is_numeric($value)) {
                    $data_modify[ucfirst(Str::camel($key))] = $value;
                } elseif (is_array($value)) {
                    $data_modify[ucfirst(Str::camel($key))] = $this->arrayKeyUcfirst($value, $exception);
                }

                continue;
            }

            if (!$excludeException) {
                $data_modify[$key] = $value;
                continue;
            }
        }

        return $data_modify;
    }
}
