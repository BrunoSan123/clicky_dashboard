<?php

namespace App\Filament\Resources\EmpreendimentoResource\Pages;

use App\Filament\Resources\EmpreendimentoResource;
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
