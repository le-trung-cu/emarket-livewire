<?php

namespace App\Models;

use App\Casts\MoneyCast;
use App\Enums\OrderStatus;
use App\Enums\PaymentType;
use App\Enums\ShippingPaymentType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_branch_id',
        'buyer_id',
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
        'payment_status',
    ];

    protected $casts = [
        'amount' => MoneyCast::class,
        'shipping_fee' => MoneyCast::class,
        'discount' => MoneyCast::class,
        'payment_type' => PaymentType::class,
        'shipping_payment_type' => ShippingPaymentType::class,
        'status' => OrderStatus::class,
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function children()
    {
        return $this->hasMany(Order::class, 'group_id', '1');
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function storeBranch()
    {
        return $this->belongsTo(StoreBranch::class);
    }
}
