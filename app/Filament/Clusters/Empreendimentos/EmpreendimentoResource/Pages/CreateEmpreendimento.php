<?php

namespace App\Filament\Clusters\Empreendimentos\EmpreendimentoResource\Pages;

use App\Filament\Clusters\Empreendimentos\EmpreendimentoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateEmpreendimento extends CreateRecord
{
    protected static string $resource = EmpreendimentoResource::class;


    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Atribui o ID do usuário autenticado ao campo Usuario_id

        return $data;
    }
}
