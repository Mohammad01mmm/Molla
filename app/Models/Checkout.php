<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;
    protected $fillable = ['user', 'product_id', 'total_price', 'total_price_payable', 'payment_gateway', 'transaction_id', 'status', 'discription'];
    protected $casts = [
        'user' => 'array',
        'product_id' => 'array',
    ];
}
