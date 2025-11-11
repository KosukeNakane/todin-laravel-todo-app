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
            <svg class="h-4 w-4" viewBox="0 0 640 640" aria-hidden="true">
                <path fill="currentColor" d="M183.1 137.4C170.6 124.9 150.3 124.9 137.8 137.4C125.3 149.9 125.3 170.2 137.8 182.7L275.2 320L137.9 457.4C125.4 469.9 125.4 490.2 137.9 502.7C150.4 515.2 170.7 515.2 183.2 502.7L320.5 365.3L457.9 502.6C470.4 515.1 490.7 515.1 503.2 502.6C515.7 490.1 515.7 469.8 503.2 457.3L365.8 320L503.1 182.6C515.6 170.1 515.6 149.8 503.1 137.3C490.6 124.8 470.3 124.8 457.8 137.3L320.5 274.7L183.1 137.4z" />
            </svg>
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
            <button type="button" @click="{{ $show }} = false; {{ $edit }} = true" class="inline-flex items-center gap-2 rounded-full border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 dark:border-slate-600 dark:text-slate-200">
                <svg class="h-4 w-4" viewBox="0 0 640 640" aria-hidden="true">
                    <path fill="currentColor" d="M535.6 85.7C513.7 63.8 478.3 63.8 456.4 85.7L432 110.1L529.9 208L554.3 183.6C576.2 161.7 576.2 126.3 554.3 104.4L535.6 85.7zM236.4 305.7C230.3 311.8 225.6 319.3 222.9 327.6L193.3 416.4C190.4 425 192.7 434.5 199.1 441C205.5 447.5 215 449.7 223.7 446.8L312.5 417.2C320.7 414.5 328.2 409.8 334.4 403.7L496 241.9L398.1 144L236.4 305.7zM160 128C107 128 64 171 64 224L64 480C64 533 107 576 160 576L416 576C469 576 512 533 512 480L512 384C512 366.3 497.7 352 480 352C462.3 352 448 366.3 448 384L448 480C448 497.7 433.7 512 416 512L160 512C142.3 512 128 497.7 128 480L128 224C128 206.3 142.3 192 160 192L256 192C273.7 192 288 177.7 288 160C288 142.3 273.7 128 256 128L160 128z" />
                </svg>
                編集
            </button>
        </div>
    </div>
</div>
