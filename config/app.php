<?php

return [
    'name'            => env('APP_NAME', 'Three Queen Interior Admin'),
    'env'             => env('APP_ENV', 'production'),
    'debug'           => (bool) env('APP_DEBUG', false),
    'url'             => env('APP_URL', 'http://localhost'),
    'timezone'        => 'Asia/Jakarta',
    'locale'          => 'id',
    'fallback_locale' => 'en',
    'faker_locale'    => 'id_ID',
    'cipher'          => 'AES-256-CBC',
    'key'             => env('APP_KEY'),
    'maintenance'     => ['driver' => 'file'],
    'providers' => \Illuminate\Support\ServiceProvider::defaultProviders()->toArray(),
    'aliases'  => \Illuminate\Support\Facades\Facade::defaultAliases()->toArray(),
];
