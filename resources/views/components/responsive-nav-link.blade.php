@props(['active'])

@php
/*
  PERUBAHAN:
  - Warna disesuaikan untuk background hijau tua di mobile
  - text-white (aktif)
  - bg-green-700 (bg aktif)
  - border-white (garis bawah aktif)
*/
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-white dark:border-white text-start text-base font-medium text-white dark:text-white bg-green-700 dark:bg-green-900/50 focus:outline-none focus:text-white dark:focus:text-white focus:bg-green-700 dark:focus:bg-green-900 focus:border-white dark:focus:border-white transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-green-100 dark:text-green-300 hover:text-white dark:hover:text-white hover:bg-green-700 dark:hover:bg-green-900 hover:border-green-500 dark:hover:border-green-700 focus:outline-none focus:text-white dark:focus:text-white focus:bg-green-700 dark:focus:bg-green-900 focus:border-green-500 dark:focus:border-green-700 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>