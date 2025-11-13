@props([
    'type' => 'button',
    'variant' => 'primary',
    'size' => 'md',
    'rounded' => 'full',
    'fullWidth' => false,
    'shadow' => false,
])

@php
    $variantClasses = [
        'primary' => 'bg-rose-500 text-white hover:bg-rose-600 focus:ring-rose-200 dark:focus:ring-rose-400',
        'secondary' => 'bg-slate-900 text-white hover:bg-slate-800 dark:bg-slate-100 dark:text-slate-900 dark:hover:bg-slate-200 focus:ring-slate-200',
        'outline' => 'border border-slate-300 text-slate-600 hover:bg-slate-50 dark:border-slate-600 dark:text-slate-200 dark:hover:bg-slate-800 focus:ring-slate-200',
        'ghost' => 'text-slate-600 hover:text-rose-500 dark:text-slate-300 dark:hover:text-rose-400 focus:ring-transparent',
        'danger' => 'bg-rose-600 text-white hover:bg-rose-700 focus:ring-rose-200',
        'custom' => '',
    ];

    $sizeClasses = [
        'sm' => 'px-3 py-1.5 text-xs',
        'md' => 'px-4 py-2 text-sm',
        'lg' => 'px-6 py-3 text-base',
    ];

    $roundedClasses = [
        'full' => 'rounded-full',
        'xl' => 'rounded-xl',
        'md' => 'rounded-md',
    ];

    $base = 'inline-flex items-center justify-center font-semibold transition focus:outline-none focus:ring-2 focus:ring-offset-2';
    $widthClass = $fullWidth ? 'w-full' : '';
    $shadowClass = $shadow ? 'shadow' : '';

    $classes = trim(implode(' ', [
        $base,
        $variantClasses[$variant] ?? $variantClasses['primary'],
        $sizeClasses[$size] ?? $sizeClasses['md'],
        $roundedClasses[$rounded] ?? $roundedClasses['full'],
        $widthClass,
        $shadowClass,
    ]));
@endphp

<button {{ $attributes->merge(['type' => $type, 'class' => $classes]) }}>
    {{ $slot }}
</button>
