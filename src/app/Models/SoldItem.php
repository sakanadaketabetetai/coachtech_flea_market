<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoldItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'item_id','amount'
    ];
    
    public function users(){
        return $this->belongsTo(User::class);
    }

    public function items(){
        return $this->belongsTo(Item::class);
    }
}
