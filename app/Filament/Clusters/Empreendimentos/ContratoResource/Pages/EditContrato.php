<?php

namespace App\Filament\Clusters\Empreendimentos\ContratoResource\Pages;

use App\Filament\Clusters\Empreendimentos\ContratoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditContrato extends EditRecord
{
    protected static string $resource = ContratoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
