    <div class="mx-auto max-w-lg rounded-2xl bg-white p-8 shadow-sm dark:bg-slate-800 dark:shadow-black/20">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">アカウント登録</h1>
        <p class="mt-2 text-sm text-slate-500 dark:text-slate-300">必要事項を入力し、Todinをはじめましょう。</p>

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

        <form method="POST" action="{{ route('register') }}" class="mt-6 space-y-6">
            @csrf

            <div>
                <x-shared.forms.input-label for="name">
                    お名前
                </x-shared.forms.input-label>
                <x-shared.forms.text-input id="name" name="name" type="text" :value="old('name')" required autofocus autocomplete="name" />
                <x-shared.forms.input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <x-shared.forms.input-label for="email">
                    メールアドレス
                </x-shared.forms.input-label>
                <x-shared.forms.text-input id="email" name="email" type="email" :value="old('email')" required autocomplete="username" />
                <x-shared.forms.input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <x-shared.forms.input-label for="password">
                    パスワード
                </x-shared.forms.input-label>
                <x-shared.forms.text-input id="password" name="password" type="password" required autocomplete="new-password" />
                <x-shared.forms.input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <x-shared.forms.input-label for="password_confirmation">
                    パスワード（確認用）
                </x-shared.forms.input-label>
                <x-shared.forms.text-input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password" />
            </div>

            <x-shared.buttons.button type="submit" variant="primary" size="lg" :full-width="true">
                登録する
            </x-shared.buttons.button>
        </form>

        <div class="mt-6 flex flex-col gap-3 text-sm">
            <a href="{{ route('login') }}" class="text-center font-semibold text-slate-600 hover:text-rose-500 dark:text-slate-300 dark:hover:text-rose-300">すでにアカウントをお持ちの方はこちら（ログイン）</a>
            <a href="{{ route('top') }}" class="text-center font-semibold text-slate-600 hover:text-rose-500 dark:text-slate-300 dark:hover:text-rose-300">トップに戻る</a>
        </div>
    </div>
