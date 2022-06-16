<?php

namespace App\Models;

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
        // 'price' => 'decimal',
        'stock' => 'integer',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // public function variationValues()
    // {

    //     return $this->hasManyThrough(VariationValue::class, ProductVariation::class, 'sku_id', 'id', 'id', 'variation_value_id');

    //     // ^ "select * from `variation_values` inner join `product_variations` on `product_variations`.`c` = `variation_values`.`a` where `product_variations`.`sku_id` is null"
    //     // return $this->hasManyThrough(VariationValue::class, ProductVariation::class, 'sku_id', 'a', 'b', 'c', 'd');
    // }

    public function variationValues()
    {
        return $this->belongsToMany(VariationValue::class, 'product_variations', 'sku_id');
    }
}
