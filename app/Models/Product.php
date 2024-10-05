<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['category_id', 'code', 'slag_url', 'tags', 'title', 'status_off', 'number_off', 'time_off', 'unit_time_off', 'final_date_off', 'date_at_off', 'description', 'image', 'images', 'status'];
    protected $casts = [
        'tags' => 'array',
        'images' => 'array',
    ];
    public function colors()
    {
        return $this->belongsToMany(Color::class)->withPivot('color', 'price', 'inventory', 'final_price');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function properties()
    {
        return $this->belongsToMany(Property::class)->withPivot('category_id', 'value', 'unit');
    }
    public function sliders()
    {
        return $this->hasMany(Slider::class);
    }

    public function wishlistedByUsers()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function cartedByUsers()
    {
        return $this->hasMany(Cart::class);
    }
}
