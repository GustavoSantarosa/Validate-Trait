<?php

namespace QuantumCode\ValidateTrait;

use Illuminate\Support\Str;

class Data
{
    protected bool $populate = false;

    public function __construct(array|object $data = [])
    {
        foreach ($data as $key => $value) {
            $this->populate = true;
            $this->$key     = $value;
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
        $publicProperties = [];

        foreach ($this as $key => $value) {
            $reflection = new \ReflectionProperty($this, $key);
            if ($reflection->isPublic()) {
                $publicProperties[$key] = $value;
            }
        }

        return $publicProperties;
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

    public function check(): bool
    {
        return $this->populate;
    }

    public function merge(array|object $data = []): self
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }

        return $this;
    }

    public function only(array $keys): object
    {
        $data = $this->toArray();
        $data = array_filter($data, fn ($key) => in_array($key, $keys), ARRAY_FILTER_USE_KEY);

        return new Data($data);
    }

    public function except(array $keys): object
    {
        $data = $this->toArray();
        $data = array_filter($data, fn ($key) => !in_array($key, $keys), ARRAY_FILTER_USE_KEY);

        return new Data($data);
    }

    public function has(string $key): bool
    {
        return isset($this->$key);
    }

    public function isEmpty(): bool
    {
        return empty($this->toArray());
    }

    public function isNotEmpty(): bool
    {
        return !empty($this->toArray());
    }

    public function dd(): void
    {
        dd($this);
    }

    public function dump(): self
    {
        dump($this);

        return $this;
    }
}
