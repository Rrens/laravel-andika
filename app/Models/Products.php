<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'store_id',
        'name',
        'price',
        'is_sold',
        'discount',
        'image',
    ];

    public function store()
    {
        return $this->belongsTo(stores::class, 'store_id', 'id');
    }
}
