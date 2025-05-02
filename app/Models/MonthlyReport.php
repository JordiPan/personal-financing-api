<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyReport extends Model
{
    /** @use HasFactory<\Database\Factories\MonthlyReportFactory> */
    use HasFactory;
    protected $fillable = ['user_id','date','total_spent','total_gained'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function date() {
        return $this->belongsTo(Date::class, 'date');
    }
}
