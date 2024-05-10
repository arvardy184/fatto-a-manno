<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'quantity_limit',
        'address',
    ];

    public function clothes()
    {
        return $this->belongsToMany(Cloth::class, 'stores')->withPivot('quantity');
    }
}
