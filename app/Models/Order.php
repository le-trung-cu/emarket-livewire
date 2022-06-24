<?php

namespace App\Models;

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

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
