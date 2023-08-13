<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'TransCode',
        'TransDate',
        'FineTotal',
        'CreatedBy'
    ];

    public static function boot()
    {
        parent::boot();
        self::created(function ($model) { 
            $model->TransCode = 'LIB-TRX-' . str_pad($model->id, 4, "0", STR_PAD_LEFT);
            $model->save();
        });
    }

    public function user() {
        return $this->belongsTo(User::class, 'CreatedBy', 'id');

    }

    public static function getTransactionWithDetails($transaction_id) {
        $tx = DB::select("SELECT 
                t.`TransCode`,
                t.`TransDate`,
                t.`FineTotal`,
                b.`BookName`,
                td.`Qty`,
                td.`ReturnDate`,
                td.`Fine`,
                td.`FineDays`,
                bt.`BookType`,
                u.`name`,
                u.`email`
                FROM `transactions` t
                JOIN `transaction_details` td ON td.`TransId` = t.`id`
                JOIN books b ON b.`id` = td.`BookId`
                JOIN `book_types` bt ON bt.`id` = b.`BookTypeId`
                JOIN users u ON u.`id` = t.CreatedBy
                WHERE t.`id` = {$transaction_id}");
        
        return $tx;
    }
}
