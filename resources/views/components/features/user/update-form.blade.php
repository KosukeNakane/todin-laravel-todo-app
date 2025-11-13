@props(['user'])

<x-shared.alerts.error-list />

<form method="POST" action="{{ route('user.update') }}" class="mt-8 space-y-6">
    @csrf
    @method('PUT')

    <div>
        <x-shared.forms.input-label for="name">
            お名前
        </x-shared.forms.input-label>
        <x-shared.forms.text-input id="name" name="name" type="text" :value="old('name', $user->name)" required />
        <x-shared.forms.input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <div>
        <x-shared.forms.input-label for="email">
            メールアドレス
        </x-shared.forms.input-label>
        <x-shared.forms.text-input id="email" name="email" type="email" :value="old('email', $user->email)" required />
        <x-shared.forms.input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <div class="text-right">
        <x-shared.buttons.button type="submit" variant="secondary" size="lg">
            更新する
        </x-shared.buttons.button>
    </div>
</form>
