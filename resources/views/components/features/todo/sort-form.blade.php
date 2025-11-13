@props([
    'sort',
    'direction',
    'options' => [],
])

<form method="GET" action="{{ route('todos.index') }}" class="flex items-center gap-3">
    <label for="sort" class="text-sm font-semibold text-slate-600 dark:text-slate-300">並び替え</label>
    <select id="sort" name="sort" onchange="this.form.submit()" class="rounded-xl border border-slate-200 pr-8 pl-6 py-2 text-sm focus:border-rose-400 focus:outline-none dark:border-slate-600 dark:bg-slate-900 dark:text-slate-100">
        @foreach ($options as $value => $label)
            <option value="{{ $value }}" @selected($sort === $value)>{{ $label }}</option>
        @endforeach
    </select>
    <input type="hidden" name="direction" value="{{ $direction ?? 'asc' }}">
</form>
