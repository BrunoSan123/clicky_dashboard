<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmpreendimentoResource\Pages;
use App\Filament\Resources\EmpreendimentoResource\RelationManagers;
use App\Models\Empreendimento;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmpreendimentoResource extends Resource
{
    protected static ?string $model = Empreendimento::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListEmpreendimentos::route('/'),
            'create' => Pages\CreateEmpreendimento::route('/create'),
            'edit' => Pages\EditEmpreendimento::route('/{record}/edit'),
        ];
    }
}
