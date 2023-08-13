<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public static function getListBooksLoan() {
        $tx = DB::select("SELECT 
                        t.`TransCode`,
                        b.`BookName`,
                        td.`Qty`,
                        t.`TransDate`,
                        td.`FineDays`
                        FROM `transaction_details` td
                        JOIN `transactions` t ON t.`id` = td.`TransId`
                        JOIN `books` b ON b.`id` = td.`BookId`");

        return $tx;
    }
    
}
