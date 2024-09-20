<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'banner',
        'position',
        'url',
        'start_date',
        'end_date',
        'is_active',
        'priority',
    ];
    protected $casts = [
        'is_active' => 'boolean'
    ];
}
