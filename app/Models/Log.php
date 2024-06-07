<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'title',
        'category',
        'name',
        'email',
        'date',
        'borrow_duration',
        'status',
        'condition',
        'note',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
