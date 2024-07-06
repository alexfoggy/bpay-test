<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Company;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $stocks = [
            'AAPL' => 'Apple Inc.',
            'GOOGL' => 'Alphabet Inc.',
            'MSFT' => 'Microsoft Corporation',
            'AMZN' => 'Amazon.com Inc.',
            'META' => 'META Inc.',
            'TSLA' => 'Tesla Inc.',
            'NVDA' => 'NVIDIA Corporation',
            'PYPL' => 'PayPal Holdings Inc.',
            'ADBE' => 'Adobe Inc.',
            'NFLX' => 'Netflix Inc.',
        ];

        foreach ($stocks as $index => $name) {
            Company::create([
                'index' => $index,
                'name' => $name,
            ]);
        }
    }
}
