<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_branch_id',
        'group_id',
        'amount',
        'shipping_fee',
        'shipping_payment_type',
        'payment_type',
        'discount',
        'service_type_id_ghn',
        'recipient_name',
        'recipient_phone',
        'shipping_address',
        'ward_code',
        'district_id',
        'print_token_ghn',
        'status',
    ];

    protected $cats = [
        'amount' => MoneyCast::class,
        'shipping_fee' => MoneyCast::class,
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function children()
    {
        return $this->hasMany(Order::class, 'group_id', '1');
    }
}
