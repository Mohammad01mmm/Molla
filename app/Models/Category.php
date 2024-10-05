<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'slug_url', 'image', 'status'];

    public function properties()
    {
        return $this->belongsToMany(Property::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
