    <section class="relative min-h-[70vh] overflow-hidden rounded-3xl bg-dots-darker bg-center bg-gray-100 p-10 text-center dark:bg-dots-lighter dark:bg-gray-900">
        <div class="mx-auto flex max-w-3xl flex-col items-center justify-center gap-6 py-12">
            <p class="text-sm font-semibold uppercase tracking-[0.5em] text-rose-400">日常を整える</p>
            <h2 class="text-3xl font-semibold text-slate-600 dark:text-slate-200">Todinで毎日のタスクをシンプルに管理</h2>
            <h1 class="todin-hero text-5xl font-bold text-gray-900 dark:text-white sm:text-6xl">
                <span class="todin-hero__text">Todin</span>
            </h1>
            <div class="text-lg leading-relaxed text-slate-600 dark:text-slate-300">
                <p>ブラウザだけで完結する軽量ToDoアプリです。</p>
                <p>ログインして、タスクを追加・整理・完了させましょう。</p>
            </div>
            <div class="mt-6 flex flex-wrap items-center justify-center gap-4">
                <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-full bg-rose-500 px-8 py-3 font-semibold text-white shadow-lg shadow-rose-500/30 transition hover:bg-rose-600">
                    ログイン
                </a>
                <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-full border border-slate-300 px-8 py-3 font-semibold text-slate-700 transition hover:border-slate-400 hover:text-slate-900 dark:border-slate-600 dark:text-slate-200 dark:hover:border-slate-500">
                    新規登録
                </a>
            </div>
        </div>
    </section>