<?php

namespace App\Enums;

enum PaymentStatus: string
{
    case UNPAID          = 'unpaid';
    case SUNCCESS        = 'success';
    case FAIL            = 'fail';

    public function labels(): string
    {
        return match ($this) {
            self::UNPAID       => 'Unpaid',
            self::SUNCCESS     => 'Payment success',
            self::FAIL         => 'Fail',
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
