@props(['disabled' => false])

<input
    {{ $disabled ? 'disabled' : '' }}
    {!! $attributes->merge([
        'class' =>
            'w-full rounded-lg border border-gray-300 focus:border-green-600 focus:ring-2 focus:ring-green-500
             px-4 py-2 text-gray-900 placeholder-gray-400 shadow-sm transition duration-200
             focus:shadow-md outline-none'
    ]) !!}
/>
