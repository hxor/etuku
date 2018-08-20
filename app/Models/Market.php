<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    protected $fillable = [
        'slug', 'title'
    ];

    public function comPrice()
    {
        return $this->hasMany(CommodityPrice::class);
    }
}
