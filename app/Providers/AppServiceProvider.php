<?php

namespace App\Providers;

use App\Enums\ShippingPaymentType;
use Brick\Money\Money;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
        Blade::stringable(function (Money $money) {
            return $money->formatTo('vn_VN');
        });

        Blade::stringable(fn(ShippingPaymentType $type) => $type->labels());
    }
}
