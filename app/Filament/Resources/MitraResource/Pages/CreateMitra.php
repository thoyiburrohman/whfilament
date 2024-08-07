<?php

namespace App\Filament\Resources\MitraResource\Pages;

use App\Filament\Resources\MitraResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateMitra extends CreateRecord
{
    protected static string $resource = MitraResource::class;
    protected function getRedirectUrl(): string
    {
        return MitraResource::getUrl('index');
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Mitra Created');
    }
}
