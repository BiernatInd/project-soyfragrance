<?php

namespace App\Models\AdminPanel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderCompanyAdmin extends Model
{
    use HasFactory;

    protected $table = 'order_company';

    protected $fillable = [
        'nip', 
        'company_name', 
        'street_and_house_number', 
        'place', 
        'postal_code', 
        'invoice_name',
        'invoice_surname', 
        'invoice_email',
        'invoice_phone',
        'invoice_country',
        'invoice_street_and_house_number',
        'invoice_place',
        'invoice_postal_code',
        'total_price',
        'payment',
        'delivery',
        'order_status',
        'order_number',
        'purchased_products',
    ];
}
