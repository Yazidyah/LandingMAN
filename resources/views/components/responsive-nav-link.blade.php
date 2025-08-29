@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-tertiary text-start text-base font-medium text-white bg-tertiary/10 focus:outline-none focus:text-white focus:bg-tertiary/20 focus:border-tertiary transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-white hover:text-white hover:bg-tertiary/10 hover:border-tertiary focus:outline-none focus:text-white focus:bg-tertiary/20 focus:border-tertiary transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
