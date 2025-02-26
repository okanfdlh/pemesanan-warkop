<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route; 
use App\Models\Product;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
{
    View::composer('*', function ($view) {
        $cartCount = Session::has('cart') ? count(Session::get('cart')) : 0;
        $view->with('cartCount', $cartCount);
        $view->with('products', Product::all());
    });
}
protected function mapApiRoutes()
{
    Route::middleware('api')
         ->prefix('api')
         ->group(base_path('routes/api.php'));
}
}
