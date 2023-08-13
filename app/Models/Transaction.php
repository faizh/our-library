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

    public static function getDataForChart() {
        $tx = DB::select("SELECT 
                        COUNT(IF(t.`FineTotal` = 0, 1, NULL)) AS on_time,
                        COUNT(IF(t.`FineTotal` > 0, 1 , NULL)) AS late
                        FROM `transactions` t;");
        
        return $tx[0];
    }
}
