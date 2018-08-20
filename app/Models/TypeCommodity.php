<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeCommodity extends Model
{
    protected $fillable = [
        'slug', 'title'
    ];

    public function com()
    {
        return $this->hasMany(Commodity::class);
    }
}
