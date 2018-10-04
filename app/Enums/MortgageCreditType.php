<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class MortgateCreditType extends Enum
{
  const INFONAVIT = 'INFONAVIT';
  const FOVISSSTE = 'FOVISSSTE';
  const COFINAVIT = 'COFINAVIT';
  const BANKING = 'Bancario';
  const ALLIES = 'Aliados';
}
