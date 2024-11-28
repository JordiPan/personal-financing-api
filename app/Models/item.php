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
    protected $fillable = ['img','name','description','price','amount','purchase_date','country_id','transaction_id','user_id','category_id'];
    public function transaction() {
        return $this->belongsTo(transaction::class);
    }
    public function category() {
        return $this->belongsTo(category::class);
    }
}
