<?php

namespace SON\Providers;

use Faker\Factory;
use Faker\Generator as FakerGenerator;
use Faker\Factory as FakerFactory;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Schema::defaultStringLength(191);
        \Validator::extend('choice_true', function($attribute,$value,$parameters,$validator){
           $items = collect($value)->filter(function($item){
              return isset($item['true']) && $item['true']!== false;
           });

           return $items->count() === 1;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }

        $this->app->extend(FakerGenerator::class, function(){
           return FakerFactory::create('pt_BR');
        });
    }
}
