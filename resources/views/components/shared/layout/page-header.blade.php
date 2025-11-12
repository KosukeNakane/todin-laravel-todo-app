@props([
    'title',
    'subtitle' => null,
])

<div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
        @if ($subtitle)
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-rose-400">{{ $subtitle }}</p>
        @endif
        <h1 class="text-3xl font-bold text-slate-900 dark:text-white">{{ $title }}</h1>
    </div>
    <div class="flex flex-wrap items-center gap-3">
        {{ $slot }}
    </div>
</div>
