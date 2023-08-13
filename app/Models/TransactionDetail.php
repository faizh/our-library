<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'TransId',
        'BookId',
        'Qty',
        'ReturnDate',
        'FineDays',
        'Fine'
    ];

    public function book() {
        // return $this->belongsToMany(Book::class, TransactionDetail::class, 'id', 'BookId');
        return $this->belongsTo(Book::class, 'BookId', 'id');
    }
    
}
