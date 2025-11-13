@props([
    'task',
    'show',
    'edit' => 'openEdit',
])

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
        class="relative w-full max-w-3xl rounded-2xl bg-white p-6 shadow-xl dark:bg-slate-900"
        @click.stop
    >
        <button type="button" @click.stop="{{ $show }} = false" class="absolute right-4 top-4 rounded-full p-2 text-slate-500 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800" aria-label="閉じる">
            <x-shared.assets.icon name="close" class="h-4 w-4" />
        </button>
        <div class="flex flex-col gap-4 pr-8 sm:flex-row sm:items-start sm:justify-between">
            <div class="max-w-2xl">
                <h3 class="text-2xl font-bold text-slate-900 dark:text-white">{{ $task->title }}</h3>
                <p class="mt-1 text-sm text-slate-400 dark:text-slate-500">作成日: {{ $task->created_at?->format('Y.m.d H:i') }}</p>
            </div>
            <div class="flex items-start gap-8 text-right text-sm text-slate-600 dark:text-slate-300">
                <div>
                    <span class="text-xs uppercase tracking-wide text-slate-400">期限</span><br>
                    <span class="font-semibold">{{ $task->due_date?->format('Y/m/d') ?? '未設定' }}</span>
                </div>
                <div>
                    <span class="text-xs uppercase tracking-wide text-slate-400">優先度</span><br>
                    <span class="font-semibold">{{ $task->priority }}</span>
                </div>
            </div>
        </div>
        <p class="mt-6 break-words text-base leading-relaxed text-slate-700 dark:text-slate-200">
            {{ $task->description ?: '説明が登録されていません。' }}
        </p>
        <div class="mt-8 flex items-center justify-end">
            <x-shared.buttons.button type="button" variant="outline" size="sm" class="inline-flex items-center gap-2" @click="{{ $show }} = false; {{ $edit }} = true">
                <x-shared.assets.icon name="edit" class="h-4 w-4" />
                編集
            </x-shared.buttons.button>
        </div>
    </div>
</div>
