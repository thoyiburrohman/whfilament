<?php

namespace App\Filament\Resources\AssetNteResource\Pages;

use App\Filament\Resources\AssetNteResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditAssetNte extends EditRecord
{
    protected static string $resource = AssetNteResource::class;
    protected function getRedirectUrl(): string
    {
        return AssetNteResource::getUrl('index');
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Asset NTE Updated');
    }
}
