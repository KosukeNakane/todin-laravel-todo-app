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

<div
    x-show="{{ $show }}"
    x-transition:enter="modal-overlay-enter"
    x-transition:enter-start="modal-overlay-enter-start"
    x-transition:enter-end="modal-overlay-enter-end"
    x-transition:leave="modal-overlay-leave"
    x-transition:leave-start="modal-overlay-leave-start"
    x-transition:leave-end="modal-overlay-leave-end"
    class="fixed inset-0 z-40 flex items-center justify-center bg-slate-900/60 p-4"
    x-cloak
    @click.self.stop="{{ $show }} = false"
>
    <div
        x-show="{{ $show }}"
        x-transition:enter="modal-panel-enter"
        x-transition:enter-start="modal-panel-enter-start"
        x-transition:enter-end="modal-panel-enter-end"
        x-transition:leave="modal-panel-leave"
        x-transition:leave-start="modal-panel-leave-start"
        x-transition:leave-end="modal-panel-leave-end"
        class="relative w-full max-w-2xl rounded-2xl bg-white p-6 shadow-xl dark:bg-slate-900"
        @click.stop
    >
        <button type="button" @click.stop="{{ $show }} = false" class="absolute right-4 top-4 rounded-full p-2 text-slate-500 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800" aria-label="閉じる">
            <x-shared.assets.icon name="close" class="h-4 w-4" />
        </button>
        <h3 class="text-lg font-semibold text-slate-900 dark:text-white">タスクを編集</h3>
        <form method="POST" action="{{ route('todos.update', $task) }}" class="mt-6 space-y-4">
            @csrf
            @method('PATCH')
            <x-features.todo.forms.task-fields
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
                <x-shared.buttons.button type="button" variant="outline" size="sm" @click.stop="{{ $show }} = false">
                    キャンセル
                </x-shared.buttons.button>
                <x-shared.buttons.button type="submit" variant="primary" size="sm">
                    更新する
                </x-shared.buttons.button>
            </div>
        </form>
    </div>
</div>
