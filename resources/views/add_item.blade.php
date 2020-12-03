@extends('template.homeview')

@section('content')

  @if(session()->has('message'))
    <div role="alert" class="pt-4">
      <div class="bg-green-500 text-white font-bold rounded-t px-4 py-2">
        Success!
      </div>
      <div class="border border-t-0 border-green-400 rounded-b bg-green-100 px-4 py-3 text-green-700">
        <p>{{session()->get('message') }}</p>
      </div>
    </div>
  @endif

<div class="container mx-auto w-full h-full pt-5 pb-5">
    <form class="w-full max-w-sm" method="POST" action="/items" enctype="multipart/form-data">
    @csrf
  <div class="md:flex md:items-center mb-6">
    <div class="md:w-1/3">
      <label class="block text-gray-900 font-bold md:text-right mb-1 md:mb-0 pr-4">
        Item Name
      </label>
    </div>

    <div class="md:w-2/3">
      <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" name="item_name" type="text" required>
    </div>
  </div>

  <div class="md:flex md:items-center mb-6">
    <div class="md:w-1/3">
      <label class="block text-gray-900 font-bold md:text-right mb-1 md:mb-0 pr-4">
        Item Price
      </label>
    </div>

    <div class="md:w-2/3">
      <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" name="item_price" type="number" min=1 required>
    </div>
  </div>

  <div class="md:flex md:items-center mb-6">
    <div class="md:w-1/3">
      <label class="block text-gray-900 font-bold md:text-right mb-1 md:mb-0 pr-4">
      Item Description
      </label>
    </div>

    <div class="md:w-2/3">
      <textarea class="resize-x h-32 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" name="item_description" type="text" maxlength=255 required></textarea>
    </div>
  </div>

  <div class="md:flex md:items-center mb-6">
    <div class="md:w-1/3">
      <label class="block text-gray-900 font-bold md:text-right mb-1 md:mb-0 pr-4">
        Item Image
      </label>
    </div>

    <div class="md:w-2/3">
      <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" name="item_image" type="file" required>
    </div>
  </div>

  <div class="md:flex md:items-center">
    <div class="md:w-1/3"></div>
    <div class="md:w-2/3">
      <button class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
        Add Item
      </button>
    </div>
  </div>

    </form>
</div>
@endsection

  