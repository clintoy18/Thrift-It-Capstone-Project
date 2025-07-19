@props(['containerClass' => 'max-w-md', 'reverseColumns' => false])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">

  <!-- Full-height 2-column grid -->
  <div class="h-screen grid grid-cols-1 md:grid-cols-2 ">

    @if($reverseColumns)
      <!-- RIGHT COLUMN: Full-height Background Image (Rendered first if reverseColumns is true) -->
      <div class="hidden md:block h-screen ">
        <img
          src="{{ asset('images/loginbg.png') }}"
          alt="Login background"
          class="w-full h-screen  object-cover object-center"
        >
      </div>

      <!-- LEFT COLUMN: Logo + Auth Card (Rendered second if reverseColumns is true) -->
      <div class="flex flex-col justify-center items-center px-8 py-12" style="background-color: #CBBC968F;">
        <a href="{{ Auth::check() ? (Auth::user()->role === 2 ? route('admin.dashboard') : (Auth::user()->role === 1 ? route('upcycler') : route('dashboard'))) : url('/') }}" class="flex-shrink-0 mb-8">
                  <img src="{{ asset('images/nipis 4.png') }}" alt="Thrift-IT Logo" class="h-8 w-[120px] h-[100px]">
         </a>
        <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-md">
          {{ $slot }}
        </div>
      </div>
    @else
      <!-- LEFT COLUMN: Logo + Auth Card (Default order) -->
      <div class="flex flex-col justify-center items-center px-8 py-12" style="background-color: #CBBC968F;">
        <a href="{{ Auth::check() ? (Auth::user()->role === 2 ? route('admin.dashboard') : (Auth::user()->role === 1 ? route('upcycler') : route('dashboard'))) : url('/') }}" class="flex-shrink-0 mb-8">
                  <img src="{{ asset('images/logo.png') }}" alt="Thrift-IT Logo" class="h-8 w-[120px] h-[100px]">
         </a>
        <div {{ $attributes->merge(['class' => 'w-full '.$containerClass.' bg-white p-4 rounded-lg shadow-md']) }}>
          {{ $slot }}
        </div>
      </div>

      <!-- RIGHT COLUMN: Full-height Background Image (Default order) -->
      <div class="hidden md:block h-screen ">
        <img
          src="{{ asset('/images/loginbg.png') }}"
          alt="Login background"
          class="w-full h-screen  object-cover object-center"
        >
      </div>
    @endif
  
  </div>

</body>
</html>