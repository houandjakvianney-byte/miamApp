<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlatResource\Pages;
use App\Models\Categorie;
use App\Models\Plat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PlatResource extends Resource
{
    protected static ?string $model = Plat::class;

    protected static ?string $navigationIcon = 'heroicon-o-cake';

    protected static ?string $navigationLabel = 'Plats';

    protected static ?string $modelLabel = 'plat';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('categorie_id')
                ->label('Catégorie')
                ->options(Categorie::ordonnees()->pluck('nom', 'id'))
                ->required()
                ->searchable(),

            Forms\Components\TextInput::make('nom')
                ->required()
                ->maxLength(255),

            Forms\Components\Textarea::make('description')
                ->maxLength(1000)
                ->columnSpanFull(),

            Forms\Components\TextInput::make('prix')
                ->label('Prix (FCFA)')
                ->numeric()
                ->required()
                ->minValue(0),

            Forms\Components\FileUpload::make('image')
                ->image()
                ->directory('plats')
                ->imageEditor(),

            Forms\Components\Toggle::make('disponible')
                ->default(true)
                ->helperText('Un plat indisponible reste visible en admin mais disparaît côté client.'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')->circular(),
                Tables\Columns\TextColumn::make('nom')->searchable(),
                Tables\Columns\TextColumn::make('categorie.nom')->label('Catégorie')->badge(),
                Tables\Columns\TextColumn::make('prix')->money('XOF', divideBy: 1)->sortable(),
                Tables\Columns\IconColumn::make('disponible')->boolean(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('categorie_id')
                    ->label('Catégorie')
                    ->options(Categorie::pluck('nom', 'id')),
                Tables\Filters\TernaryFilter::make('disponible'),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPlats::route('/'),
            'create' => Pages\CreatePlat::route('/create'),
            'edit' => Pages\EditPlat::route('/{record}/edit'),
        ];
    }
}
