<?php

namespace App\Models;

// use App\Models\visits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Game extends Model
{
    
    use HasFactory;

    public $fillable = [
        'id',
        'game_name_ar',
        'game_name_en',
        'game_details_ar',
        'game_details_en',
        'photo',
        'rating',
        'game_category_en',
        'game_category_ar',
        'link',
        'admin_id',
        'created_at'
    ];
    public $hidden = ['created_at', 'updated_at'];



    public function Admin(){
        return $this->belongsTo('App\Models\Admin','admin_id','id');
    }


    public function Suggestion(){
        return $this->hasMany('App\Models\Suggestion','Game_id');
        }

        
}
