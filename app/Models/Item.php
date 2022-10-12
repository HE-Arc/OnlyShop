<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
