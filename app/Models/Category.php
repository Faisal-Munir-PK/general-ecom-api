<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class Category extends Model
{
    use HasFactory, Uuid;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [];
    protected $table = 'categories';
    protected $fillable = [
        'company_id',
        'category_id',
        'title',
        'short_title',
        'image',
        'description',
        'is_active',
        'has_child',
        'slug',
        'created_by',
        'updated_by'
    ];
    public const VALIDATION_RULES = [
        'title'  => 'required'
    ];

    public function store() {
        return $this->belongsTo(Store::class);
    }

    public function created_by() {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updated_by() {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    public function products() {
        return $this->belongsToMany(Product::class);
    }
    public static function getTree()
    {
        $categories = self::whereIsActive(true)->with('children')->whereNull('category_id')->get();

        return $categories;
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'category_id')->with('children');
    }
}
