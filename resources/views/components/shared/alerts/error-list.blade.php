@props(['bag' => null, 'title' => '入力内容を確認してください。'])

@php
    $errorBag = $bag ? $errors->getBag($bag) : $errors;
@endphp

@if ($errorBag->any())
    <div class="mt-6 rounded-lg border border-rose-200 bg-rose-50 p-4 text-sm text-rose-600 dark:border-rose-400/40 dark:bg-rose-500/10 dark:text-rose-200">
        <p class="font-semibold">{{ $title }}</p>
        <ul class="mt-2 list-disc space-y-1 pl-5">
            @foreach ($errorBag->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
