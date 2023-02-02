<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    public $fillable = [
        'id',
        'name',
        'email',
        'password',
    ];
    public $hidden = ['password', 'remember_token', 'updated_at'];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function Game(){
        return $this->hasMany('App\Models\Game','admin_id','id');
    }
}
