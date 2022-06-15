<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SKU extends Model
{
    use HasFactory;

    protected $table = 'skus';

    protected $fillable = [
        'activity',
        'weight',
        'price',
        'stock',
        'product_id',
    ];

    protected $casts = [
        'activity' => 'bool',
        'weight' => 'integer',
        'price' => 'decimal',
        'stock' => 'integer',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    private function variationValues()
    {
        return $this->hasMany(VariationValue::class, 'sku_id');
    }
}
