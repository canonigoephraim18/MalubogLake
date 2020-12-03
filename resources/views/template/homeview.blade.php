<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Malubog Lake</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{asset('css/main.css')}}">

    </head>
    <body>
        <div class="lg:container lg:mx-auto">
           
            <div>
            @include('header-links') 
            </div> 
            
            <div>
            @yield('content') 
            </div>

            <div>
            @include('footer')
            </div>

        </div>

    </body>
</html>
