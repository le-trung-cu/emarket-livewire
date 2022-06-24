<?php

namespace App\Models;

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

    public function children()
    {
        return $this->hasMany(Order::class, 'group_id', 'id');
    }
}
