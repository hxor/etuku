<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeCommodity extends Model
{
    protected $fillable = [
        'slug', 'title'
    ];

    public function comCat()
    {
        return $this->hasMany(CommodityCategories::class);
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
