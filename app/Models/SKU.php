<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SKU extends Model
{
    use HasFactory;

    protected $table = 'skus';

    protected $fillable = [
        'barcode',
        'activity',
        'weight',
        'price',
        'stock',
        'product_id',
    ];

    protected $casts = [
        'activity' => 'boolean',
        'weight' => 'integer',
        'price' => MoneyCast::class,
        'stock' => 'integer',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function variationValues()
    {
        return $this->belongsToMany(VariationValue::class, 'product_variations', 'sku_id');
    }

    public function getPriceValueAttribute()
    {
        return $this->attributes['price'];
    }
}
