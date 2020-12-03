<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','comments','commentType'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function like(User $user = null, $liked = true)
    {
        $this->likes()->updateOrCreate([
            'user_id' => $user ? $user->id : auth()->id(),
            'liked' => $liked,
        ]);
    }

    public function unlike(User $user)
    {
        $this->likes()->where('user_id', $user->id)->delete($user);
    }

    public function toggleLike(User $user){
        if($this->liking($user)){
            return $this->unlike($user);
        }else{
            $this->like($user);
        }
    }

    public function liking(User $user){
        
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    public function isLikedBy(User $user){
        return (bool)$user->likes->where('comment_id', $this->id)
        ->where('liked', true)
        ->count();
    }

     
    public function likes(){

        return $this->hasMany(Like::class);
    }




}
