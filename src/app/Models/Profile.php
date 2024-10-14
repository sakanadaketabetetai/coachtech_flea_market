<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'user_name','post_code','address',
        'building'
    ];

    public function users(){
        return $this->hasMany(User::class);
    }
}
