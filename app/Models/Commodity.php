<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commodity extends Model
{
    protected $fillable = [
        'type_commodity_id', 'slug', 'title'
    ];

    public function typeCom()
    {
        return $this->belongsTo(TypeCommodity);
    }

    public function comPrice()
    {
        return $this->hasMany(CommodityPrice::class);
    }
}
