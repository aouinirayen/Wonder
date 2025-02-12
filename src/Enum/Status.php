<?php
namespace App\Enum;

enum Status: string
{
    case EN_COURS = 'en_cours';
    case TERMINE = 'termine';
    case ANNULE = 'annule';
}

