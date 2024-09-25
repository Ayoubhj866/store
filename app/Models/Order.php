<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'status', 'total_amount', 'status_date', 'uuid',
    ];

    /**
     * products : one order has many products
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'order_items')->withPivot('quantity', 'unit_price');
    }

    /**
     * user : one order beong to one user
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * payment : order has one payment
     */
    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }
}
