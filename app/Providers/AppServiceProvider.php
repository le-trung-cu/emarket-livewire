<?php

namespace App\Providers;

use App\Enums\ShippingPaymentType;
use App\Models\Setting;
use Brick\Money\Money;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Config;
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
            return $money->formatTo(config('settings.currency_format'));
        });

        Blade::stringable(fn(ShippingPaymentType $type) => $type->labels());
    }
}
