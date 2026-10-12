<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['game_id', 'name', 'price', 'stock'];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}