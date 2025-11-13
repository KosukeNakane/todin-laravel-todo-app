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

        <form method="POST" action="{{ route('password.store') }}" class="mt-8 space-y-6">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div>
                <x-shared.forms.input-label for="email">
                    メールアドレス
                </x-shared.forms.input-label>
                <x-shared.forms.text-input id="email" name="email" type="email" :value="$email" required />
                <x-shared.forms.input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <x-shared.forms.input-label for="password">
                    新しいパスワード
                </x-shared.forms.input-label>
                <x-shared.forms.text-input id="password" name="password" type="password" required autocomplete="new-password" />
                <x-shared.forms.input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <x-shared.forms.input-label for="password_confirmation">
                    新しいパスワード（確認）
                </x-shared.forms.input-label>
                <x-shared.forms.text-input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password" />
            </div>

            <x-shared.buttons.button type="submit" variant="primary" size="lg" :full-width="true" shadow="true">
                パスワードを更新
            </x-shared.buttons.button>
        </form>
    </section>
