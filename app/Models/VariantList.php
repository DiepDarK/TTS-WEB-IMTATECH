<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariantList extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];
    public function variants()
    {
        return $this->hasMany(Variant::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'variants');
    }
}
