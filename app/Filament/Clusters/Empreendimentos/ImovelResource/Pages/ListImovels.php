<?php

namespace App\Filament\Clusters\Empreendimentos\ImovelResource\Pages;

use App\Filament\Clusters\Empreendimentos\ImovelResource;
use App\Filament\Clusters\Empreendimentos\Resources\EmpreendimentoResource\Widgets\Empreendimento_status;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListImovels extends ListRecords
{
    protected static string $resource = ImovelResource::class;

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
