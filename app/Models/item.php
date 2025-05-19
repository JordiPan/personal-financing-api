<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /** @use HasFactory<\Database\Factories\ItemFactory> */
    use HasFactory;
    protected $fillable = ['name','description','price','amount','country_id','category_id','user_id', 'img_link', 'card_api_id'];
    public function transactions() {
        return $this->belongsToMany(Transaction::class, 'transaction_items')->withPivot('amount');
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
