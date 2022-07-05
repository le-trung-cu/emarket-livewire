<?php

namespace App\Casts;

use Brick\Money\Money;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class MoneyCast implements CastsAttributes
{
    /**
     * Transform the attribute from the underlying model values.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function get($model, string $key, $value, array $attributes)
    {
        return $value == null ? null : Money::of($value, config('settings.currency_code'));
    }

    /**
     * Transform the attribute to its underlying model values.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function set($model, string $key, $value, array $attributes)
    {
        if ($value instanceof Money) {
            return (int)(string) $value->getAmount();
        }
        return $value;
    }
}
