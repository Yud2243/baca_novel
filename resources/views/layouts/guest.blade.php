<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="relative bg-cover bg-center bg-no-repeat min-h-screen flex flex-col sm:justify-center items-center"
      style="background-image: url('/images/image.png');">

    <!-- Overlay gelap tipis biar konten tetap fokus -->
    <div class="absolute inset-0 bg-black/30 backdrop-blur-sm"></div>

    <div class="relative w-full sm:max-w-md px-6 py-8">
        {{ $slot }}
    </div>

</body>

</html>
