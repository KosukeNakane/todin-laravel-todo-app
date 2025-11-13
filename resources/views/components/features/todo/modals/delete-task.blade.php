@props([
    'task',
    'show',
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
        class="relative w-full max-w-lg rounded-2xl bg-white p-6 shadow-xl dark:bg-slate-900"
        @click.stop
    >
        <button type="button" @click.stop="{{ $show }} = false" class="absolute right-4 top-4 rounded-full p-2 text-slate-500 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800" aria-label="閉じる">
            <x-shared.assets.icon name="close" class="h-4 w-4" />
        </button>
        <div class="text-center">
            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-rose-100 text-rose-600 dark:bg-rose-500/20 dark:text-rose-200">
                <x-shared.assets.icon name="trash" class="h-7 w-7" />
            </div>
            <h3 class="mt-4 text-xl font-semibold text-slate-900 dark:text-white">タスクを削除</h3>
            <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">
                「{{ $task->title }}」を削除しますか？この操作は元に戻せません。
            </p>
        </div>
        <div class="mt-8 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
            <x-shared.buttons.button type="button" variant="outline" size="sm" @click.stop="{{ $show }} = false">
                キャンセル
            </x-shared.buttons.button>
            <form method="POST" action="{{ route('todos.destroy', $task) }}" class="flex justify-end">
                @csrf
                @method('DELETE')
                <x-shared.buttons.button type="submit" variant="danger" size="sm" class="inline-flex items-center gap-2">
                    削除する
                </x-shared.buttons.button>
            </form>
        </div>
    </div>
</div>
