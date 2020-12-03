@extends('template.homeview')

@section('content')

<div class="container mx-auto flex flex-row bg-gray-100 py-5 px-4">
    <div class="w-full h-full text-center">
      <h1 class="text-3xl">Thank you for your Reservation!</h1>
      <p class="text-2xl">Here is your reference Token ID:{{$tokenID}}</p>
      <p class="text-2xl pb-4">You can view it on My Reservation link below</p>
      <a class="bg-gradient-to-r from-orange-400 via-red-500 to-pink-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full" href="/checkoutlist">My Reservation</a>

    </div>
</div>

@endsection
