<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;
use App\Models\Order;
use App\Models\OrderItem;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if (env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }

        View::composer('layouts.navigation', function ($view) {
            if (auth()->check()) {
                $user = auth()->user();
                
                // Obtener órdenes activas del usuario
                $orders = Order::with(['store', 'orderItems.product'])
                    ->where('user_id', $user->id)
                    ->whereIn('status', ['inactive'])
                    ->get();

                $totalOrdersCount = $orders->count();
                $totalOrdersAmount = $orders->sum('total_amount');

                $view->with([
                    'totalOrdersCount' => $totalOrdersCount,
                    'totalOrdersAmount' => $totalOrdersAmount,
                    'orders' => $orders
                ]);
            } else {
                $view->with([
                    'totalOrdersCount' => 0,
                    'totalOrdersAmount' => 0,
                    'orders' => collect([])
                ]);
            }
        });
    }
}
