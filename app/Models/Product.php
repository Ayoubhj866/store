<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $fillables = [
        'name', 'description', 'price', 'category', 'brand', 'image',
    ];

    /**
     * order : one product be in one or many order
     */
    public function order(): BelongsToMany
    {
        return $this->belongsToMany(Order::class);
    }
}
