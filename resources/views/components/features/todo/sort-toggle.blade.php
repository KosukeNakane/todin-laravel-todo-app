@props([
    'sort',
    'direction',
    'nextDirection',
])

@php
    $toggleParams = array_merge(request()->query(), [
        'sort' => $sort,
        'direction' => $nextDirection ?? 'desc',
    ]);
    $isAsc = ($direction ?? 'asc') === 'asc';
@endphp

<a href="{{ route('todos.index', $toggleParams) }}" class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 bg-white text-slate-600 transition hover:border-rose-300 hover:text-rose-500 dark:border-slate-600 dark:bg-slate-900 dark:text-slate-200" aria-label="並び順を{{ $isAsc ? '降順' : '昇順' }}に切り替え" title="並び順を{{ $isAsc ? '降順' : '昇順' }}に切り替え">
    @if ($isAsc)
        <x-shared.assets.icon name="sort-asc" class="h-5 w-5" />
    @else
        <x-shared.assets.icon name="sort-desc" class="h-5 w-5" />
    @endif
</a>
