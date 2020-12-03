@extends('template.homeview')

@section('content')

<body class="antialiased font-sans bg-gray-200">
 
    <div class="container mx-auto px-4 sm:px-8">
            @unless($checkouts->status == 'reserved')
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 my-4" role="alert">
                    <p class="font-bold">Reservation Cancelled</p>
                    <p>Admin has been notified. Thank you!</p>
            </div>
            @endunless
        <div class="py-8">
            <div>
                <h2 class="text-2xl font-semibold leading-tight">Token ID: {{$checkouts->tokenID}}</h2>
            </div>

            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Item name
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Description
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Price
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Quantity
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Total
                                </th>
                            </tr>
                        </thead>
                        
                        <tbody>
                        @foreach($checkoutdetails as $detail)
                            <tr>
                           
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 w-10 h-10">
                                            <img class="w-full h-full rounded-full" src="{{asset('storage/'.$detail->item_image)}}" alt=""/>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                            {{$detail->item_name}}
                                            </p>
                                        </div>
                                        
                                    </div>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap overflow-ellipsis">{{$detail->item_description}}</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                    {{$detail->item_price}}
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">
                                    {{$detail->item_quantity}}
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">
                                    {{$detail->total}}
                                    </p>
                                </td>
                              </tr>
                        @endforeach
                            
                        </tbody>
                    
                    </table>
                    <div class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-right">
                        @unless($checkouts->status == 'cancelled' || auth()->user()->name == 'admin')
                            <a href="/checkoutcancel/{{$checkouts->tokenID}}" class="text-red-500 bg-transparent border border-solid border-red-500 hover:bg-red-500 hover:text-white active:bg-red-600 font-bold uppercase px-8 py-2 rounded outline-none focus:outline-none mr-6 mb-2" type="button" style="transition: all .15s ease">Cancel Reservation</a>
                        @endunless
                                <p class="text-gray-900 whitespace-no-wrap text-3xl pr-24">
                              Reserve Total: ₱{{$checkouts->overallTotal}}</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>

@endsection
