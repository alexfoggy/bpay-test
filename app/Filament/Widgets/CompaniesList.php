<?php

namespace App\Filament\Widgets;

use App\Models\Company;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class CompaniesList extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(Company::query())
            ->columns([
                Tables\Columns\TextColumn::make('name')->sortable(),
                Tables\Columns\TextColumn::make('index')->sortable(),
                Tables\Columns\TextColumn::make('last_sync_at'),
            ]);
    }
}
