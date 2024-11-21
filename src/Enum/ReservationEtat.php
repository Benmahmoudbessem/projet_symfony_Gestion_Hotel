<?php
namespace App\Enum;

enum ReservationEtat: string
{
    case CONFIRMER = 'confirmer';
    case ANNULEE = 'annulee';
}
