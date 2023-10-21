<?php

namespace GustavoSantarosa\ValidateTrait\Provider;

use Illuminate\Support\ServiceProvider;

class ValidateTraitProvider extends ServiceProvider
{
    public $bindings = [
        ServerProvider::class => ValidateTrait::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
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
