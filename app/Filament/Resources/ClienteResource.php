<?php

namespace App\Filament\Resources;

use App\Filament\Clusters\Empreendimentos;
use App\Filament\Resources\ClienteResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\Cliente;
use App\Models\Empreendimento;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClienteResource extends Resource
{
    protected static ?string $model = Cliente::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';




    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('nome')->label('Nome')->required(),
                Forms\Components\TextInput::make('sobrenome')->label('Sobrenome')->required(),
                Forms\Components\TextInput::make('email')->label('Email')->required(),
                Forms\Components\TextInput::make('senha')->label('Senha')->password()->required(),
                Forms\Components\TextInput::make('cpf')->label('CPF'),
                //Forms\Components\TextInput::make('cnpj')->label('CNPJ')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('nome')->label('Nome'),
                Tables\Columns\TextColumn::make('sobrenome')->label('Sobrenome'),
                Tables\Columns\TextColumn::make('email')->label('Email'),
                //Tables\Columns\TextColumn::make('cnpj')->label('CNPJ'),
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
            'index' => Pages\ListCliente::route('/'),
            'create' => Pages\CreateCliente::route('/create'),
            'edit' => Pages\EditCliente::route('/{record}/edit'),
        ];
    }
}
