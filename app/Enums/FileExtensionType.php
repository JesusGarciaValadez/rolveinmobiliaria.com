<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class FileExtensionType extends Enum
{
    const PDF = 'pdf';
    const DOC = 'doc';
    const DOCX = 'docx';
}
