<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'BookId',
        'qty',
        'CreatedBy'
    ];

    public function book() {
        return $this->belongsTo(Book::class, 'BookId', 'id');
    }

    public function books() {
        return $this->belongsToMany(Book::class, Cart::class, 'id', 'BookId');
    }
}
