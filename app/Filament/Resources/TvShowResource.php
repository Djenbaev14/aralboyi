<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TvShowResource\Pages;
use App\Filament\Resources\TvShowResource\RelationManagers;
use App\Models\TvShow;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TvShowResource extends Resource
{
    protected static ?string $model = TvShow::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('tv_src')
                ->label('TV link')
                ->placeholder('https://example.com')
                ->url() // URL validatsiya qoidasini qo'llash
                ->required() // Majburiy maydon
                ->maxLength(255), // Maksimal uzunlikni belgilash
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ViewColumn::make('tv_src')->label('Video link')->view('components.table.iframe-column')->extraAttributes(['style' => 'width: 300px; height: 200px;']) ,
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTvShows::route('/'),
            'create' => Pages\CreateTvShow::route('/create'),
            'edit' => Pages\EditTvShow::route('/{record}/edit'),
        ];
    }
}
