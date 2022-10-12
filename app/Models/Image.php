<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/*
OnlyShop made by Lucas Perrin, Rui Marco Loureiro and Miguel Moreira
File's version : 1.0.0
this file is used for : accessing db's table "images".

Wrote by : Miguel Moreira
updated by : -
*/

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'imagepath',
    ];

    /**
     *  Relationship with Item model
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
