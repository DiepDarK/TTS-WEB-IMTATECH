<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_code',
        'name',
        'image',
        'price',
        'short_description',
        'content',
        'quantity',
        'view',
        'date_add',
        'category_id',
        'status',
        'is_new',
        'is_hot',
        'is_sale',
        'is_show_home',
    ];
    protected $casts = [
        'status' => 'boolean',
        'is_new' => 'boolean',
        'is_hot' => 'boolean',
        'is_sale' => 'boolean',
        'is_show_home' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function variants()
    {
        return $this->hasMany(Variant::class);
    }
    public function variantList()
    {
        return $this->belongsToMany(VariantList::class, 'variants');
    }
    public function scopeNewProducts($query, $limit = 8)
    {
        return $query->orderBy('created_at', 'desc')->limit($limit);
    }
    // Scope 2: Lọc các sản phẩm hot (có trường 'is_hot')
    public function scopeHotProducts($query, $limit = 8)
    {
        return $query->where('is_hot', true)->limit($limit);
    }
    // Scope 3: Lọc các sản phẩm đang giảm giá (có trường 'discount' hoặc 'sale_price')
    public function scopeSaleProducts($query)
    {
        return $query->whereNotNull('discount')->where('discount', '>', 0);
    }
    // Scope 4: Tìm kiếm sản phẩm theo tên hoặc mô tả
    public function scopeSearchProducts($query, $searchTerm)
    {
        return $query->where(function ($q) use ($searchTerm) {
            $q->where('name', 'like', "%{$searchTerm}%")
              ->orWhere('description', 'like', "%{$searchTerm}%");
        });
    }
    // Scope 5: Lọc sản phẩm theo giá (trong phạm vi giá)
    public function scopeFilterByPriceProducts($query, $minPrice, $maxPrice)
    {
        return $query->whereBetween('price', [$minPrice, $maxPrice]);
    }
}
