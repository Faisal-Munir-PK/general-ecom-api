<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class Product extends Model
{
    use HasFactory, Uuid;
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $casts = [
        'image' => 'array',       // Casts the 'image' field to an array
        'colors' => 'array',      // Casts the 'colors' field to an array
        'sizes' => 'array',       // Casts the 'sizes' field to an array
        'description' => 'array', // Casts the 'description' field to an array
        'meta' => 'array',        // Casts the 'meta' field to an array
    ];
    protected $fillable = ['id', 'store_id', 'category_id', 'brand_id', 'title', 'article_num', 'price', 'image', 'colors', 'sizes', 'description', 'stock', 'sku', 'dimensions', 'minimum_stock_level', 'barcode', 'season', 'type', 'material', 'slug', 'meta', 'reorder_point'];
    
    // Define relationships here
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
