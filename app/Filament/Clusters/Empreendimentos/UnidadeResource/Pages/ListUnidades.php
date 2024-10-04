<?php

namespace App\Filament\Clusters\Empreendimentos\UnidadeResource\Pages;

use App\Filament\Clusters\Empreendimentos\Resources\EmpreendimentoResource\Widgets\Empreendimento_status;
use App\Filament\Clusters\Empreendimentos\UnidadeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUnidades extends ListRecords
{
    protected static string $resource = UnidadeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets():array{
        return[
            Empreendimento_status::class
        ];
    }

    protected function getFooterWidgets():array{
        return [
            
        ];
    }
}
