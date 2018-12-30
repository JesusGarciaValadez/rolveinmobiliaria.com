<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ExpedientKeyType extends Enum
{
    const VNT = 'VNT';
    const RNT = 'RNT';
    const CEX = 'CEX';
    const JRD = 'JRD';
    const AVA = 'AVA';
}
