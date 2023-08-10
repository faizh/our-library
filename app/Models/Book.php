<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'BookTypeId',
        'BookName',
        'Description',
        'Publisher',
        'Year',
        'Stock'
    ];

    public function bookType() {
        return $this->belongsTo(BookType::class, 'BookTypeId', 'id');
    }
}
