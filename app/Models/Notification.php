<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'title',
        'category',
        'name',
        'email',
        'borrow_duration',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
