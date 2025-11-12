@extends('layouts.app')

@section('title', 'ユーザー設定 | Todin')

@section('content')
    <section class="rounded-2xl bg-white p-8 shadow-sm dark:bg-slate-800 dark:shadow-black/20">
        <p class="text-sm font-semibold uppercase tracking-[0.3em] text-rose-400">Profile</p>
        <h1 class="mt-2 text-3xl font-bold text-slate-900 dark:text-white">ユーザー設定</h1>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-300">アカウント情報の確認・更新ができます。</p>

        @if (session('status'))
            <div class="mt-4 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-700 dark:border-emerald-400/30 dark:bg-emerald-500/10 dark:text-emerald-200">
                {{ session('status') === 'password-updated' ? 'パスワードを更新しました。' : session('status') }}
            </div>
        @endif

        <dl class="mt-6 grid gap-4 rounded-2xl border border-slate-100 bg-slate-50 p-6 sm:grid-cols-2 dark:border-slate-700 dark:bg-slate-900/40">
            <div>
                <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-300">お名前</dt>
                <dd class="mt-1 text-lg font-semibold text-slate-900 dark:text-white">{{ $user->name }}</dd>
            </div>
            <div>
                <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-300">メールアドレス</dt>
                <dd class="mt-1 text-lg font-semibold text-slate-900 dark:text-white">{{ $user->email }}</dd>
            </div>
        </dl>

        @if ($errors->any())
            <div class="mt-6 rounded-lg border border-rose-200 bg-rose-50 p-4 text-sm text-rose-600 dark:border-rose-400/40 dark:bg-rose-500/10 dark:text-rose-200">
                <p class="font-semibold">入力内容を確認してください。</p>
                <ul class="mt-2 list-disc space-y-1 pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('user.update') }}" class="mt-8 space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="text-sm font-semibold text-slate-700 dark:text-slate-200">お名前</label>
                <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-rose-400 focus:outline-none dark:border-slate-600 dark:bg-slate-900 dark:text-slate-100">
            </div>

            <div>
                <label for="email" class="text-sm font-semibold text-slate-700 dark:text-slate-200">メールアドレス</label>
                <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-rose-400 focus:outline-none dark:border-slate-600 dark:bg-slate-900 dark:text-slate-100">
            </div>

            <div class="text-right">
                <button type="submit" class="rounded-full bg-slate-900 px-6 py-3 font-semibold text-white dark:bg-slate-100 dark:text-slate-900">更新する</button>
            </div>
        </form>

        <div class="mt-12 border-t border-slate-100 pt-10 dark:border-slate-700">
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-rose-400">Security</p>
            <h2 class="mt-2 text-2xl font-bold text-slate-900 dark:text-white">パスワード変更</h2>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-300">現在のパスワードと新しいパスワードを入力してください。（英数字を含む8文字以上）</p>

            @if ($errors->updatePassword->any())
                <div class="mt-6 rounded-lg border border-rose-200 bg-rose-50 p-4 text-sm text-rose-600 dark:border-rose-400/40 dark:bg-rose-500/10 dark:text-rose-200">
                    <p class="font-semibold">パスワードの更新に失敗しました。</p>
                    <ul class="mt-2 list-disc space-y-1 pl-5">
                        @foreach ($errors->updatePassword->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}" class="mt-8 space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="current_password" class="text-sm font-semibold text-slate-700 dark:text-slate-200">現在のパスワード</label>
                    <input id="current_password" name="current_password" type="password" required autocomplete="current-password" class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-rose-400 focus:outline-none dark:border-slate-600 dark:bg-slate-900 dark:text-slate-100">
                    @error('current_password', 'updatePassword')
                        <p class="mt-1 text-sm text-rose-500 dark:text-rose-300">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="text-sm font-semibold text-slate-700 dark:text-slate-200">新しいパスワード</label>
                    <input id="password" name="password" type="password" required autocomplete="new-password" class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-rose-400 focus:outline-none dark:border-slate-600 dark:bg-slate-900 dark:text-slate-100">
                    @error('password', 'updatePassword')
                        <p class="mt-1 text-sm text-rose-500 dark:text-rose-300">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="text-sm font-semibold text-slate-700 dark:text-slate-200">新しいパスワード（確認）</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password" class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-rose-400 focus:outline-none dark:border-slate-600 dark:bg-slate-900 dark:text-slate-100">
                </div>

                <div class="text-right">
                    <button type="submit" class="rounded-full bg-rose-500 px-6 py-3 font-semibold text-white shadow hover:bg-rose-600">パスワードを更新</button>
                </div>
            </form>
        </div>
    </section>
@endsection
