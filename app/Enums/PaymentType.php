<?php

namespace App\Enums;

enum PaymentType: string
{
    case CASH               = 'cash';
    case CREDIT_CARD        = 'credit_card';
    case BANK_TRANSFER      = 'bank_transfer';
    case PAYPAL             = 'paypal';

    public function labels(): string
    {
        return match($this) {
            self::CASH                  => 'Cash',
            self::CREDIT_CARD           => 'Credit card',
            self::BANK_TRANSFER         => 'Bank transfer',
            self::PAYPAL                => 'Paypal',
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
