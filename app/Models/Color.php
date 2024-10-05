<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'hex'];
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('color', 'price', 'inventory', 'final_price');
    }
    public function cart()
    {
        return $this->hasMany(Cart::class);
    }
}
