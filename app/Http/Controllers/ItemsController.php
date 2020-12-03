<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use App\Models\Item;
use App\Models\Reserve;


class ItemsController extends Controller
{

    public function show()
    {
        $reserves = Item::latest()->get();
        $counterItem = Reserve::join('items','reserves.item_id','=','items.id')
        ->where('reserves.user_id',auth()->id())
        ->count();

        $counterCheckout = Checkout::distinct('tokenID')
        ->count();
    
        return view('reserve', [
            'reserves'=> $reserves,
            'counterItem'=> $counterItem,
            'counterCheckout'=> $counterCheckout]);
    }

    public function addToCart(Item $items){

        $validatedData = request()->validate([
            'item_quantity' => 'required|numeric|gt:0',
        ]);

        Reserve::create([
                'user_id' => auth()->id(),
                'item_id' => $items->id,
                'item_quantity' => $validatedData['item_quantity'],
                'total' => $validatedData['item_quantity'] * $items->item_price
        ]);

        return back()->with('message', 'has been added to reservation!')
                    ->with('item_name', $items->item_name);

    }
   
    public function store(){
        
        $attributes = request()->validate([
            'item_name' => ['string', 'required'],
            'item_price' => ['integer','min:1','required'],
            'item_description' => ['string','max:255','required'],
            'item_image' => ['file'],
            ]);

        
       Item::create([
           'user_id' => auth()->id(),
           'item_name' => $attributes['item_name'],
           'item_price' => $attributes['item_price'],
           'item_description' => $attributes['item_description'],
           'item_image' => $atrributes['item_image'] = request('item_image')->store('item_image')
       ]);

       return back()->with('message', 'Item added successfully!');
    }

    public function removeItem(Item $items){
       
        Item::where('id', $items->id)->delete();

        return back();

    }

    public function editItem(Item $items){
        
        return view('edit_item',compact('items'));
    }

    public function updateItem(Item $items){
        
        $atrributes = request()->validate([
            'item_name' => ['string', 'required'],
            'item_price' => ['integer','min:1','required'],
            'item_description' => ['string','max:255','required'],
            'item_image' => ['file'],

            ]);

            if(request('item_image')){
            $atrributes['item_image'] = request('item_image')->store('item_image');
            }

        $items->update($atrributes);

        return back()->with('message', 'Updated successfully');
    }

    public function setoutItem(Item $items){

        Item::where('id',$items->id)->update(['item_status' => false]);

        return back();
    }
    
  

}
