<?php

namespace App\Filament\Clusters\Empreendimentos\ImovelResource\Pages;

use App\Filament\Clusters\Empreendimentos\ImovelResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditImovel extends EditRecord
{
    protected static string $resource = ImovelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
