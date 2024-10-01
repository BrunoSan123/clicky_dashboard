<?php

namespace App\Filament\Clusters\Empreendimentos\EmpreendimentoResource\Pages;

use App\Filament\Clusters\Empreendimentos\EmpreendimentoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEmpreendimentos extends ListRecords
{
    protected static string $resource = EmpreendimentoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
