@extends('layouts.app')

@section('title', 'ToDo一覧 | Todin')

@section('content')
    <section class="rounded-2xl bg-white p-8 shadow-sm dark:bg-slate-800 dark:shadow-black/20">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-rose-400">Dashboard</p>
                <h1 class="text-3xl font-bold text-slate-900 dark:text-white">ToDo一覧</h1>
            </div>
            <form method="GET" action="{{ route('todos.index') }}" class="flex items-center gap-3">
                <label for="sort" class="text-sm font-semibold text-slate-600 dark:text-slate-300">並び替え</label>
                <select id="sort" name="sort" onchange="this.form.submit()" class="rounded-xl border border-slate-200 pr-8 pl-6 py-2 text-sm focus:border-rose-400 focus:outline-none dark:border-slate-600 dark:bg-slate-900 dark:text-slate-100">
                    @foreach ($sortOptions as $value => $label)
                        <option value="{{ $value }}" @selected($sort === $value)>{{ $label }}</option>
                    @endforeach
                </select>
            </form>
        </div>

        <form method="POST" action="{{ route('todos.store') }}" class="mt-8 grid gap-6 lg:grid-cols-2">
            @csrf
            <div class="space-y-3">
                <label for="title" class="text-sm font-semibold text-slate-700 dark:text-slate-200">タイトル</label>
                <input id="title" name="title" type="text" value="{{ old('title') }}" required placeholder="例：週次ミーティングの準備" class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-rose-400 focus:outline-none dark:border-slate-600 dark:bg-slate-900 dark:text-slate-100">
            </div>
            <div class="space-y-3">
                <label for="due_date" class="text-sm font-semibold text-slate-700 dark:text-slate-200">期限</label>
                <input id="due_date" name="due_date" type="date" value="{{ old('due_date') }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-rose-400 focus:outline-none dark:border-slate-600 dark:bg-slate-900 dark:text-slate-100">
            </div>
            <div class="space-y-3 lg:col-span-2">
                <label for="description" class="text-sm font-semibold text-slate-700 dark:text-slate-200">内容</label>
                <textarea id="description" name="description" rows="3" placeholder="メモや詳細をここに残せます" class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-rose-400 focus:outline-none dark:border-slate-600 dark:bg-slate-900 dark:text-slate-100">{{ old('description') }}</textarea>
            </div>
            <div class="flex flex-col gap-3 lg:w-48">
                <label for="priority" class="text-sm font-semibold text-slate-700 dark:text-slate-200">優先度 (0-5)</label>
                <input id="priority" name="priority" type="number" min="0" max="5" value="{{ old('priority', 0) }}" class="rounded-xl border border-slate-200 px-4 py-3 focus:border-rose-400 focus:outline-none dark:border-slate-600 dark:bg-slate-900 dark:text-slate-100">
            </div>
            <div class="lg:col-span-2">
                <button type="submit" class="w-full rounded-2xl bg-rose-500 px-6 py-3 font-semibold text-white shadow hover:bg-rose-600 lg:w-auto">タスクを追加</button>
            </div>
        </form>

        @if ($errors->any())
            <div class="mt-6 rounded-lg border border-rose-200 bg-rose-50 p-4 text-sm text-rose-600 dark:border-rose-400/40 dark:bg-rose-500/10 dark:text-rose-200">
                <p class="font-semibold">エラー</p>
                <ul class="mt-2 list-disc space-y-1 pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </section>

    <section class="mt-8 grid gap-5 lg:grid-cols-2">
        @forelse ($tasks as $task)
            <article class="rounded-2xl border border-slate-100 bg-white p-6 shadow-sm dark:border-slate-700 dark:bg-slate-800 dark:shadow-black/20">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.3em] text-slate-400 dark:text-slate-500">{{ $task->created_at?->format('Y.m.d') }}</p>
                        <h2 class="mt-2 text-xl font-bold text-slate-900 dark:text-white">
                            {{ $task->title }}
                        </h2>
                    </div>
                    <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $task->is_completed ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                        {{ $task->is_completed ? '完了' : '未完了' }}
                    </span>
                </div>
                @if ($task->description)
                    <p class="mt-3 text-sm text-slate-600 dark:text-slate-300">{{ $task->description }}</p>
                @endif

                <dl class="mt-4 grid grid-cols-2 gap-4 text-sm text-slate-500 dark:text-slate-300">
                    <div>
                        <dt class="font-semibold text-slate-600 dark:text-slate-200">期限</dt>
                        <dd>{{ $task->due_date?->format('Y/m/d') ?? '未設定' }}</dd>
                    </div>
                    <div>
                        <dt class="font-semibold text-slate-600 dark:text-slate-200">優先度</dt>
                        <dd>{{ $task->priority }}</dd>
                    </div>
                </dl>

                <div class="mt-5 flex flex-wrap gap-3 text-sm">
                    <form method="POST" action="{{ route('todos.complete', $task) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="rounded-full border border-slate-200 px-4 py-2 font-semibold text-slate-600 hover:border-emerald-200 hover:text-emerald-600 dark:border-slate-600 dark:text-slate-200 dark:hover:text-emerald-300">
                            {{ $task->is_completed ? '未完了に戻す' : '完了にする' }}
                        </button>
                    </form>
                    <form method="POST" action="{{ route('todos.destroy', $task) }}" onsubmit="return confirm('削除してもよろしいですか？');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="rounded-full border border-slate-200 px-4 py-2 font-semibold text-slate-600 hover:border-rose-200 hover:text-rose-600 dark:border-slate-600 dark:text-slate-200 dark:hover:text-rose-300">削除</button>
                    </form>
                </div>

                <details class="mt-5 rounded-xl border border-slate-100 bg-slate-50 p-4 text-sm text-slate-600 dark:border-slate-600 dark:bg-slate-900/40 dark:text-slate-200">
                    <summary class="cursor-pointer font-semibold text-slate-700 dark:text-slate-100">編集フォーム</summary>
                    <form method="POST" action="{{ route('todos.update', $task) }}" class="mt-4 space-y-3">
                        @csrf
                        @method('PATCH')
                        <div>
                            <label class="text-xs font-semibold" for="title-{{ $task->id }}">タイトル</label>
                            <input id="title-{{ $task->id }}" name="title" type="text" value="{{ old('title', $task->title) }}" required class="mt-1 w-full rounded-lg border border-slate-200 px-3 py-2 focus:border-rose-400 focus:outline-none dark:border-slate-600 dark:bg-slate-900 dark:text-slate-100">
                        </div>
                        <div>
                            <label class="text-xs font-semibold" for="description-{{ $task->id }}">内容</label>
                            <textarea id="description-{{ $task->id }}" name="description" rows="2" class="mt-1 w-full rounded-lg border border-slate-200 px-3 py-2 focus:border-rose-400 focus:outline-none dark:border-slate-600 dark:bg-slate-900 dark:text-slate-100">{{ old('description', $task->description) }}</textarea>
                        </div>
                        <div class="grid gap-3 sm:grid-cols-2">
                            <div>
                                <label class="text-xs font-semibold" for="due-{{ $task->id }}">期限</label>
                                <input id="due-{{ $task->id }}" type="date" name="due_date" value="{{ old('due_date', optional($task->due_date)->format('Y-m-d')) }}" class="mt-1 w-full rounded-lg border border-slate-200 px-3 py-2 focus:border-rose-400 focus:outline-none dark:border-slate-600 dark:bg-slate-900 dark:text-slate-100">
                            </div>
                            <div>
                                <label class="text-xs font-semibold" for="priority-{{ $task->id }}">優先度</label>
                                <input id="priority-{{ $task->id }}" type="number" name="priority" min="0" max="5" value="{{ old('priority', $task->priority) }}" class="mt-1 w-full rounded-lg border border-slate-200 px-3 py-2 focus:border-rose-400 focus:outline-none dark:border-slate-600 dark:bg-slate-900 dark:text-slate-100">
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="rounded-full bg-slate-900 px-4 py-2 font-semibold text-white dark:bg-slate-100 dark:text-slate-900">更新する</button>
                        </div>
                    </form>
                </details>
            </article>
        @empty
            <div class="rounded-2xl border border-dashed border-slate-200 bg-white p-10 text-center text-slate-500 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-300 lg:col-span-2">
                まだタスクがありません。上部のフォームから追加しましょう。
            </div>
        @endforelse
    </section>
@endsection
