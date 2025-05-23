<?php

namespace App\Enum;

enum AdPages: string
{
    case Home = 'home';
    case About = 'about';
    case Contact = 'contact';
    case Media = 'media';
    case Writers = 'writers';
    case Summaries = 'summaries';

    public static function list(): array
    {
        return [
            self::Home->value,
            self::About->value,
            self::Contact->value,
            self::Media->value,
            self::Writers->value,
            self::Summaries->value
        ];
    }
}
