<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;

    protected $primaryKey = 'tokenID';

    protected $fillable = ['user_id','item_id','total','overallTotal'];

    public function user(){
        return $this->belongsToMany(User::class);
    }

    public function reserve(){
        return $this->belongsToMany(Reserve::class);
    }

    public function item(){
        return $this->belongsToMany(Item::class);
    }
}
