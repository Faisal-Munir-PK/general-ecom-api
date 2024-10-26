<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory, Uuid;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [];
    protected $table = 'addresses';
    protected $fillable = [
        'company_id',
        'created_by',
        'updated_by',
        'continent',
        'country',
        'state',
        'city',
        'street',
        'postal_code',
        'is_default',
        'is_active',
        'created_by',
        'updated_by'
    ];

    public const VALIDATION_RULES = [
        'continent'  => 'required',
        'country'  => 'required',
        'state'  => 'required',
        'city'  => 'required',
        'street'  => 'required',
        'postal_code'  => 'required'
    ];

    public function company() {
        return $this->belongsTo(Company::class);
    }

    public function created_by() {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updated_by() {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
