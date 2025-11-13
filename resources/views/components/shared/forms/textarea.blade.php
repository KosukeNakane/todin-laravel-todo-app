@props([
    'variant' => 'default',
])

@php
    $classes = match ($variant) {
        'compact' => 'mt-1 w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-900 focus:border-rose-400 focus:outline-none focus:ring focus:ring-rose-100 dark:border-slate-600 dark:bg-slate-900 dark:text-slate-100 dark:focus:ring-rose-400',
        default => 'mt-1 w-full rounded-xl border border-slate-200 px-4 py-3 text-base text-slate-900 focus:border-rose-400 focus:outline-none focus:ring-2 focus:ring-rose-100 dark:border-slate-600 dark:bg-slate-900 dark:text-slate-100 dark:focus:ring-rose-400',
    };
@endphp

<textarea {!! $attributes->merge(['class' => $classes]) !!}>{{ $slot }}</textarea>
