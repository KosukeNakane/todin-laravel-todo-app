@props([
    'tasks',
    'sort',
    'sortOptions',
    'direction',
    'nextDirection',
])

<div>
    <section x-data="{ showCreate: false }" class="rounded-2xl bg-white p-8 shadow-sm dark:bg-slate-800 dark:shadow-black/20">
        <x-shared.layout.page-header title="ToDo一覧" subtitle="Dashboard">
            <x-features.todo.sort-form :sort="$sort" :direction="$direction" :options="$sortOptions" />
            <x-features.todo.sort-toggle :sort="$sort" :direction="$direction" :next-direction="$nextDirection" />
            <x-shared.buttons.button type="button" variant="primary" size="md" shadow="true" @click="showCreate = true">
                タスク新規作成
            </x-shared.buttons.button>
        </x-shared.layout.page-header>

        <x-shared.alerts.error-list />

        <x-features.todo.modals.create-task show="showCreate" />
    </section>

    <section class="mt-8 space-y-5">
        @forelse ($tasks as $task)
            <x-features.todo.task-card :task="$task" />
        @empty
            <div class="rounded-2xl border border-dashed border-slate-200 bg-white p-10 text-center text-slate-500 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-300 lg:col-span-2">
                まだタスクがありません。上部のフォームから追加しましょう。
            </div>
        @endforelse
    </section>
</div>
