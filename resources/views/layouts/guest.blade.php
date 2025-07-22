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
  <div class="h-screen grid grid-cols-1 md:grid-cols-2">

    <!-- LEFT COLUMN: Logo + Auth Card -->
    <div class="flex flex-col justify-center items-center px-8 py-12 bg-[#D9D9D9]">
     
      <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-md">
        {{ $slot }}
      </div>
    </div>

    <!-- RIGHT COLUMN: Full-height Background Image -->
    <div class="hidden md:block h-screen">
      <img
        src="{{ asset('storage/bgimages/login.png') }}"
        alt="Login background"
        class="w-full h-full object-cover object-center"
      >
    </div>

  </div>

</body>
</html>
