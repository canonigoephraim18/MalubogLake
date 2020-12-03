@extends('template.homeview')

@section('content')

    @if(session()->has('message'))
        <div role="alert" class="pt-4">
        <div class="bg-green-500 text-white font-bold rounded-t px-1 py-1">
            Success!
        </div>
        <div class="border border-t-0 border-green-400 rounded-b bg-green-100 text-green-700 px-1 py-1">
            <p>{{session()->get('item_name')}} {{session()->get('message')}}</p>
        </div>
        </div>
    @endif

    <div class="container mx-auto flex flex-col">

    <div>
        <div class="bg-green-900 mt-2">
        <div class="max-w-7xl mx-auto py-3 px-3 sm:px-6 lg:px-6">
            <div class="flex items-center justify-between flex-wrap">
            <div class="w-0 flex-1 flex items-center">
                <span class="flex p-2 rounded-lg bg-green-900">
                <!-- Heroicon name: speakerphone -->
                <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                </svg>
                </span>
                <p class="ml-2 font-medium text-white truncate">
                <span class="hidden sm:inline">
                Reservation duration is only good for a day and we only have limited amount of items.
                </span>
                </p>
            </div>
            </div>
        </div>
        </div>
    </div>
        
            <div class="flex flex-row-reverse pt-6">

                <div class="flex items-center p-4 ml-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                    <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M10 19.5c0 .829-.672 1.5-1.5 1.5s-1.5-.671-1.5-1.5c0-.828.672-1.5 1.5-1.5s1.5.672 1.5 1.5zm3.5-1.5c-.828 0-1.5.671-1.5 1.5s.672 1.5 1.5 1.5 1.5-.671 1.5-1.5c0-.828-.672-1.5-1.5-1.5zm1.336-5l1.977-7h-16.813l2.938 7h11.898zm4.969-10l-3.432 12h-12.597l.839 2h13.239l3.474-12h1.929l.743-2h-4.195z"/></svg>
                    </div>

                    <div>
                        <a href="/reservelist" class="mb-2 text-base font-medium text-gray-600 dark:text-gray-400">
                        My Reservation List
                        </a>
                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200 text-center">
                        {{$counterItem}}
                        </p>
                    </div>
                </div>
           
          

                <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                    
                    <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19.5 8c-2.485 0-4.5 2.015-4.5 4.5s2.015 4.5 4.5 4.5 4.5-2.015 4.5-4.5-2.015-4.5-4.5-4.5zm-.5 7v-2h-2v-1h2v-2l3 2.5-3 2.5zm-5.701-11.26c-.207-.206-.299-.461-.299-.711 0-.524.407-1.029 1.02-1.029.262 0 .522.1.721.298l3.783 3.783c-.771.117-1.5.363-2.158.726l-3.067-3.067zm-.299 8.76c0-1.29.381-2.489 1.028-3.5h-14.028v2h.643c.535 0 1.021.304 1.256.784l4.101 10.216h12l1.211-3.015c-3.455-.152-6.211-2.993-6.211-6.485zm-2.299-8.76c.207-.206.299-.461.299-.711 0-.524-.407-1.029-1.02-1.029-.261 0-.522.1-.72.298l-4.701 4.702h2.883l3.259-3.26z"/></svg>
                    </div>
                    
                    <div>
                        <a href="/checkoutlist" class="mb-2 text-base font-medium text-gray-600 dark:text-gray-400">
                        My Checkout
                        </a>
                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200"></p>
                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200 text-center">
                        {{$counterCheckout}}
                        </p>
                    </div>
                </div>
            </div>


            
        
        <div class="flex flex-wrap bg-gray-300 w-full h-full my-6">
       
            @foreach($reserves as $reserve)
            <div class="w-1/4 flex-none p-2">

                <div class="text-gray-700 rounded-lg border-2 border-gray-500 w-full p-2">
                    <h1 class="font-bold text-3xl">{{$reserve->item_name}}</h1>
                    <p class="font-normal text-sm">Description:</p>
                    <li class="h-12 overflow-ellipsis font-normal text-sm pb-4">{{$reserve->item_description}}</li>
                    <img src="{{asset('storage/'.$reserve->item_image)}}" class="h-32 w-full" style="background-blend-mode: multiply;">
                    <h1 class="font-bold text-2xl pb-2">₱{{$reserve->item_price}}</h1>
                    <form method="POST" action="/addtocart/{{$reserve->id}}">
                    @csrf
                    <input type="hidden" name="item_quantity" min="1" value="1" required>
                    @auth
                    @if(auth()->user()->name == 'admin')
                    <a href="/editItem/{{$reserve->id}}" class="w-28 text-sm bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded-lg">Update</a>
                    <a href="/removeItem/{{$reserve->id}}" class="w-28 text-sm bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-4 rounded-lg">Delete</a>
                    <a href="/outofstockItem/{{$reserve->id}}" class="w-28 text-sm bg-orange-500 hover:bg-orange-700 text-white font-bold py-1 px-4 rounded-lg">Out of stock</a>
                    @elseif($reserve->item_status == false)
                    <p class="text-center bg-gray-600 text-white font-bold py-2 px-4 rounded-lg">Out of Stock</p>
                    @else
                    <button class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg" type="submit">Rent</button>
                    @endif
                    @endauth

                    @guest
                    @if($reserve->item_status == false)
                    <p class="text-center bg-gray-600 text-white font-bold py-2 px-4 rounded-lg">Out of Stock</p>
                    @else
                    <button class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg" type="submit">Rent</button>
                    @endif
                    @endguest
                    </form>
                </div>
                
            </div>
            @endforeach
     
        </div>

    

    </div>

@endsection
