<?php

namespace App\DataSource;

use Illuminate\Support\Collection;

interface DataSourceInterface
{
    public function __construct();

    public function init(string $apiKey, array $options): void;

    public function getStocks(): Collection;
}
