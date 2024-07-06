<?php

namespace App\Filament\Resources\StocksResource\Pages;

use App\Filament\Resources\StocksResource;
use Filament\Actions;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditStocks extends EditRecord
{
    protected static string $resource = StocksResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['edited_at'] = now()->toDateTimeString();

        return $data;
    }
}
