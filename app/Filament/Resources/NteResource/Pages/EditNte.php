<?php

namespace App\Filament\Resources\NteResource\Pages;

use App\Filament\Resources\NteResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditNte extends EditRecord
{
    protected static string $resource = NteResource::class;

    protected function getRedirectUrl(): string
    {
        return NteResource::getUrl('index');
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('NTE Updated');
    }
}
