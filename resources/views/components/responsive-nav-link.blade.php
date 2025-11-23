@props(['active'])

@php
$base = 'block w-full ps-4 pe-5 py-2.5 text-start text-base font-medium rounded-md transition-colors duration-300';
if ($active ?? false) {
    $classes = $base.' bg-primary-600/15 dark:bg-primary-500/20 text-primary-700 dark:text-primary-300';
} else {
    $classes = $base.' text-neutral-600 dark:text-neutral-400 hover:text-neutral-900 dark:hover:text-neutral-100 hover:bg-neutral-100/60 dark:hover:bg-neutral-800/60';
}
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
