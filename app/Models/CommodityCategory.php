<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommodityCategory extends Model
{
    protected $fillable = [
        'type_commodity_id', 'slug', 'title'
    ];

    public function typeCom()
    {
        return $this->belongsTo(TypeCommodity::class);
    }

    public function com()
    {
        return $this->hasMany(Commodity::class);
    }
}
