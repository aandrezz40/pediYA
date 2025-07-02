<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use App\Models\Order;
use App\Models\OrderItem;

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
public function boot(): void
{


View::composer('layouts.navigation', function ($view) {
    if (auth()->check()) {
        $user = auth()->user();

        // Filtra solo las órdenes con estado 'inactive'
        $orders = $user->orders()
            ->where('status', 'inactive')
            ->with(['orderItems.product', 'store'])
            ->get();

        // Total en dinero
        $totalOrdersAmount = $orders->sum('total_amount');

        // Total en cantidad de órdenes
        $totalOrdersCount = $orders->count();

        // Pasar los datos a la vista
        $view->with([
            'orders' => $orders,
            'totalOrdersAmount' => $totalOrdersAmount,
            'totalOrdersCount' => $totalOrdersCount,
        ]);
    }
});

}
}
