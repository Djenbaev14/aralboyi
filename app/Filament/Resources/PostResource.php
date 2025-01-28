<?php

namespace App\Filament\Resources;

use AmidEsfahani\FilamentTinyEditor\TinyEditor;
use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('')
                ->schema([
                    FileUpload::make('photo')
                        ->image()
                        ->label('Фото')
                        ->disk('public') 
                        ->directory('posts') 
                        ->required(),

                    Tabs::make('')
                        ->tabs([
                            Tab::make('O‘zbekcha')
                                ->schema([
                                    TextInput::make('name_uz')
                                        ->label('Sarlavha (O‘zbekcha)')
                                        ->required(),
                                    TinyEditor::make('description_uz')
                                        ->fileAttachmentsDisk('public')
                                        ->fileAttachmentsVisibility('public')
                                        ->fileAttachmentsDirectory('uploads')
                                        ->profile('default|simple|full|minimal|none|custom')
                                        ->label('Tavsif (O‘zbekcha)')
                                        ->ltr() // Set RTL or use ->direction('auto|rtl|ltr')
                                        ->columnSpan('full')
                                        ->required()
                                ]),
                            Tab::make('Ruscha')
                                ->schema([
                                    TextInput::make('name_ru')
                                        ->label('Sarlavha (Ruscha)')
                                        ->required(),
                                    TinyEditor::make('description_ru')
                                        ->fileAttachmentsDisk('public')
                                        ->fileAttachmentsVisibility('public')
                                        ->fileAttachmentsDirectory('uploads')
                                        ->profile('default|simple|full|minimal|none|custom')
                                        ->label('Tavsif (Ruscha)')
                                        ->ltr() // Set RTL or use ->direction('auto|rtl|ltr')
                                        ->columnSpan('full')
                                        ->required()
                                ]),
                            Tab::make('Englizcha')
                                ->schema([
                                    TextInput::make('name_en')
                                        ->label('Sarlavha (Englizcha)')
                                        ->required(),
                                    TinyEditor::make('description_en')
                                        ->fileAttachmentsDisk('public')
                                        ->fileAttachmentsVisibility('public')
                                        ->fileAttachmentsDirectory('uploads')
                                        ->label('Tavsif (Englizcha)')
                                        ->profile('default|simple|full|minimal|none|custom')
                                        ->ltr() // Set RTL or use ->direction('auto|rtl|ltr')
                                        ->columnSpan('full')
                                        ->required()
                                ]),
                        ]),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name_uz')->label('Название')->limit(20)->searchable(),
                ImageColumn::make('photo')
                    ->label('Фото')
                    ->square(),
                TextColumn::make('created_at')
                ->label('Creation Date')
                ->formatStateUsing(function ($state) {
                    return \Carbon\Carbon::parse($state)->format('d/m/Y'); // Sana formatini o‘zgartirish
                })
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
        return 'Посты'; // Rus tilidagi nom
    }
    public static function getModelLabel(): string
    {
        return 'Посты'; // Rus tilidagi yakka holdagi nom
    }
    public static function getPluralModelLabel(): string
    {
        return 'Посты'; // Rus tilidagi ko'plik shakli
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
