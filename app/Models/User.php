<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/*
OnlyShop made by Lucas Perrin, Rui Marco Loureiro and Miguel Moreira
File's version : 1.0.0
this file is used for : accessing db's table "users".

Wrote by : Miguel Moreira
updated by : -
*/

class User extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     *  Relationship with Order model
     */
    public function shopcarts()
    {
        return $this->belongsTo(ShopCart::class);
    }

    /**
     *  Relationship with Item model
     */
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
