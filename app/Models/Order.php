<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
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
        return $this->belongsToMany(Item::class)->withPivot('quantity');
    }
}
