<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'name_property', 'type_input', 'have_unit', 'status'];
    protected $casts = [
        'type_input' => 'array',
        'have_unit' => 'array',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('category_id','value', 'unit');
    }
}
