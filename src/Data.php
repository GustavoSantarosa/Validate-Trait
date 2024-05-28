<?php

namespace GustavoSantarosa\ValidateTrait;

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
}
