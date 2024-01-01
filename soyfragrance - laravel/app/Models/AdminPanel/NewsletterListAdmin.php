<?php

namespace App\Models\AdminPanel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsletterListAdmin extends Model
{
    use HasFactory;

    protected $table = 'newsletter_list';

    protected $fillable = [
        'email'
    ];
}
