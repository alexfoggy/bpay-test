<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockData extends Model
{
    protected $table = 'stocks_data';
    protected $fillable = ['company_id', 'date', 'open', 'high', 'low', 'close', 'volume','edited_at'];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
