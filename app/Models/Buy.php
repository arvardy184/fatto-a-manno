<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Buy extends Pivot
{
    use HasFactory;

    protected $table = 'buys';

    // Additional columns in the pivot table if any
    protected $fillable = [
        'quantity',
        'payment_method',
        'payment_status',
        'confirmation_status',
        'payment_url'
    ];

    /**
     * Get the user that owns the buy.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the cloth that owns the buy.
     */
    public function cloth()
    {
        return $this->belongsTo(Cloth::class);
    }
}
