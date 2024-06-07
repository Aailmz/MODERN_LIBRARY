<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'title',
        'category',
        'name',
        'email',
        'request_date',
        'borrow_duration',
        'status',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

}
