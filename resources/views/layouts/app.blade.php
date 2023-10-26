<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Font Awesome --> 
    @yield('font-awesome')
    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
  </head>

  <body>
    <div id="app">
      @include('partials._navbar')

      <main class="">
        @if(session('message'))
      <div class="container mb-5 mt-5">
        <div class="alert alert-{{ session('message_type') ?? 'info'}}">
          {{ session('message') }}
        </div>
      </div>
    @endif
    
        @yield('content')
      </main>
    </div>
    <footer>
      @yield('scripts')
    </footer>
  </body>

</html>
