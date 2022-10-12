<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/*
OnlyShop made by Lucas Perrin, Rui Marco Loureiro and Miguel Moreira
File's version : 1.0.0
this file is used for : accessing db's table "items".

Wrote by : Miguel Moreira
updated by : -
*/

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'description',
        'price',
    ];

    /**
     *  Relationship with Order model
     */
    public function shopcarts()
    {
        return $this->belongsToMany(ShopCart::class);
    }

    /**
     *  Relationship with Image model
     */
    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
