@props(['active'])

@php
$base = 'relative inline-flex items-center px-3 py-2 text-sm font-medium leading-5 transition-colors duration-300';
if ($active ?? false) {
    $classes = $base.' text-primary-700 dark:text-primary-300 after:absolute after:left-0 after:bottom-0 after:h-0.5 after:w-full after:bg-primary-600 dark:after:bg-primary-400 after:rounded-full';
} else {
    $classes = $base.' text-neutral-600 dark:text-neutral-400 hover:text-neutral-900 dark:hover:text-neutral-100 after:absolute after:left-0 after:bottom-0 after:h-0.5 after:w-full after:bg-primary-500 dark:after:bg-primary-400 after:rounded-full after:scale-x-0 hover:after:scale-x-100 after:origin-left after:transition-transform after:duration-300';
}
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    <span>{{ $slot }}</span>
</a>
