<?php declare(strict_types=1);

namespace App\Enums\Synerg;

use BenSampo\Enum\Enum;

final class LegalNatureRole extends Enum
{
    #[Description('Administração Pública')]
    const Administração_Pública = 1;
    #[Description('Entidades Empresariais')]
    const Entidades_Empresariais = 2;
    #[Description('Entidades Sem Fins Lucrativos')]
    const Entidades_Sem_Fins_Lucrativos = 3;
    #[Description('Pessoas Físicas')]
    const Pessoas_Físicas = 4;
    #[Description('Instituições Extra Territoriais')]
    const Instituições_Extra_Territoriais = 5;
}
