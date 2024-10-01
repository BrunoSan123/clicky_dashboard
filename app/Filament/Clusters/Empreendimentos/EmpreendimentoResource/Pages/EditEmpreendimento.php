<?php

namespace App\Filament\Clusters\Empreendimentos\EmpreendimentoResource\Pages;

use App\Filament\Clusters\Empreendimentos\EmpreendimentoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEmpreendimento extends EditRecord
{
    protected static string $resource = EmpreendimentoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
