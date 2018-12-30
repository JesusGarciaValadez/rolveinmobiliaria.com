<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class RoleType extends Enum
{
    const SUPER_ADMIN = 'Super Administrador';
    const ADMIN = 'Administrador';
    const ASSISTANT = 'Asistente';
    const SALES = 'Ventas';
    const INTERN = 'Pasante';
    const CLIENT = 'Cliente';
}
