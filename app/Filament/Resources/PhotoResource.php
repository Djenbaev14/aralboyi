<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PhotoResource\Pages;
use App\Filament\Resources\PhotoResource\RelationManagers;
use App\Models\Photo;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Log;

class PhotoResource extends Resource
{
    protected static ?string $model = Photo::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Section::make('photos')
                ->schema([
                    Repeater::make('photos')
                    ->schema([
                        FileUpload::make('photo')
                            ->label('Фото')
                            ->disk('public') 
                            ->directory('photos') 
                            ->required(),
                    ])
                    ->label('Photos') // Umumiy label
                    ->collapsible() // Qisqartiriladigan (collapse) holat
                    ->minItems(1) // Eng kam nechta element
                    ->maxItems(10), // Eng ko‘p nechta element   
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // ImageColumn::make('photo')
                //     ->label('Фото')
                //     ->square()
                
            TextColumn::make('photos')
            ->label('Photos')
            // ->formatStateUsing(function ($state) {
            //     // $photos = json_decode($state, true);
            //     if (is_array($state)) {
            //         return "<div style='display: flex; gap: 10px;'>".
                    
            //         collect($photos)->map(fn ($photo) => 
            //             "<img src='" . asset('storage/' . $photo['photo']) . "' style='width: 50px; height: 50px; margin: 5px; border-radius: 8px;'>"
            //         )->implode('')."</div>";
            //     }
            // })
            // ->html(), // HTML kodni qo‘llab-quvvatlash uchun
            ])
            ->defaultSort('id', 'desc') // Default tartibni sozlash
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
    
    public static function getNavigationLabel(): string
    {
        return 'Фото галерия'; // Rus tilidagi nom
    }
    public static function getModelLabel(): string
    {
        return 'Фото галерия'; // Rus tilidagi yakka holdagi nom
    }
    public static function getPluralModelLabel(): string
    {
        return 'Фото галерия'; // Rus tilidagi ko'plik shakli
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
            'index' => Pages\ListPhotos::route('/'),
            'create' => Pages\CreatePhoto::route('/create'),
            'edit' => Pages\EditPhoto::route('/{record}/edit'),
        ];
    }
}
