<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public const DIRECTION_INCOME = 'add';
    public const DIRECTION_EXPENSES = 'subtract';
    protected $fillable = ['user_id', 'name', 'description', 'recurrence', 'date', 'total', 'active'];
    protected $casts = [
        'total' => 'float',
    ];
    /** @use HasFactory<\Database\Factories\TransactionFactory> */
    use HasFactory;
    public function items()
    {
        return $this->belongsToMany(Item::class, 'transaction_items')
            ->withPivot('quantity', 'price_at_purchase')
            ->withTimestamps();
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
