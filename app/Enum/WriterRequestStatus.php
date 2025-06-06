<?php

namespace App\Enum;

enum WriterRequestStatus: string
{
    case PENDING = "pending";
    case APPROVED = "approved";
    case REJECTED = "rejected";

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
