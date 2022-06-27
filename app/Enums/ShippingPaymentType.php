<?php

namespace App\Enums;

enum ShippingPaymentType: string
{
    case SHOP_PAY         = 'shop_pay';
    case BUYER_PAY        = 'buyer_pay';

    public function labels(): string
    {
        return match ($this) {
            self::SHOP_PAY           => 'Shop pay',
            self::BUYER_PAY          => 'Buyer pay',
        };
    }

    /**
     * Sends labels to PowerGrid Enum Input
     *
     */
    public function labelPowergridFilter(): string
    {
        return $this->labels();
    }
}
