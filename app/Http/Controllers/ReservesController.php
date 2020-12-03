<?php

namespace App\Http\Controllers;


use App\Models\Reserve;
use Illuminate\Support\Facades\DB;

class ReservesController extends Controller
{

    public function reserveList(){
        
        $items = DB::table('reserves')
            ->join('items','reserves.item_id','=','items.id')
            ->where('reserves.user_id',auth()->id())
            ->select('items.*','reserves.id as reserves_id','reserves.*')
            ->get();

        $total = DB::table('reserves')
            ->join('items','reserves.item_id','=','items.id')
            ->where('reserves.user_id',auth()->id())
            ->sum('reserves.total');
            
        return view('reservelist', [
                    'items'=>$items,
                    'total'=>$total]);

    }

    public function removeToCart(Reserve $reserves){
        Reserve::destroy($reserves->id);
        return back();
    }

    public function editCart(Reserve $reserves){

            $atrributes = request()->validate([
                'item_quantity' => ['integer','min:1','required']
                ]);
          
            $price = $reserves->total/$reserves->item_quantity;
            $reserves->total = $price * $atrributes['item_quantity'];
            $reserves->update($atrributes);

            return back();
        
    }

   
 
            
}
