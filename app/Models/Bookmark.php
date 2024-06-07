<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'title',
        'name',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
