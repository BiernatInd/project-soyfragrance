<?php

namespace App\Models\AdminPanel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsAdmin extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'category',
        'price',
        'promo_price',
        'availability',
        'short_description',
        'long_description',
        'product_photo_1',
        'product_photo_2',
        'product_photo_3',
        'product_title',
        'product_description'
    ];
}
