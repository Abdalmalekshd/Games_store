<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    
    public $fillable = [
        'id',
        'rating',
        'Game_id',
        'User_id',
        'created_at'
    ];
    public $hidden = ['created_at', 'updated_at'];

public function User(){
return $this->belongsTo('App\Models\User','User_id');
}

public function Game(){
    return $this->belongsTo('App\Models\Game','Game_id');
    }
}
