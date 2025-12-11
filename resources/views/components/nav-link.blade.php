@props(['active'])

@php
/*
  PERUBAHAN:
  - Warna disesuaikan untuk background hijau tua
  - text-white (aktif)
  - text-green-200 (pasif)
  - border-white (garis bawah aktif)
*/
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-white dark:border-white text-sm font-medium leading-5 text-white dark:text-white focus:outline-none focus:border-white transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-green-200 dark:text-green-300 hover:text-white dark:hover:text-white hover:border-green-300 dark:hover:border-green-600 focus:outline-none focus:text-white dark:focus:text-white focus:border-green-300 dark:focus:border-green-600 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>