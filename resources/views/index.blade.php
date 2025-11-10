@extends('layouts.app')

@section('title', 'ToDo一覧 | Todin')

@section('content')
    <section x-data="{ showCreate: false }" class="rounded-2xl bg-white p-8 shadow-sm dark:bg-slate-800 dark:shadow-black/20">
        <x-layout.page-header title="ToDo一覧" subtitle="Dashboard">
            <form method="GET" action="{{ route('todos.index') }}" class="flex items-center gap-3">
                <label for="sort" class="text-sm font-semibold text-slate-600 dark:text-slate-300">並び替え</label>
                <select id="sort" name="sort" onchange="this.form.submit()" class="rounded-xl border border-slate-200 pr-8 pl-6 py-2 text-sm focus:border-rose-400 focus:outline-none dark:border-slate-600 dark:bg-slate-900 dark:text-slate-100">
                    @foreach ($sortOptions as $value => $label)
                        <option value="{{ $value }}" @selected($sort === $value)>{{ $label }}</option>
                    @endforeach
                </select>
                <input type="hidden" name="direction" value="{{ $direction ?? 'asc' }}">
            </form>
            @php
                $toggleParams = array_merge(request()->query(), [
                    'sort' => $sort,
                    'direction' => $nextDirection ?? 'desc',
                ]);
                $isAsc = ($direction ?? 'asc') === 'asc';
            @endphp
            <a href="{{ route('todos.index', $toggleParams) }}" class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 bg-white text-slate-600 transition hover:border-rose-300 hover:text-rose-500 dark:border-slate-600 dark:bg-slate-900 dark:text-slate-200" aria-label="並び順を{{ $isAsc ? '降順' : '昇順' }}に切り替え" title="並び順を{{ $isAsc ? '降順' : '昇順' }}に切り替え">
                @if ($isAsc)
                    <svg class="h-5 w-5" viewBox="0 0 640 640" aria-hidden="true">
                        <path fill="currentColor" d="M352 96C334.3 96 320 110.3 320 128C320 145.7 334.3 160 352 160L384 160C401.7 160 416 145.7 416 128C416 110.3 401.7 96 384 96L352 96zM352 224C334.3 224 320 238.3 320 256C320 273.7 334.3 288 352 288L448 288C465.7 288 480 273.7 480 256C480 238.3 465.7 224 448 224L352 224zM352 352C334.3 352 320 366.3 320 384C320 401.7 334.3 416 352 416L512 416C529.7 416 544 401.7 544 384C544 366.3 529.7 352 512 352L352 352zM352 480C334.3 480 320 494.3 320 512C320 529.7 334.3 544 352 544L576 544C593.7 544 608 529.7 608 512C608 494.3 593.7 480 576 480L352 480zM182.6 105.4C170.1 92.9 149.8 92.9 137.3 105.4L41.3 201.4C28.8 213.9 28.8 234.2 41.3 246.7C53.8 259.2 74.1 259.2 86.6 246.7L128 205.3L128 512C128 529.7 142.3 544 160 544C177.7 544 192 529.7 192 512L192 205.3L233.4 246.7C245.9 259.2 266.2 259.2 278.7 246.7C291.2 234.2 291.2 213.9 278.7 201.4L182.7 105.4z" />
                    </svg>
                @else
                    <svg class="h-5 w-5" viewBox="0 0 640 640" aria-hidden="true">
                        <path fill="currentColor" d="M182.6 105.4C170.1 92.9 149.8 92.9 137.3 105.4L41.3 201.4C28.8 213.9 28.8 234.2 41.3 246.7C53.8 259.2 74.1 259.2 86.6 246.7L128 205.3L128 512C128 529.7 142.3 544 160 544C177.7 544 192 529.7 192 512L192 205.3L233.4 246.7C245.9 259.2 266.2 259.2 278.7 246.7C291.2 234.2 291.2 213.9 278.7 201.4L182.7 105.4zM352 544L384 544C401.7 544 416 529.7 416 512C416 494.3 401.7 480 384 480L352 480C334.3 480 320 494.3 320 512C320 529.7 334.3 544 352 544zM352 416L448 416C465.7 416 480 401.7 480 384C480 366.3 465.7 352 448 352L352 352C334.3 352 320 366.3 320 384C320 401.7 334.3 416 352 416zM352 288L512 288C529.7 288 544 273.7 544 256C544 238.3 529.7 224 512 224L352 224C334.3 224 320 238.3 320 256C320 273.7 334.3 288 352 288zM352 160L576 160C593.7 160 608 145.7 608 128C608 110.3 593.7 96 576 96L352 96C334.3 96 320 110.3 320 128C320 145.7 334.3 160 352 160z" />
                    </svg>
                @endif
            </a>
            <button type="button" @click="showCreate = true" class="inline-flex items-center gap-2 rounded-full bg-rose-500 px-6 py-2 font-semibold text-white shadow hover:bg-rose-600">
                タスク新規作成
            </button>
        </x-layout.page-header>

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

        <x-todo.modals.create-task show="showCreate" />
    </section>

    <section class="mt-8 space-y-5">
        @forelse ($tasks as $task)
            <x-todo.task-card :task="$task" />
        @empty
            <div class="rounded-2xl border border-dashed border-slate-200 bg-white p-10 text-center text-slate-500 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-300 lg:col-span-2">
                まだタスクがありません。上部のフォームから追加しましょう。
            </div>
        @endforelse
    </section>
@endsection
