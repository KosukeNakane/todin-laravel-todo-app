@props(['message' => null])

@php
    $content = $message ?? session('status');
@endphp

@if ($content)
    <div class="mt-4 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-700 dark:border-emerald-400/30 dark:bg-emerald-500/10 dark:text-emerald-200">
        {{ $content }}
    </div>
@endif
