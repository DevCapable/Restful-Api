<?php

namespace App\Providers;

use App\Repo\Eloquent\Api\ProductRepository;
use App\Repo\Eloquent\ProductRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class ProductRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
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
