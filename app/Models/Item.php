<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
    ];

    /**
     *  Relationship with Order model
     */
    public function orders(){
        return $this->belongsToMany(Order::class)->withPivot('quantity');
    }

    /**
     *  Relationship with Image model
     */
    public function images(){
        return $this->hasMany(Image::class);
    }
}
