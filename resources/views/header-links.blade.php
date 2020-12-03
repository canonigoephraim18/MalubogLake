<nav class="flex items-center justify-between flex-wrap bg-green-500 p-6">
  <div class="flex items-center flex-shrink-0 text-white mr-6">
    <a href="/"><img class="h-10 w-12 ml-5" src="/images/logoLake.png" alt="Workflow logo"></a>
  </div>

  <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
    <div class="text-base lg:flex-grow">
      <a href="/" class="block mt-4 lg:inline-block lg:mt-0 text-teal-lighter hover:text-white mr-4">
        Home
      </a>
      <a href="/reviewshiking" class="block mt-4 lg:inline-block lg:mt-0 text-teal-lighter hover:text-white mr-4">
        Reviews
      </a>
      <a href="{{ route('reserves')}}" class="block mt-4 lg:inline-block lg:mt-0 text-teal-lighter hover:text-white mr-4">
        Reservation
      </a>
      @auth
      @if(auth()->user()->name == 'admin')
      <a href="{{ route('items')}}" class="block mt-4 lg:inline-block lg:mt-0 text-teal-lighter hover:text-white mr-4">
        Add Items
      </a>
      <a href="/allcheckout" class="block mt-4 lg:inline-block lg:mt-0 text-teal-lighter hover:text-white mr-4">
        Checkouts
      </a>
      @endif
      @endauth

    </div>
    <div>
    @guest
      <a href="{{ route('login') }}" class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-black hover:bg-white mt-4 lg:mt-0">Login</a>
      @if (Route::has('register'))
      <a href="{{ route('register') }}" class="inline-block text-sm ml-4 px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-black hover:bg-white mt-4 lg:mt-0">Register</a>
      @endif
    
    @else
    
    <p class="inline-block text-sm px-4 py-2 leading-none mt-4 lg:mt-0">Hi, {{ auth()->user()->name }}!</p>
    <a class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-black hover:bg-white mt-4 lg:mt-0" href="{{ route('logout') }}"
      onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    {{ __('Logout') }}</a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST">
    @csrf
    </form>
    @endguest
    </div>
  </div>
</nav>