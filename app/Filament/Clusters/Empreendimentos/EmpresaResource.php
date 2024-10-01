<?php

namespace App\Filament\Clusters\Empreendimentos;

use App\Filament\Clusters\Empreendimentos;
use App\Filament\Clusters\Empreendimentos\EmpresaResource\Pages;
use App\Filament\Resources\EmpresaResource\RelationManagers;
use App\Models\Empresa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmpresaResource extends Resource
{
    protected static ?string $model = Empresa::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $cluster = Empreendimentos::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('nome_da_empresa')->label('Nome da empresa')->required(),
                Forms\Components\TextInput::make('cnpj')->label('CNPJ')->required(),
                Forms\Components\TextInput::make('cep')->label('CEP')->required(),
                Forms\Components\TextInput::make('endereço')->label('Endereço')->required(),
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('nome_da_empresa')->label('Nome da empresa'),
                Tables\Columns\TextColumn::make('cnpj')->label('CNPJ'),
                Tables\Columns\TextColumn::make('cep')->label('CEP'),
                Tables\Columns\TextColumn::make('endereço')->label('Endereço'),
                Tables\Columns\TextColumn::make('usuario.name')->label('Usuário vinculado')

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmpresas::route('/'),
            'create' => Pages\CreateEmpresa::route('/create'),
            'edit' => Pages\EditEmpresa::route('/{record}/edit'),
        ];
    }
}
