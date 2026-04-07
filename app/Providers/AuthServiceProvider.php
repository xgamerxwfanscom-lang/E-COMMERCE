<?php

namespace App\Providers;

use App\Models\Producto;
use App\Policies\ProductoPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Producto::class => ProductoPolicy::class,
    ];

    public function boot(): void
    {
        //
    }
}