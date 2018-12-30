<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class PriorityType extends Enum
{
    const LOW = 'Baja';
    const MEDIUM = 'Media';
    const HIGH = 'Alta';
}
