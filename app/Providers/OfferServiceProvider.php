<?php

namespace App\Providers;

use App\Repositories\Contracts\OfferRepositoryInterface;
use App\Repositories\OfferRepository;
use App\Services\Contracts\OfferServiceInterface;
use App\Services\OfferService;
use Illuminate\Support\ServiceProvider;

class OfferServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(OfferServiceInterface::class,OfferService::class);
        $this->app->bind(OfferRepositoryInterface::class,OfferRepository::class);
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
