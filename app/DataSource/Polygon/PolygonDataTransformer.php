<?php

namespace App\DataSource\Polygon;

use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;

class PolygonDataTransformer
{
    public static function transform($data): Collection
    {
        $result = collect();

        if(!isset($data['results'])){
            return $result;
        }

        foreach ($data['results'] as $item) {
            $result->push([
                'date' => CarbonImmutable::createFromTimestampMs($item['t'])->format('Y-m-d'),
                'open' => $item['o'],
                'high' => $item['h'],
                'low' => $item['l'],
                'close' => $item['c'],
                'volume' => $item['v'],
            ]);
        }

        return $result;
    }
}