<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','item_id','item_quantity','total'];

    public function items(){
        return $this->belongsToMany(Item::class);
    }

    public function user(){
        return $this->belongsToMany(User::class);
    }

    
}
