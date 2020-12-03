<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','item_name','item_price','item_description','item_image'];


    public function user(){
        return $this->belongsToMany(User::class);
    }

    public function reserve(){
        return $this->hasMany(Reserve::class);
    }




}
