<?php

namespace App\Filament\Resources\EmpreendimentoResource\Pages;

use App\Filament\Resources\EmpreendimentoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateEmpreendimento extends CreateRecord
{
    protected static string $resource = EmpreendimentoResource::class;


    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Atribui o ID do usuário autenticado ao campo Usuario_id
        $data['Usuario_id'] = Auth::id();

        return $data;
    }
}
