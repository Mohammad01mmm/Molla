<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCheckout extends Model
{
    use HasFactory;
    protected $fillable = ['user', 'title', 'code', 'category', 'slug_url', 'status_off', 'number_off', 'properties', 'count', 'color', 'final_price', 'status'];
    protected $casts = [
        'user' => 'array',
        'properties' => 'array',
        'color' => 'array',
    ];
}
