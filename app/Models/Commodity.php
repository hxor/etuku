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
        return $this->belongsTo(CommodityCategory::class, 'commodity_category_id');
    }

    public function comUnit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function comPrice()
    {
        return $this->hasMany(CommodityPrice::class);
    }

    public function comLastPrice()
    {
        return $this->hasOne(CommodityPrice::class);
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
