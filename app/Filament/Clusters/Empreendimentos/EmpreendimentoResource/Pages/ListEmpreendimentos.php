<?php

namespace App\Filament\Clusters\Empreendimentos\EmpreendimentoResource\Pages;

use App\Filament\Clusters\Empreendimentos\EmpreendimentoResource;
use App\Filament\Widgets\Contratos_Status;
use App\Livewire\Empreendimento_Status;
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

    protected function getHeaderWidgets():array{
        return[
            Empreendimento_Status::class,
        ];
    }

    protected function getFooterWidgets():array{
        return [
            
        ];
    }

}
