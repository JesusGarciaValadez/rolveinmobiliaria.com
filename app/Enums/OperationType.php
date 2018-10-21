<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class OperationType extends Enum
{
  const SALES = 'Venta';
  const RENT = 'Renta';
  const EXCLUSIVE_CONTRACTS = 'Contratos de exclusividad';
  const LEGAL = 'Jurídico';
  const APPRAISALS = 'Avalúos';
}
