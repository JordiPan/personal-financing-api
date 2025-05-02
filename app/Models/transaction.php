<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['user_id','name','description','recurrence','date', 'is_item', 'total', 'active'];
    /** @use HasFactory<\Database\Factories\TransactionFactory> */
    use HasFactory;
    public function items() {
        return $this->hasMany(Item::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
}
