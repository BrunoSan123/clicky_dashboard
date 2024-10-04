<?php

namespace App\Filament\Resources\ContratoResource\Pages;

use App\Filament\Resources\ContratoResource;
use Filament\Actions;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Pages\ListRecords;

class ListContratos extends ListRecords
{
    protected static string $resource = ContratoResource::class;

    use ExposesTableToWidgets;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
