<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class MortgageCreditType extends Enum
{
    const INFONAVIT = 'INFONAVIT';
    const FOVISSSTE = 'FOVISSSTE';
    const COFINAVIT = 'COFINAVIT';
    const BANKING = 'Bancario';
    const ALLIES = 'Aliados';
}
