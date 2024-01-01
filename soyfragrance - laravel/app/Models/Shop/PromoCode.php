<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    use HasFactory;

    protected $table = 'promo_code';

    protected $fillable = [
        'promo_code',
        'discount',
        'quantity'
    ];
}
