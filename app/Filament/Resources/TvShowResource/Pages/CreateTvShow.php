<?php

namespace App\Filament\Resources\TvShowResource\Pages;

use App\Filament\Resources\TvShowResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTvShow extends CreateRecord
{
    protected static string $resource = TvShowResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
