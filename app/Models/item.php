<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /** @use HasFactory<\Database\Factories\ItemFactory> */
    use HasFactory;
    protected $fillable = ['name','description','price','amount','country_id','category_id','transaction_id','user_id', 'img_link', 'card_api_id'];
    public function transaction() {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }
    public function country() {
        return $this->belongsTo(Country::class, 'country_id');
    }
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
