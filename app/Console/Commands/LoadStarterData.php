<?php

namespace App\Console\Commands;

use App\DataSource\Polygon\PolygonClient;
use App\Models\Company;
use App\Service\StocksService;
use Carbon\CarbonImmutable;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;

class LoadStarterData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:load-starter-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Getting started data for the application.';

    /**
     * Execute the console command.
     * @throws GuzzleException
     */
    public function handle(): void
    {
        $client = app(PolygonClient::class);
        $companies = Company::whereNull('last_sync_at')->get();

        foreach ($companies as $company) {
            $this->loadStocks($client, $company);
        }
    }

    /**
     * @throws GuzzleException
     */
    public function loadStocks(PolygonClient $client, Company $company): void
    {
        $client->init(env('API_KEY'), [
            'type' => 'stocks-range',
            'ticker' => $company->index,
            'multiplier' => 1,
            'timespan' => 'day',
            'dateFrom' => CarbonImmutable::now()->subYear()->format('Y-m-d'),
            'dateTo' => CarbonImmutable::now()->format('Y-m-d'),
        ]);

        $stocks = $client->getStocks();

        StocksService::fillStocks($stocks, $company->id);
    }
}
