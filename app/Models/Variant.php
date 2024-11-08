<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'variant_list_id',
        'price',
        'image',
        'quantity',
    ];

    public function variantList()
    {
        return $this->belongsTo(VariantList::class, 'variant_list_id');
    }
    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
