@props([
    'value' => null,
    'variant' => 'default',
])

@php
    $classes = match ($variant) {
        'compact' => 'text-xs font-semibold text-slate-600 dark:text-slate-300',
        default => 'text-sm font-semibold text-slate-700 dark:text-slate-200',
    };
@endphp

<label {{ $attributes->merge(['class' => $classes]) }}>
    {{ $value ?? $slot }}
</label>
