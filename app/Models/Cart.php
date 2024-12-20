<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    use HasFactory;
    protected $fillable = ['total_price', 'user_id'];

    public function items()
    {
        return $this->hasMany(CartItem::class, 'cart_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
