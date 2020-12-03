@extends('template.homeview')


@section('content')

<div class="container mx-auto flex flex-row bg-gray-100 py-5 px-4">
@include('activity.sidebar')


    <div class="flex flex-col">
        <div> 
        @include('activity.fishingGallery')
        </div>
            
        <!-- comment form -->
        <div>
            <form class="bg-white rounded-lg px-4 pt-2 mt-4 ml-4 w-8/12" method="POST" action="/reviewsadd">
            @csrf
                <div class="flex flex-wrap -mx-3 mb-3">
                    <div class="w-full md:w-full px-3 mb-2 mt-2">
                        <textarea class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white" name="comments" placeholder='Type Your Comment' required></textarea>
                        <input type="hidden" name="commentType" value="fishingCMT">
                    </div>
                    <div class="w-full md:w-full flex items-start md:w-full px-3">
                        <div class="flex items-start w-1/2 text-gray-900 px-2 mr-auto">
                        <svg fill="none" class="w-5 h-5 text-gray-900 mr-1" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-xs md:text-sm pt-px">Write your own experience.</p>
                        </div>
                        <div class="-mr-1 pb-3">
                        <button type='submit' class="bg-white text-gray-900 font-medium py-1 px-4 border border-gray-400 rounded-lg tracking-wide mr-1 hover:bg-gray-100">Post Comment</button>
                        </div>
                    </div>
                </div>
            </form>
      </div>
     
        <!-- timeline -->
      <div class="w-full block flex-grow lg:flex-wrap lg:items-center lg:w-auto">
        @foreach($viewsFishing as $viewFishing)
          <div class="px-2 pt-2 flex-grow my-4 w-8/12">
          <header>
          @auth
          @if($viewFishing->name == auth()->user()->name || 'admin')
          <div class="text-right">
          <a href="/deletesreview/{{$viewFishing->id}}" class="w-28 text-sm bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-1 rounded-lg">delete</a>
          </div>
          @endif
          @endauth
            <a href="#" class="text-black no-underline">
              <span class="font-medium">{{$viewFishing->name}}</span>
              <span class="font-normal text-grey">{{$viewFishing->email}}</span>
            </a>
            <div class="text-xs text-grey flex items-center my-1">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="h-4 w-4 mr-1 feather feather-calendar">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                <line x1="16" y1="2" x2="16" y2="6"></line>
                <line x1="8" y1="2" x2="8" y2="6"></line>
                <line x1="3" y1="10" x2="21" y2="10"></line>
              </svg>
              <span>{{$viewFishing->created_at->diffForHumans()}} </span>
            </div>
          </header>
          <article class="py-4 text-grey-darkest">
          {{$viewFishing->comments}}
          </article>
          <p class="text-xs text-grey flex items-center my-1">
          @if($viewFishing->likes_count > 1)
          {{$viewFishing->likes_count}} likes
          @else
          {{$viewFishing->likes_count}} like
          @endif
          </p>
          @auth
          <footer class="border-t border-grey-lighter text-sm flex">
          <form method="POST" action="/comments/{{$viewFishing->id}}/like">
          @csrf
            <button type="submit" class="block no-underline {{ $viewFishing->isLikedBy(auth()->user()) ? 'text-blue-600' : 'text-blue'}} flex px-4 py-2 items-center hover:bg-grey-lighter">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-thumbs-up h-6 w-6 mr-1 stroke-current">
                <path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path>
              </svg>
              <span>Liked</span>
            </button>
          </form>
          </footer>
          @endauth

          @guest
          <footer class="border-t border-grey-lighter text-sm flex">
          <form method="POST" action="/comments/{{$viewFishing->id}}/like">
          @csrf
            <button type="submit" class="block no-underline text-blue flex px-4 py-2 items-center hover:bg-grey-lighter">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-thumbs-up h-6 w-6 mr-1 stroke-current">
                <path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path>
              </svg>
              <span>Liked</span>
            </button>
          @endguest
          </div>
        @endforeach
       
      </div>
      <div class="w-8/12">
      {{$viewsFishing->links()}}
      </div>
    </div> 

    
</div>

@endsection
