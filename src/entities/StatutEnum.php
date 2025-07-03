<?php
namespace App\Entity;

enum StatutEnum: string
{
    case IMPAYE = 'impayé';
    case PAYE = 'payé';
}
