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
        return $this->belongsTo(TypePrice::class, 'type_price_id');
    }

    public function com()
    {
        return $this->belongsTo(Commodity::class, 'commodity_id');
    }

    public function market()
    {
        return $this->belongsTo(Market::class, 'market_id');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at',
    ];


    protected $dates = [
        'date',
        'created_at',
        'updated_at',
    ];
}
