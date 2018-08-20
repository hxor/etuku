<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommodityPrice extends Model
{
    protected $fillable = [
        'type_price_id', 'commodity_id', 'market_id',
        'price', 'gap', 'date', 'status'
    ];

    public function typePrice()
    {
        return $this->belongsTo(TypePrice::class);
    }

    public function com()
    {
        return $this->belongsTo(Commodity::class);
    }

    public function market()
    {
        return $this->belongsTo(Market::class);
    }
}
