<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class CivilStatusType extends Enum
{
    const INDIVIDUAL = 'Individual';
    const CONJUGAL = 'Conyugal';
    const SINGLE = 'Soltero';
    const MARRIED = 'Casado';
}
