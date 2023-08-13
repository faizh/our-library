<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
