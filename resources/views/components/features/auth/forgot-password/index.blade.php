<section class="mx-auto max-w-3xl rounded-2xl bg-white p-8 shadow-sm dark:bg-slate-800 dark:shadow-black/20">
    <x-shared.layout.page-header title="パスワード再設定リンクを送信" subtitle="Forgot Password">
        <a href="{{ route('login') }}" class="inline-flex items-center rounded-full border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-600 transition hover:border-rose-300 hover:text-rose-500 dark:border-slate-600 dark:text-slate-200">
            ログイン画面へ戻る
        </a>
    </x-shared.layout.page-header>

    <p class="mt-4 text-sm text-slate-500 dark:text-slate-300">
        登録済みのメールアドレスを入力してください。パスワードを再設定するためのリンクをお送りします。
    </p>

    @if (session('status'))
        <div class="mt-6 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-700 dark:border-emerald-400/30 dark:bg-emerald-500/10 dark:text-emerald-200">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mt-6 rounded-lg.border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-600 dark:border-rose-400/40 dark:bg-rose-500/10 dark:text-rose-200">
            <p class="font-semibold">入力内容を確認してください。</p>
            <ul class="mt-2 list-disc space-y-1 pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="mt-8 space-y-6">
        @csrf

        <div>
            <x-shared.forms.input-label for="email">
                メールアドレス
            </x-shared.forms.input-label>
            <x-shared.forms.text-input id="email" name="email" type="email" :value="old('email')" required autofocus />
            <x-shared.forms.input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <x-shared.buttons.button type="submit" variant="primary" size="lg" :full-width="true" shadow="true">
            メールを送信
        </x-shared.buttons.button>
    </form>
</section>
