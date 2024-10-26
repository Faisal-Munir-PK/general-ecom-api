<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class Company extends Model
{
    use HasFactory, Uuid;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [];
    protected $table = 'companies';
    protected $fillable = [
        'created_by',
        'updated_by',
        'title',
        'slogan',
        'logo',
        'description',
        'about',
        'phone',
        'primary_email',
        'secondary_email',
        'website',
        'is_active'
    ];
    public const VALIDATION_RULES = [
        'title' => 'required'
    ];

    public function stores() {
        return $this->hasMany(Store::class);
    }

    public function categories() {
        return $this->hasMany(Category::class);
    }

    public function promotions() {
        return $this->hasMany(Promotion::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function addresses() {
        return $this->hasMany(Address::class);
    }
}
