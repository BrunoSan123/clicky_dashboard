<?php

namespace App\Filament\Resources\EmpresaResource\Pages;

use App\Filament\Resources\EmpresaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateEmpresa extends CreateRecord
{
    protected static string $resource = EmpresaResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Atribui o ID do usuário autenticado ao campo Usuario_id
        $data['Usuario_id'] = Auth::id();

        return $data;
    }
}
