<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\StockData;
use Carbon\Carbon;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index($index = null, $date = null)
    {
        $companies = Company::all();
        $stock = StockData::query();

        if ($index) {
            $currentCompany = $companies->where('index', $index)->first();
        } else {
            $currentCompany = $companies->first();
        }

        $stock = $stock->where('company_id', $currentCompany->id);

        if($date) {
            $date = Carbon::parse($date)->format('Y-m-d');
        }
        else {
            $date = now()->format('Y-m-d');
        }

        $stock = $stock->where('date', $date)->first();

        return Inertia::render('Welcome', [
            'companies' => $companies,
            'stock' => $stock ?? [],
            'currentCompany' => $currentCompany,
            'date' => $date,
        ]);
    }
}
