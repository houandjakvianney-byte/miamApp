<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlatResource\Pages;
use App\Models\Plat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PlatResource extends Resource
{
    protected static ?string $model = Plat::class;
    protected static ?string $navigationIcon = 'heroicon-o-square-3-stack-3d';
    protected static ?string $label = 'Plats';
    protected static ?string $pluralLabel = 'Plats';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('categorie_id')
                    ->label('Catégorie')
                    ->relationship('categorie', 'nom')
                    ->required(),
                Forms\Components\TextInput::make('nom')
                    ->label('Nom')
                    ->required(),
                Forms\Components\TextInput::make('prix')
                    ->label('Prix')
                    ->numeric()
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->label('Description')
                    ->rows(3),
                Forms\Components\FileUpload::make('image')
                    ->label('Image')
                    ->image()
                    ->directory('plats'),
                Forms\Components\Checkbox::make('disponible')
                    ->label('Disponible')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nom')
                    ->label('Nom')
                    ->searchable(),
                Tables\Columns\TextColumn::make('categorie.nom')
                    ->label('Catégorie')
                    ->searchable(),
                Tables\Columns\TextColumn::make('prix')
                    ->label('Prix')
                    ->money('eur'),
                Tables\Columns\IconColumn::make('disponible')
                    ->label('Disponible')
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('disponible')
                    ->options([
                        true => 'Disponible',
                        false => 'Indisponible',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListPlats::route('/'),
            'create' => Pages\CreatePlat::route('/create'),
            'edit' => Pages\EditPlat::route('/{record}/edit'),
        ];
    }
}
