<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'title',
        'name',
        'date',
        'borrow_duration',
        'status',
        'condition',
        'header',
        'note',
        'mail_status',
    ];
}
