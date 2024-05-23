<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Store extends Pivot
{
    use HasFactory;

    protected $table = 'stores';

    // Additional columns in the pivot table if any
    protected $fillable = [
        'quantity',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the cloth that owns the buy.
     */
    public function clothe()
    {
        return $this->belongsTo(Cloth::class);
    }
}
