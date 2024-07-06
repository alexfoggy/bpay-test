<?php

namespace App\DataSource\Polygon;

use App\DataSource\DataSourceInterface;
use Carbon\CarbonImmutable;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Collection;

class PolygonClient implements DataSourceInterface
{
    private string $apiKey;
    private array $options;

    public function __construct()
    {
        $this->options = [
            'type' => 'stocks-range',
            'ticker' => 'AAPL',
            'multiplier' => 1,
            'timespan' => 'day',
            'dateFrom' => CarbonImmutable::now()->startOfYear()->format('Y-m-d'),
            'dateTo' => CarbonImmutable::now()->format('Y-m-d'),
        ];
    }

    public function init(string $apiKey, array $options = []): void
    {
        $this->apiKey = $apiKey;

        if (!empty($options)) {
            $this->options = $options;
        }
    }

    /**
     * @throws GuzzleException
     * @throws Exception
     */
    public function getStocks(): Collection
    {
        $url = $this->setQueryParams();
        $client = new Client([
            'base_uri' => $url,
        ]);

        try {
            $response = $client->request('GET');
        } catch (GuzzleException $e) {
            throw new Exception('Error');
        }

        return PolygonDataTransformer::transform(json_decode($response->getBody()->getContents(), true));
    }

    private function setQueryParams(): string
    {
        return match ($this->options['type']) {
            'stocks-range' => 'https://api.polygon.io/v2/aggs/ticker/'.$this->options['ticker'].'/range/'.$this->options['multiplier'].'/'.$this->options['timespan'].'/'.$this->options['dateFrom'].'/'.$this->options['dateTo'].'?apiKey='.$this->apiKey,
            default => '',
        };
    }
}