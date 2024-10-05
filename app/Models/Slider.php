<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    protected $fillable = ['type', 'product_id', 'category_id', 'blog_id', 'title', 'caption', 'url', 'image', 'status', 'final_date_slider'];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}
