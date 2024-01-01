<?php

namespace App\Models\AdminPanel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoCodeAdmin extends Model
{
    use HasFactory;

    protected $table = 'promo_code';

    protected $fillable = [
        'promo_code',
        'discount',
    ];
}
