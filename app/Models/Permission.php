<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'unique_name', 'status'];
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
