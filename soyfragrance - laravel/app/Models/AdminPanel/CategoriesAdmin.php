<?php

namespace App\Models\AdminPanel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriesAdmin extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'category_name',
    ];
}
