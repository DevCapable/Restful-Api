<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = [
        'amount_available',
        'cost',
        'product_name',
        'seller_id'
    ];
}
