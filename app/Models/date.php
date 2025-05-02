<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Date extends Model
{
    /** @use HasFactory<\Database\Factories\DateFactory> */
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['year','month','day'];
    public function transaction() {
        return $this->belongsTo(Transaction::class);
    }
    public function monthlyReport() {
        return $this->belongsTo(MonthlyReport::class);
    }
}
