@props(['user'])

<dl class="mt-6 grid gap-4 rounded-2xl border border-slate-100.bg-slate-50 p-6 sm:grid-cols-2 dark:border-slate-700 dark:bg-slate-900/40">
    <div>
        <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-300">お名前</dt>
        <dd class="mt-1 text-lg font-semibold text-slate-900 dark:text-white">{{ $user->name }}</dd>
    </div>
    <div>
        <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-300">メールアドレス</dt>
        <dd class="mt-1 text-lg font-semibold text-slate-900 dark:text-white">{{ $user->email }}</dd>
    </div>
</dl>
