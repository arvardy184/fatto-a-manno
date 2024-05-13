<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'password',
        'email',
        'address',
        'number',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

      /**
     * Default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'role_id' => 0,
    ];

    public function clothes()
    {
        return $this->belongsToMany(Cloth::class, 'buys')->withPivot('quantity', 'payment_method', 'payment_status', 'confirmation_status')->withTimestamps();
    }

    public function storages()
    {
        return $this->belongsToMany(Storage::class, 'stores')->withPivot('quantity')->withTimestamps();
    }
}
