<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cloth extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'name',
        'size',
        'color',
        'price_per_piece',
        'description',
        'image_url'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'buys')->withPivot('quantity', 'payment_method', 'status_pembayaran');
    }
}
