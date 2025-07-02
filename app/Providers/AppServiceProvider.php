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

                $orders = $user->orders()
                    ->where('status', 'inactive')
                    ->with(['orderItems.product', 'store'])
                    ->get();

                $totalOrdersAmount = $orders->sum('total_amount');
                $totalOrdersCount = $orders->count();

                $view->with([
                    'orders' => $orders,
                    'totalOrdersAmount' => $totalOrdersAmount,
                    'totalOrdersCount' => $totalOrdersCount,
                ]);
            }
        });
    }
}
