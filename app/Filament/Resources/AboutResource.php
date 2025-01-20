<?php

namespace App\Filament\Resources;

use AmidEsfahani\FilamentTinyEditor\TinyEditor;
use App\Filament\Resources\AboutResource\Pages;
use App\Filament\Resources\AboutResource\RelationManagers;
use App\Models\About;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AboutResource extends Resource
{
    protected static ?string $model = About::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('')
                ->schema([
                    Tabs::make('')
                        ->tabs([
                            Tab::make('O‘zbekcha')
                                ->schema([
                                    TinyEditor::make('text_uz')
                                        ->fileAttachmentsDisk('public')
                                        ->fileAttachmentsVisibility('public')
                                        ->fileAttachmentsDirectory('uploads')
                                        ->profile('default|simple|full|minimal|none|custom')
                                        ->label('Tavsif (O‘zbekcha)')
                                        ->ltr() // Set RTL or use ->direction('auto|rtl|ltr')
                                        ->columnSpan('full')
                                ]),
                            Tab::make('Ruscha')
                                ->schema([
                                    TinyEditor::make('text_ru')
                                        ->fileAttachmentsDisk('public')
                                        ->fileAttachmentsVisibility('public')
                                        ->fileAttachmentsDirectory('uploads')
                                        ->profile('default|simple|full|minimal|none|custom')
                                        ->label('Tavsif (Ruscha)')
                                        ->ltr() // Set RTL or use ->direction('auto|rtl|ltr')
                                        ->columnSpan('full')
                                ]),
                            Tab::make('Englizcha')
                                ->schema([
                                    TinyEditor::make('text_en')
                                        ->fileAttachmentsDisk('public')
                                        ->fileAttachmentsVisibility('public')
                                        ->fileAttachmentsDirectory('uploads')
                                        ->label('Tavsif (Englizcha)')
                                        ->profile('default|simple|full|minimal|none|custom')
                                        ->ltr() // Set RTL or use ->direction('auto|rtl|ltr')
                                        ->columnSpan('full')
                                ]),
                        ]),
                        ]),
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
            ->bulkActions([]);
    }

    public static function getNavigationLabel(): string
    {
        return 'О нас'; // Rus tilidagi nom
    }
    public static function getModelLabel(): string
    {
        return 'О нас'; // Rus tilidagi yakka holdagi nom
    }
    public static function getPluralModelLabel(): string
    {
        return 'О нас'; // Rus tilidagi ko'plik shakli
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    public static function getTableQuery()
    {
        return parent::getTableQuery()->limit(1);
    }
    public static function getNavigationUrl(): string
    {
        return static::getUrl('edit', ['record' => 1]); // 'id' 1 bilan tahrirlash sahifasiga yo'naltirish
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAbouts::route('/'),
            'edit' => Pages\EditAbout::route('/{record}/edit'),
        ];
    }
    public static function canCreate(): bool
    {
        return false; // Yangi yozuv yaratishni o'chiradi
    }
}
