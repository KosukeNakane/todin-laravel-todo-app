@props([
    'task',
    'show',
])

@php
    $titleId = 'title-' . $task->id;
    $descriptionId = 'description-' . $task->id;
    $dueDateId = 'due-' . $task->id;
    $priorityId = 'priority-' . $task->id;
@endphp

<div x-show="{{ $show }}" x-transition.opacity class="fixed inset-0 z-40 flex items-center justify-center bg-slate-900/60 p-4" x-cloak @click.self.stop="{{ $show }} = false">
    <div x-show="{{ $show }}" x-transition.scale class="relative w-full max-w-2xl rounded-2xl bg-white p-6 shadow-xl dark:bg-slate-900" @click.stop>
        <button type="button" @click.stop="{{ $show }} = false" class="absolute right-4 top-4 rounded-full p-2 text-slate-500 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800" aria-label="閉じる">
            <svg class="h-4 w-4" viewBox="0 0 640 640" aria-hidden="true">
                <path fill="currentColor" d="M183.1 137.4C170.6 124.9 150.3 124.9 137.8 137.4C125.3 149.9 125.3 170.2 137.8 182.7L275.2 320L137.9 457.4C125.4 469.9 125.4 490.2 137.9 502.7C150.4 515.2 170.7 515.2 183.2 502.7L320.5 365.3L457.9 502.6C470.4 515.1 490.7 515.1 503.2 502.6C515.7 490.1 515.7 469.8 503.2 457.3L365.8 320L503.1 182.6C515.6 170.1 515.6 149.8 503.1 137.3C490.6 124.8 470.3 124.8 457.8 137.3L320.5 274.7L183.1 137.4z" />
            </svg>
        </button>
        <h3 class="text-lg font-semibold text-slate-900 dark:text-white">タスクを編集</h3>
        <form method="POST" action="{{ route('todos.update', $task) }}" class="mt-6 space-y-4">
            @csrf
            @method('PATCH')
            <x-todo.forms.task-fields
                :title-id="$titleId"
                :description-id="$descriptionId"
                :due-date-id="$dueDateId"
                :priority-id="$priorityId"
                :title-value="old('title', $task->title)"
                :description-value="old('description', $task->description)"
                :due-date-value="old('due_date', optional($task->due_date)->format('Y-m-d'))"
                :priority-value="old('priority', $task->priority)"
                variant="compact"
                group-layout="grid"
                title-placeholder=""
                description-placeholder=""
                priority-label="優先度"
            />
            <div class="flex items-center justify-end gap-3">
                <button type="button" @click.stop="{{ $show }} = false" class="rounded-full border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-100 dark:border-slate-600 dark:text-slate-200 dark:hover:bg-slate-800">キャンセル</button>
                <button type="submit" class="rounded-full bg-rose-500 px-5 py-2 text-sm font-semibold text-white hover:bg-rose-600">更新する</button>
            </div>
        </form>
    </div>
</div>
