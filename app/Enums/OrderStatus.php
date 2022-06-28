<?php

namespace App\Enums;

enum OrderStatus: string
{
    case PENDING            = 'pending';
    case REGISTERED         = 'registered';
    case PACKING            = 'packing';
    case SENT               = 'sent';
    case COMPLATED          = 'complated';
    case CANCELED           = 'canceled';

    public function labels(): string
    {
        return match ($this) {
            self::PENDING         => 'Pending',
            self::REGISTERED      => 'Registered',
            self::PACKING         => 'Packing',
            self::SENT            => 'Sent',
            self::COMPLATED       => 'Complated',
            self::CANCELED        => 'Canceled',
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
