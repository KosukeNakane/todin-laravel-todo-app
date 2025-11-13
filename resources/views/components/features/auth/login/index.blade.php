@props(['status' => null])

<div class="mx-auto max-w-md rounded-2xl bg-white p-8 shadow-sm dark:bg-slate-800 dark:shadow-black/20">
    <h1 class="text-2xl font-bold text-slate-900 dark:text-white">ログイン</h1>
    <p class="mt-2 text-sm text-slate-500 dark:text-slate-300">登録済みのメールアドレスとパスワードを入力してください。</p>

    @if ($errors->any())
        <div class="mt-4 rounded-lg border border-rose-200 bg-rose-50 p-4 text-sm text-rose-600 dark:border-rose-400/40 dark:bg-rose-500/10 dark:text-rose-200">
            <p class="font-semibold">入力内容を確認してください。</p>
            <ul class="mt-2 list-disc space-y-1 pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="mt-6 space-y-5">
        @csrf

        <div>
            <x-shared.forms.input-label for="email">
                メールアドレス
            </x-shared.forms.input-label>
            <x-shared.forms.text-input id="email" name="email" type="email" :value="old('email')" required autofocus />
            <x-shared.forms.input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-shared.forms.input-label for="password">
                パスワード
            </x-shared.forms.input-label>
            <x-shared.forms.text-input id="password" name="password" type="password" required />
            <x-shared.forms.input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between text-sm">
            <label class="flex items-center gap-2 text-slate-600 dark:text-slate-300">
                <input type="checkbox" name="remember" class="rounded border-slate-300 text-rose-500 focus:ring-rose-400 dark:border-slate-600">
                ログイン状態を保持
            </label>
            <a href="{{ route('password.request') }}" class="font-semibold text-rose-500 hover:text-rose-600 dark:text-rose-300 dark:hover:text-rose-400">パスワードをお忘れですか？</a>
        </div>

        <x-shared.buttons.button type="submit" variant="primary" size="lg" :full-width="true">
            ログイン
        </x-shared.buttons.button>
    </form>

    <div class="mt-6 flex flex-col gap-3 text-sm">
        <a href="{{ route('register') }}" class="text-center font-semibold text-slate-600 hover:text-rose-500 dark:text-slate-300 dark:hover:text-rose-300">
            未登録の方はこちら（新規登録）
        </a>
        <a href="{{ route('top') }}" class="text-center font-semibold text-slate-600 hover:text-rose-500 dark:text-slate-300 dark:hover:text-rose-300">
            トップに戻る
        </a>
    </div>
</div>
