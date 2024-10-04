<?php

namespace App\Filament\Clusters\Empreendimentos;

use App\Filament\Clusters\Empreendimentos;
use App\Filament\Clusters\Empreendimentos\ImovelResource\Pages;
use App\Filament\Clusters\Empreendimentos\Resources\ImovelResource\RelationManagers;
use App\Models\Imovel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ImovelResource extends Resource
{
    protected static ?string $model = Imovel::class;

    protected static ?string $navigationIcon = 'ionicon-business-outline';

    protected static ?string $cluster = Empreendimentos::class;

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
            'index' => Pages\ListImovels::route('/'),
            'create' => Pages\CreateImovel::route('/create'),
            'edit' => Pages\EditImovel::route('/{record}/edit'),
        ];
    }
}
