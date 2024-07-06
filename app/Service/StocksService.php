<?php

namespace App\Service;

use App\Models\Company;
use App\Models\StockData;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class StocksService
{
    public static function fillStocks(Collection $stocks,int $companyId): void
    {
        if ($stocks->isEmpty()) {
            return;
        }

        $stocks->each(function ($stock) use ($companyId) {
            $stock['company_id'] = $companyId;
            StockData::updateOrCreate(
                [
                    'company_id' => $companyId,
                    'date' => $stock['date'],
                    'edited_at' => null
                ],
                $stock
            );
        });

        Company::where('id', $companyId)->update(['last_sync_at' => Carbon::now()->format('Y-m-d h:i:s')]);
    }
}