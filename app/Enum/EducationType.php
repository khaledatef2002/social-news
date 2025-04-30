<?php

namespace App\Enum;

enum EducationType: string
{
    case PRIMARY = 'primary';
    case SECONDARY = 'secondary';
    case BACHELORS = 'bachelors';
    case MASTERS = 'masters';
    case DOCTORATE = 'doctorate';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
