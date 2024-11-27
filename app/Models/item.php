<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class item extends Model
{
    /** @use HasFactory<\Database\Factories\ItemFactory> */
    use HasFactory;
    public $timestamps = false;
    protected $table = 'item';
    public function transaction() {
        return $this->belongsTo(transaction::class);
    }
    public function category() {
        return $this->belongsTo(category::class);
    }
}
