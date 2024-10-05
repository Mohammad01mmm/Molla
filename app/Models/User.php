<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    protected $fillable = ['name', 'lname', 'city', 'phone', 'email', 'zip_code', 'image', 'password', 'type', 'status', 'address'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }
    public function cart()
    {
        return $this->hasMany(Cart::class);
    }
    public function hasPermission($permissionName)
    {
        return Permission::where('unique_name', $permissionName)->whereStatus('1')
            ->whereHas('roles', function ($query) {
                $query->whereIn('roles.id', $this->roles()->get()->pluck('id'))->whereStatus('1');
            })
            ->exists();
    }
}
