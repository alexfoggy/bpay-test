<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StocksResource\Pages;
use App\Models\Company;
use App\Models\StockData;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class StocksResource extends Resource
{
    protected static ?string $model = StockData::class;

    protected static string $name = 'stocks';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('company_id')
                    ->options(
                        Company::all()->pluck('name', 'id')->toArray()
                    )
                    ->disabled(),
                TextInput::make('date')->disabled(),
                TextInput::make('low')->required(),
                TextInput::make('high')->required(),
                TextInput::make('open')->required(),
                TextInput::make('close')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        $table->query(function () {
            $query = StockData::query();

            if (request()->route('company')) {
                $companyId = Company::query()->where('index', request()->route('company'))->first()->id;
                $query = $query->where('company_id', $companyId);
            }

            return $query->orderBy('date', 'desc');
        });

        return $table
            ->columns([
                Tables\Columns\TextColumn::make('company.name'),
                Tables\Columns\TextColumn::make('low')->money('usd'),
                Tables\Columns\TextColumn::make('high')->money('usd'),
                Tables\Columns\TextColumn::make('open')->money('usd'),
                Tables\Columns\TextColumn::make('close')->money('usd'),
                Tables\Columns\TextColumn::make('date'),
            ])
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStocks::route('/'),
            'list' => Pages\ListStocks::route('/list/{company}'),
            'create' => Pages\CreateStocks::route('/create'),
            'edit' => Pages\EditStocks::route('/{record}/edit'),
        ];
    }
}
