<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'price', 'category', 'brand', 'image', 'category_id', 'brand_id',
    ];

    /**
     * order : one product be in one or many order
     */
    public function order(): BelongsToMany
    {
        return $this->belongsToMany(Order::class);
    }

    /**
     * brand : one product has one brand
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * category : one product belong to one category
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
