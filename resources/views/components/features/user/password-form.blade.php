<x-shared.alerts.error-list bag="updatePassword" title="パスワードの更新に失敗しました。" />

<form method="POST" action="{{ route('password.update') }}" class="mt-8 space-y-6">
    @csrf
    @method('PUT')

    <div>
        <x-shared.forms.input-label for="current_password">
            現在のパスワード
        </x-shared.forms.input-label>
        <x-shared.forms.text-input id="current_password" name="current_password" type="password" required autocomplete="current-password" />
        <x-shared.forms.input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
    </div>

    <div>
        <x-shared.forms.input-label for="password">
            新しいパスワード
        </x-shared.forms.input-label>
        <x-shared.forms.text-input id="password" name="password" type="password" required autocomplete="new-password" />
        <x-shared.forms.input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
    </div>

    <div>
        <x-shared.forms.input-label for="password_confirmation">
            新しいパスワード（確認）
        </x-shared.forms.input-label>
        <x-shared.forms.text-input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password" />
    </div>

    <div class="text-right">
        <x-shared.buttons.button type="submit" variant="primary" size="lg" shadow="true">
            パスワードを更新
        </x-shared.buttons.button>
    </div>
</form>
