<?php

namespace App\Filament\Clusters\Empreendimentos\EmpresaResource\Pages;

use App\Filament\Clusters\Empreendimentos\EmpresaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEmpresas extends ListRecords
{
    protected static string $resource = EmpresaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
