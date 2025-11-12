@props([
    'titleId' => 'title',
    'descriptionId' => 'description',
    'dueDateId' => 'due_date',
    'priorityId' => 'priority',
    'titleValue' => '',
    'descriptionValue' => '',
    'dueDateValue' => '',
    'priorityValue' => 0,
    'priorityLabel' => '優先度',
    'variant' => 'default',
    'groupLayout' => 'stack',
    'titlePlaceholder' => '例：週次ミーティングの準備',
    'descriptionPlaceholder' => 'メモや詳細をここに残せます',
])

@php
    $isCompact = $variant === 'compact';
    $labelClass = $isCompact
        ? 'text-xs font-semibold text-slate-600 dark:text-slate-300'
        : 'text-sm font-semibold text-slate-700 dark:text-slate-200';
    $inputClass = $isCompact
        ? 'mt-1 w-full rounded-lg border border-slate-200 px-3 py-2 focus:border-rose-400 focus:outline-none dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100'
        : 'mt-1 w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-rose-400 focus:outline-none dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100';
@endphp

<div class="space-y-4">
    <div>
        <label for="{{ $titleId }}" class="{{ $labelClass }}">タイトル</label>
        <input id="{{ $titleId }}" name="title" type="text" value="{{ $titleValue }}" required placeholder="{{ $titlePlaceholder }}" class="{{ $inputClass }}">
    </div>

    <div>
        <label for="{{ $descriptionId }}" class="{{ $labelClass }}">内容</label>
        <textarea id="{{ $descriptionId }}" name="description" rows="3" placeholder="{{ $descriptionPlaceholder }}" class="{{ $inputClass }}">{{ $descriptionValue }}</textarea>
    </div>

    @if ($groupLayout === 'grid')
        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label for="{{ $dueDateId }}" class="{{ $labelClass }}">期限</label>
                <input id="{{ $dueDateId }}" name="due_date" type="date" value="{{ $dueDateValue }}" class="{{ $inputClass }}">
            </div>
            <div>
                <label for="{{ $priorityId }}" class="{{ $labelClass }}">{{ $priorityLabel }}</label>
                <input id="{{ $priorityId }}" name="priority" type="number" min="0" max="5" value="{{ $priorityValue }}" class="{{ $inputClass }}">
            </div>
        </div>
    @else
        <div>
            <label for="{{ $dueDateId }}" class="{{ $labelClass }}">期限</label>
            <input id="{{ $dueDateId }}" name="due_date" type="date" value="{{ $dueDateValue }}" class="{{ $inputClass }}">
        </div>
        <div>
            <label for="{{ $priorityId }}" class="{{ $labelClass }}">{{ $priorityLabel }}</label>
            <input id="{{ $priorityId }}" name="priority" type="number" min="0" max="5" value="{{ $priorityValue }}" class="{{ $inputClass }}">
        </div>
    @endif
</div>
