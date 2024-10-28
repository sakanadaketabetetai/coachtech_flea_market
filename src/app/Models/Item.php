<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'item_name','price','description','item_image',
        'user_id','category_item_id','condition_id'
    ];

    public function isFavorite(){
        return FavoriteItem::where('user_id', Auth::id())
                            ->where('item_id', $this->id)
                            ->exists();
    }

    public function users(){
        return $this->belongsTo(User::class);
    }

    public function favorite_items(){
        return $this->hasMany(FavoriteItem::class);
    }

    public function category_items(){
        return $this->hasMany(CategoryItem::class);
    }

    public function conditions(){
        return $this->belongsTo(Condition::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function sold_items(){
        return $this->hasMany(SoldItem::class);
    }
}
