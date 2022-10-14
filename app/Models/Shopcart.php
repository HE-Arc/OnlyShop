<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/*
OnlyShop made by Lucas Perrin, Rui Marco Loureiro and Miguel Moreira
File's version : 1.0.0
this file is used for : accessing db's table "shopcarts".

Wrote by : Miguel Moreira
updated by : -
*/

class Shopcart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
    ];


    /**
     *  Relationship with User model
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     *  Relationship with Item model
     */

    public function items()
    {
        return $this->belongsToMany(Item::class);
    }
}
