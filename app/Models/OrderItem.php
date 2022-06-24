<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Brick\Money\Money;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'qty',
        'product_name',
        'variation_string',
        'sku_id',
    ];

    protected $casts = [
        'price' => MoneyCast::class,
    ];

    public function sku()
    {
        return $this->belongsTo(SKU::class, 'sku_id', 'id');
    }

    public function getAmountAttribute()
    {
        return $this->price->multipliedBy($this->qty);
    }
}
