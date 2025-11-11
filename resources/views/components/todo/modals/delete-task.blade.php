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
            <svg class="h-4 w-4" viewBox="0 0 640 640" aria-hidden="true">
                <path fill="currentColor" d="M183.1 137.4C170.6 124.9 150.3 124.9 137.8 137.4C125.3 149.9 125.3 170.2 137.8 182.7L275.2 320L137.9 457.4C125.4 469.9 125.4 490.2 137.9 502.7C150.4 515.2 170.7 515.2 183.2 502.7L320.5 365.3L457.9 502.6C470.4 515.1 490.7 515.1 503.2 502.6C515.7 490.1 515.7 469.8 503.2 457.3L365.8 320L503.1 182.6C515.6 170.1 515.6 149.8 503.1 137.3C490.6 124.8 470.3 124.8 457.8 137.3L320.5 274.7L183.1 137.4z" />
            </svg>
        </button>
        <div class="text-center">
            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-rose-100 text-rose-600 dark:bg-rose-500/20 dark:text-rose-200">
                <svg class="h-7 w-7" viewBox="0 0 640 640" aria-hidden="true">
                    <path fill="currentColor" d="M232.7 69.9L224 96L128 96C110.3 96 96 110.3 96 128C96 145.7 110.3 160 128 160L512 160C529.7 160 544 145.7 544 128C544 110.3 529.7 96 512 96L416 96L407.3 69.9C402.9 56.8 390.7 48 376.9 48L263.1 48C249.3 48 237.1 56.8 232.7 69.9zM512 208L128 208L149.1 531.1C150.7 556.4 171.7 576 197 576L443 576C468.3 576 489.3 556.4 490.9 531.1L512 208z" />
                </svg>
            </div>
            <h3 class="mt-4 text-xl font-semibold text-slate-900 dark:text-white">タスクを削除</h3>
            <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">
                「{{ $task->title }}」を削除しますか？この操作は元に戻せません。
            </p>
        </div>
        <div class="mt-8 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
            <button type="button" @click.stop="{{ $show }} = false" class="rounded-full border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-100 dark:border-slate-600 dark:text-slate-200 dark:hover:bg-slate-800">キャンセル</button>
            <form method="POST" action="{{ route('todos.destroy', $task) }}" class="flex justify-end">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center gap-2 rounded-full bg-rose-500 px-5 py-2 text-sm font-semibold text-white hover:bg-rose-600">
                      削除する
                </button>
            </form>
        </div>
    </div>
</div>
