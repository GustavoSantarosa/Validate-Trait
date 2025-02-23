<?php

/*
 * Helpers.
 */

if (!function_exists('data')) {
    function data(object|array $data = []): QuantumTecnology\ValidateTrait\Data
    {
        return request()->data()->merge($data);
    }
}
