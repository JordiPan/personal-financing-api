<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    public $timestamps = false;
    protected $fillable = ['name','description','date','user_id'];
    /** @use HasFactory<\Database\Factories\TransactionFactory> */
    use HasFactory;
    protected $table = 'transaction';
    public function items() {
        return $this->hasMany(Item::class);
    }
}
