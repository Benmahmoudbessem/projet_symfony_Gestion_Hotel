<?php
namespace App\Enum;

enum ChambreEtat: string
{
    case LIBRE = 'libre';
    case OCCUPEE = 'occupee';
    case RESERVEE = 'reservee';
    case AUTRES = 'autres';

}
