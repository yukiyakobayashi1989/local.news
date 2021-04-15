<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
   <head>
     <meta charset="utf-8">
     <meta http-http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, intial-scale=1">

     <!-- SCRF token -->
     <meta name="csrf-token" content="{{ csrf_token() }}">


     <title>@yield('title')</title>
     <!-- script -->
     {{-- Laravel標準で用意されているJavascriptを読み込みます --}}
     <script src="{{ asset('js/app.js') }}" defer></script>

     <!-- Fonts -->
     <link rel="dns-prefetch" href="https://fonts.gstatic.com">
     <link rel="https://fonts.googlepis.com/css?family=Raleway:300,400,600" rel="stylesheet"type="text/css">

     <!-- Styles -->
     {{-- Laravel標準で用意されているcssを読み込みます --}}
     <link href="{{ asset('css/app.css') }}" rel="stylesheet">
     {{-- この章の後半で作成するcssを読み込みます --}}
     <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
   </head>
   <body>
     <div id="app">
       {{-- 画面上部に表示するナビゲーションバー --}}
       <nav class="navbar navbar-expand-md navbar-laravel">
         <div class="container">
           <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
           </a>
           <buttom class="navbar-toggler" type="button" data-toggle="collapse" dataa-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expand="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
           </buttom>

           <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <!-- Left Side of Navbar -->
              <ul class="navbar-nav mr-auto">
              </ul>
              <!-- Right Side of Navbar -->
              <ul class="navbar-nav ml-auto">
              </ul>
            </div>
          </div>
        </nav>
        {{-- ここまでナビゲーションバー --}}
        <main class="py-4">
          {{-- コンテンツをここに入れるために、@yieldで空けておく --}}
          @yield('content')
        </main>
      </div>
    </body>
   </html>
   
