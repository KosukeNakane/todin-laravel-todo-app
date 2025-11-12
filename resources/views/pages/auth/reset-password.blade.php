@extends('layouts.app')

@section('title', 'パスワード再設定 | Todin')

@section('content')
    @php
        $email = old('email', $request->email);
    @endphp

    <section class="mx-auto max-w-3xl rounded-2xl bg-white p-8 shadow-sm dark:bg-slate-800 dark:shadow-black/20">
        <x-shared.layout.page-header title="新しいパスワードを設定" subtitle="Reset Password">
            <a href="{{ route('login') }}" class="inline-flex items-center rounded-full border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-600 transition hover:border-rose-300 hover:text-rose-500 dark:border-slate-600 dark:text-slate-200">
                ログイン画面へ戻る
            </a>
        </x-shared.layout.page-header>

        <p class="mt-4 text-sm text-slate-500 dark:text-slate-300">
            新しいパスワードを入力してください。安全のため、英数字を含む 8 文字以上のパスワードを設定してください。
        </p>

        @if ($errors->any())
            <div class="mt-6 rounded-lg border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-600 dark:border-rose-400/40 dark:bg-rose-500/10 dark:text-rose-200">
                <p class="font-semibold">入力内容を確認してください。</p>
                <ul class="mt-2 list-disc space-y-1 pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.store') }}" class="mt-8 space-y-6">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div>
                <label for="email" class="text-sm font-semibold text-slate-700 dark:text-slate-200">メールアドレス</label>
                <input id="email" name="email" type="email" value="{{ $email }}" required class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-rose-400 focus:outline-none focus:ring-2 focus:ring-rose-100 dark:border-slate-600 dark:bg-slate-900 dark:text-slate-100 dark:focus:ring-rose-400">
            </div>

            <div>
                <label for="password" class="text-sm font-semibold text-slate-700 dark:text-slate-200">新しいパスワード</label>
                <input id="password" name="password" type="password" required autocomplete="new-password" class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-rose-400 focus:outline-none focus:ring-2 focus:ring-rose-100 dark:border-slate-600 dark:bg-slate-900 dark:text-slate-100 dark:focus:ring-rose-400">
            </div>

            <div>
                <label for="password_confirmation" class="text-sm font-semibold text-slate-700 dark:text-slate-200">新しいパスワード（確認）</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password" class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-rose-400 focus:outline-none focus:ring-2 focus:ring-rose-100 dark:border-slate-600 dark:bg-slate-900 dark:text-slate-100 dark:focus:ring-rose-400">
            </div>

            <button type="submit" class="w-full rounded-xl bg-rose-500 px-4 py-3 font-semibold text-white shadow hover:bg-rose-600">
                パスワードを更新
            </button>
        </form>
    </section>
@endsection
