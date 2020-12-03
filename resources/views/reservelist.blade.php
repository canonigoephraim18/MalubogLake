@extends('template.homeview')

@section('content')

@if(session()->has('error'))
        <div role="alert" class="pt-4">
        <div class="bg-red-500 text-white font-bold rounded-t px-1 py-1">
          Please Read!
        </div>
        <div class="border border-t-0 border-red-400 rounded-b bg-red-100 text-red-700 px-1 py-1">
            <p>{{session()->get('error')}}</p>
        </div>
        </div>
@endif

<div class="flex flex-col">

  <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 my-4 shadow-md" role="alert">
    <div class="flex">
      <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
      <div>
        <p class="font-bold">Reservation List</p>
        <p class="text-sm">Please take a moment to review your reservation before checkout!</p>
      </div>
    </div>
  </div>


  <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
      <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
          <thead>
            <tr>
              <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Item Name
              </th>
              <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Description
              </th>
              <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Price
              </th>
              <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Quantity
              </th>
              <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Total
              </th>
              <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
              </th>

            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
          @foreach($items as $item)
          <form method="POST" action="/editcart/{{$item->id}}">
            @csrf
            @method('PATCH')
            <tr>
              <td class="px-6 py-4 whitespace-no-wrap">
                <div class="flex items-center">
                  <div class="flex-shrink-0 h-10 w-10">
                    <img class="h-10 w-10 rounded-full" src="{{asset('storage/'.$item->item_image)}}" alt="">
                  </div>
                  <div class="ml-4">
                    <div class="text-sm leading-5 font-medium text-gray-900">
                    {{$item->item_name}}
                    </div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-no-wrap">
                <div class="text-sm leading-5 text-gray-900 overflow-ellipsis">{{$item->item_description}}</div>
              </td>
              <td class="px-6 py-4 whitespace-no-wrap">
              <div class="text-sm leading-5 text-gray-900">{{$item->item_price}}</div>
              </td>
              <td class="px-6 py-4 whitespace-no-wrap">
              <input type="number" name="item_quantity" value="{{$item->item_quantity}}" min="1" class="w-10" required>
              </td>
              <td class="px-6 py-4 whitespace-no-wrap">
              <div class="text-sm leading-5 text-gray-900">{{$item->total}}</div>
              </td>
              <td class="px-6 py-4 text-xs flex text-left space-x-1">
               <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-2 rounded" type="submit">Update Qty</button></p>
               <a class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-2 rounded" href="/removecart/{{$item->reserves_id}}">Remove</a>
              </td>
            </tr>
          </form>
          @endforeach
          </tbody>
        </table>
        <div class="px-6 py-4 whitespace-no-wrap">
        <div class="text-right">
            <p class="text-2xl leading-5 text-gray-900 py-4">Total Reservation Price: ₱{{$total}}</p>
            <a href="/checkout" class="text-green-500 bg-transparent border border-solid border-green-500 hover:bg-green-500 hover:text-white active:bg-green-600 font-bold uppercase px-8 py-3 rounded outline-none focus:outline-none mr-1 mb-1" type="button" style="transition: all .15s ease">
             Checkout
            </a>
        </div>
        </div>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection

  