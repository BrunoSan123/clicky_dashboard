<?php

namespace App\Filament\Clusters\Empreendimentos;

use App\Filament\Clusters\Empreendimentos;
use App\Filament\Clusters\Empreendimentos\UnidadeResource\Pages;
use App\Filament\Clusters\Empreendimentos\Resources\UnidadeResource\RelationManagers;
use App\Models\Empreendimento;
use App\Models\Unidade;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UnidadeResource extends Resource
{
    protected static ?string $model = Unidade::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?string $cluster = Empreendimentos::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('nome_da_unidade')->label('Nome')->required(),
                Forms\Components\TextInput::make('quantidade')->label('Quantidade')->required()->numeric(),
                Forms\Components\TextInput::make('cnpj')->label('CNPJ')->required(),
                Forms\Components\TextInput::make('região')->label('Região')->required(),
                Forms\Components\Select::make('Empreendimento_id')
                ->label('Selecione um empreendimento')
                ->options(Empreendimento::all()->pluck('nome_do_empreendimento', 'id'))
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('nome_da_unidade')->label('Nome')->searchable(),
                Tables\Columns\TextColumn::make('quantidade')->label('Quatidade')->searchable(),
                Tables\Columns\TextColumn::make('cnpj')->label('CNPJ')->searchable(),
                Tables\Columns\TextColumn::make('região')->label('Região'),
                Tables\Columns\TextColumn::make('empreendimento.nome_do_empreendimento')->label('Empreendimento')->searchable(),


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
            'index' => Pages\ListUnidades::route('/'),
            'create' => Pages\CreateUnidade::route('/create'),
            'edit' => Pages\EditUnidade::route('/{record}/edit'),
        ];
    }
}
