<?php

namespace App\Filament\Clusters\Empreendimentos\ContratoResource\Pages;

use App\Filament\Clusters\Empreendimentos\ContratoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListContratos extends ListRecords
{
    protected static string $resource = ContratoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
