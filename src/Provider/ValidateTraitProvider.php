<?php

namespace GustavoSantarosa\ValidateTrait\Provider;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;

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
                return $this->input('data')['validated'];
            }

            if (is_null($value)) {
                return $this->input('data')[$key] ?? null;
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
        //
    }
}
