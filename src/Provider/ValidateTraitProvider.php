<?php

namespace QuantumTecnology\ValidateTrait\Provider;

use QuantumTecnology\ValidateTrait\Data;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class ValidateTraitProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        Request::macro('data', function ($key = null, $value = null) {
            if (is_null($key)) {
                return $this->input('data')['validated'] ?? app(Data::class);
            }

            if (is_null($value)) {
                return $this->input('data')[$key] ?? app(Data::class);
            }

            $data       = $this->input('data', []);
            $data[$key] = $value;
            $this->merge(['data' => $data]);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
