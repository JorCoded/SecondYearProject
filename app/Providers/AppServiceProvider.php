<?php

namespace App\Providers;
use App\Faker\HotelProvider;
use App\Services\AuthService;
use App\View\Composers\AuthComposer;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
                $this->app->singleton(AuthService::class, function ($app) {
            return new AuthService();
        });
    
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->singleton(Generator::class, function(){
            $faker = Factory::create();
            $faker->addProvider(new HotelProvider($faker));
            return $faker;
        
        });

        View::composer('*', AuthComposer::class);
    }
}
