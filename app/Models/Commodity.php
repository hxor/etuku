<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commodity extends Model
{
    protected $fillable = [
        'commodity_category_id', 'unit_id', 'slug', 'title'
    ];

    public function comCat()
    {
        return $this->belongsTo(CommodityCategory::class);
    }

    public function comPrice()
    {
        return $this->hasMany(CommodityPrice::class);
    }
}
