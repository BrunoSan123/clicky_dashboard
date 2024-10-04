<?php

namespace App\Filament\Clusters\Empreendimentos\ImovelResource\Pages;

use App\Filament\Clusters\Empreendimentos\ImovelResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateImovel extends CreateRecord
{
    protected static string $resource = ImovelResource::class;
}
