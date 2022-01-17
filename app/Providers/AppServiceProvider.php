<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Categories;
use App\Models\SubCategories;
use Carbon\Carbon;
use App\Observers\CategoriesObserver;
use App\Observers\SubCategoriesObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //setlocale(LC_TIME, 'es');
        //Carbon::setLocale('pt_BR');

        Carbon::setUTF8(true);
        Carbon::setLocale(config('app.locale'));
        setlocale(LC_TIME, config('app.locale'));

        Categories::observe(CategoriesObserver::class);
        SubCategories::observe(SubCategoriesObserver::class);
        
    }
}
