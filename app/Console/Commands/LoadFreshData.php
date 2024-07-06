<?php

namespace App\Console\Commands;

use App\DataSource\Polygon\PolygonClient;
use App\Models\Company;
use App\Service\StocksService;
use Carbon\CarbonImmutable;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;

class LoadFreshData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:load-fresh-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Loading fresh data for the application.';

    /**
     * Execute the console command.
     * @throws GuzzleException
     */
    public function handle(): void
    {
        $client = app(PolygonClient::class);
        $companies = Company::where('last_sync_at','<',now()->subHours(6))->get();

        foreach ($companies as $company) {
            $this->loadStocks($client, $company);
        }
    }

    public function loadStocks(PolygonClient $client, Company $company): void
    {
        $client->init(env('API_KEY'), [
            'type' => 'stocks-range',
            'ticker' => $company->index,
            'multiplier' => 1,
            'timespan' => 'day',
            'dateFrom' => CarbonImmutable::now()->subDays(7)->format('Y-m-d'),
            'dateTo' => CarbonImmutable::now()->format('Y-m-d'),
        ]);

        $stocks = $client->getStocks();

        StocksService::fillStocks($stocks, $company->id);
        sleep(20);
    }
}
