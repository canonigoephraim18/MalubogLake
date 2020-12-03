<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use App\Models\Reserve;
use Illuminate\Support\Carbon;


class CheckoutsController extends Controller
{
    public function store(){

        $tokenID = mt_rand(1000000, 9999999);
        $intersts = Reserve::where('user_id', auth()->id())->latest()->get();

        if($intersts->isEmpty()){
            return back()->with('error', 'You currently have no reservation, Kindly reserve one item');
        }else{

        $getTotal = Reserve::where('user_id', auth()->id())->sum('total');
        $now = Carbon::now()->toDateTimeString();
        $allcheckouts = [];
        foreach($intersts as $item){
            $checkouts = new Checkout;
            $checkouts->user_id = auth()->id();
            $checkouts->item_id = $item->item_id;
            $checkouts->item_quantity = $item->item_quantity;
            $checkouts->total = $item->total;
            $checkouts->overallTotal = $getTotal;
            $checkouts->tokenID = $tokenID;
            $checkouts->status = 'reserved';
            $checkouts->created_at = $now;
            $checkouts->updated_at = $now;
            $allcheckouts[] = $checkouts->attributesToArray();
        }

        }
       
        Checkout::insert($allcheckouts);

        Reserve::join('checkouts','reserves.item_id','=','checkouts.item_id')
                    ->where('reserves.user_id',auth()->id())
                    ->delete();

        return view('checkouts.checkout',['tokenID' => $tokenID]);
    }


    public function index()
    {   
        $checkouts = Checkout::join('users','checkouts.user_id','=','users.id')
                ->where('user_id', auth()->id())->groupBy('tokenID')
                ->select('users.*','checkouts.*')
                ->get();
        return view('checkouts.checkoutlist', ['checkouts' => $checkouts]);
    }

    public function show(Checkout $checkouts)
    {
        $checkoutdetails = Checkout::join('items','checkouts.item_id','=','items.id')
            ->where('checkouts.tokenID', $checkouts->tokenID)
            ->select('items.*','checkouts.*')
            ->get();

       
        return view('checkouts.checkoutdetail', 
                    ['checkoutdetails' => $checkoutdetails],
                    ['checkouts' => $checkouts]);
    
    }

    public function allCheckouts(){

        $allcheckouts = Checkout::join('users','checkouts.user_id','=','users.id')
            ->groupBy('tokenID')
            ->get();

        return view('checkouts.allcheckouts',['allcheckouts' => $allcheckouts]);
    }

    public function removeCheckout(Checkout $checkouts){

        Checkout::where('tokenID',$checkouts->tokenID)->delete();

        return back();
    }

    public function cancelCheckout(Checkout $checkouts){

        Checkout::where('tokenID',$checkouts->tokenID)
            ->update(['status' => 'cancelled']);

        return back();

    }


}
