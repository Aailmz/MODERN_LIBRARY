<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'writer',
        'publisher',
        'category',
        'type',
        'stock',
        'page',
        'language',
        'rate',
        'sinopsis',
        'book_picture',
        'book_file',
        'like',
    ];

}
