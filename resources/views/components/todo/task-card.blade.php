@props(['task'])

@php
    $completeButtonStyles = 'border border-slate-200 bg-white text-slate-600 hover:bg-slate-50 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-200';
@endphp

<article x-data="{ openEdit: false, showDescription: false, openDelete: false }" @click="showDescription = true" class="cursor-pointer rounded-2xl border border-slate-100 bg-white p-6 shadow-sm transition hover:border-rose-200 dark:border-slate-700 dark:bg-slate-800 dark:shadow-black/20">
    <div class="flex items-start justify-between gap-4">
        <div class="space-y-1">
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">
                {{ $task->title }}
            </h2>
            <p class="text-xs font-semibold uppercase tracking-[0.3em] text-slate-400 dark:text-slate-500">
                作成日: {{ $task->created_at?->format('Y.m.d') }}
            </p>
        </div>
        <span class="rounded-full px-4 py-2 text-sm font-semibold {{ $task->is_completed ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
            {{ $task->is_completed ? '完了' : '未完了' }}
        </span>
    </div>

    <p class="mt-3 text-sm text-slate-500 dark:text-slate-300">
        {{ $task->description ? \Illuminate\Support\Str::limit($task->description, 80) : '説明が登録されていません。' }}
    </p>

    <div class="mt-3 flex flex-wrap items-center justify-between gap-4 text-sm">
        <div class="flex flex-wrap items-center gap-6 text-slate-600 dark:text-slate-300">
            <span class="font-semibold">期限:
                <span class="font-normal">{{ $task->due_date?->format('Y/m/d') ?? '未設定' }}</span>
            </span>
            <span class="font-semibold">優先度:
                <span class="font-normal">{{ $task->priority }}</span>
            </span>
        </div>
        <div class="flex items-center gap-3 text-sm" @click.stop>
            <form method="POST" action="{{ route('todos.complete', $task) }}">
                @csrf
                @method('PATCH')
                <button type="submit" class="inline-flex w-40 items-center gap-2 rounded-full px-4 py-2 font-semibold transition {{ $completeButtonStyles }} justify-start">
                    <svg class="h-5 w-5" viewBox="0 0 640 640" aria-hidden="true">
                        <path fill="currentColor" d="M320 576C178.6 576 64 461.4 64 320C64 178.6 178.6 64 320 64C461.4 64 576 178.6 576 320C576 461.4 461.4 576 320 576zM438 209.7C427.3 201.9 412.3 204.3 404.5 215L285.1 379.2L233 327.1C223.6 317.7 208.4 317.7 199.1 327.1C189.8 336.5 189.7 351.7 199.1 361L271.1 433C276.1 438 282.9 440.5 289.9 440C296.9 439.5 303.3 435.9 307.4 430.2L443.3 243.2C451.1 232.5 448.7 217.5 438 209.7z" />
                    </svg>
                    <span class="hidden sm:inline-flex sm:flex-1 sm:justify-center">{{ $task->is_completed ? '未完了に戻す' : '完了にする' }}</span>
                </button>
            </form>
            <button type="button" @click.stop="openDelete = true" class="inline-flex items-center gap-2 rounded-full border border-rose-200 px-4 py-2 font-semibold text-rose-500 transition hover:bg-rose-50 dark:border-rose-400/40 dark:text-rose-300">
                <svg class="h-5 w-5" viewBox="0 0 640 640" aria-hidden="true">
                    <path fill="currentColor" d="M232.7 69.9L224 96L128 96C110.3 96 96 110.3 96 128C96 145.7 110.3 160 128 160L512 160C529.7 160 544 145.7 544 128C544 110.3 529.7 96 512 96L416 96L407.3 69.9C402.9 56.8 390.7 48 376.9 48L263.1 48C249.3 48 237.1 56.8 232.7 69.9zM512 208L128 208L149.1 531.1C150.7 556.4 171.7 576 197 576L443 576C468.3 576 489.3 556.4 490.9 531.1L512 208z" />
                </svg>
                <span class="hidden sm:inline">削除</span>
            </button>
            <button type="button" @click.stop="openEdit = true" class="inline-flex items-center gap-2 rounded-full border border-slate-200 px-4 py-2 font-semibold text-slate-600 transition hover:bg-slate-50 dark:border-slate-600 dark:text-slate-200">
                <svg class="h-5 w-5" viewBox="0 0 640 640" aria-hidden="true">
                    <path fill="currentColor" d="M535.6 85.7C513.7 63.8 478.3 63.8 456.4 85.7L432 110.1L529.9 208L554.3 183.6C576.2 161.7 576.2 126.3 554.3 104.4L535.6 85.7zM236.4 305.7C230.3 311.8 225.6 319.3 222.9 327.6L193.3 416.4C190.4 425 192.7 434.5 199.1 441C205.5 447.5 215 449.7 223.7 446.8L312.5 417.2C320.7 414.5 328.2 409.8 334.4 403.7L496 241.9L398.1 144L236.4 305.7zM160 128C107 128 64 171 64 224L64 480C64 533 107 576 160 576L416 576C469 576 512 533 512 480L512 384C512 366.3 497.7 352 480 352C462.3 352 448 366.3 448 384L448 480C448 497.7 433.7 512 416 512L160 512C142.3 512 128 497.7 128 480L128 224C128 206.3 142.3 192 160 192L256 192C273.7 192 288 177.7 288 160C288 142.3 273.7 128 256 128L160 128z" />
                </svg>
                <span class="hidden sm:inline">編集</span>
            </button>
        </div>
    </div>

    <x-todo.modals.description :task="$task" show="showDescription" edit="openEdit" />
    <x-todo.modals.edit-task :task="$task" show="openEdit" />
    <x-todo.modals.delete-task :task="$task" show="openDelete" />
</article>
