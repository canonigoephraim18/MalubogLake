<?php

namespace App\Http\Controllers;

use App\Models\Comment;


class ReviewsController extends Controller
{

    public function addcomment(){
        
        $attributes = request()->validate([
            'comments' => ['string','required'],
            'commentType' => ['string','required'],
            ]);

        
       Comment::create([
           'user_id' => auth()->id(),
           'comments' => $attributes['comments'],
           'commentType' => $attributes['commentType']

       ]);

       return back();
    }


    public function viewHiking(){
        
        $viewsHiking = Comment::join('users','comments.user_id','=','users.id')
                ->where('commentType','hikingCMT')
                ->select('users.*','comments.*')
                ->withCount(['likes'])
                ->latest('comments.created_at')->paginate(5);
      
        return view('activity.hiking', 
                ['viewsHiking'=> $viewsHiking]);
                
    }

    public function viewFishing(){
        
        $viewsFishing = Comment::join('users','comments.user_id','=','users.id')
                ->where('commentType','fishingCMT')
                ->select('users.*','comments.*')
                ->withCount(['likes'])
                ->latest('comments.created_at')->paginate(5);


        return view('activity.fishing', ['viewsFishing'=> $viewsFishing]);
    }

    public function viewOvernightstay(){
        
        $overnights = Comment::join('users','comments.user_id','=','users.id')
                ->where('commentType','overnightCMT')
                ->select('users.*','comments.*')
                ->withCount(['likes'])
                ->latest('comments.created_at')->paginate(5);
                
        return view('activity.overnight', ['overnights'=> $overnights]);
    }

    public function deleteComment(Comment $comments){

        Comment::where('id', $comments->id)->delete();

        return back();
    
    }


    
}
