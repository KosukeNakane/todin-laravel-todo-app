@props(['user'])

<section class="rounded-2xl bg-white p-8 shadow-sm dark:bg-slate-800 dark:shadow-black/20">
    <p class="text-sm font-semibold uppercase tracking-[0.3em] text-rose-400">Profile</p>
    <h1 class="mt-2 text-3xl font-bold text-slate-900 dark:text-white">ユーザー設定</h1>
    <p class="mt-1 text-sm text-slate-500 dark:text-slate-300">アカウント情報の確認・更新ができます。</p>

    <x-shared.alerts.status :message="session('status') === 'password-updated' ? 'パスワードを更新しました。' : session('status')" />

    <x-features.user.summary :user="$user" />

    <x-features.user.update-form :user="$user" />

    <div class="mt-12 border-t border-slate-100 pt-10 dark:border-slate-700">
        <p class="text-sm font-semibold uppercase tracking-[0.3em] text-rose-400">Security</p>
        <h2 class="mt-2 text-2xl font-bold text-slate-900 dark:text-white">パスワード変更</h2>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-300">現在のパスワードと新しいパスワードを入力してください。（英数字を含む8文字以上）</p>

        <x-features.user.password-form />
    </div>
</section>
