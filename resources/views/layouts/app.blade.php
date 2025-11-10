<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name', 'Laravel'))</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <script>
            (() => {
                const prefersDark = window.matchMedia
                    ? window.matchMedia('(prefers-color-scheme: dark)').matches
                    : false;
                document.documentElement.classList.toggle('dark', prefersDark);
                document.documentElement.dataset.theme = prefersDark ? 'dark' : 'light';
            })();
        </script>
        <script>
            (() => {
                const key = 'todin:scroll-position';
                if ('scrollRestoration' in history) {
                    history.scrollRestoration = 'manual';
                }
                const saved = sessionStorage.getItem(key);
                if (saved !== null) {
                    window.__todinScrollRestore = Number(saved);
                }
                window.addEventListener('beforeunload', () => {
                    sessionStorage.setItem(key, String(window.scrollY));
                });
                const applyRestore = () => {
                    if (window.__todinScrollRestore !== undefined) {
                        window.scrollTo(0, window.__todinScrollRestore);
                        sessionStorage.removeItem(key);
                        delete window.__todinScrollRestore;
                    }
                };
                if (window.__todinScrollRestore !== undefined) {
                    requestAnimationFrame(applyRestore);
                }
                document.addEventListener('DOMContentLoaded', applyRestore, { once: true });
            })();
        </script>
    </head>
    <body class="font-sans antialiased bg-slate-50 text-slate-900 dark:bg-slate-900 dark:text-slate-50">
        <div class="min-h-screen">
            <header class="bg-white shadow-sm dark:bg-slate-900/70 dark:shadow-black/20">
                <div class="max-w-7xl mx-auto flex items-center justify-between px-4 py-4">
                    <a href="{{ auth()->check() ? route('todos.index') : route('top') }}" class="text-2xl font-bold tracking-wide text-rose-500 dark:text-rose-400">
                        Todin
                    </a>
                    <nav class="flex items-center gap-4 text-sm">
                        @auth
                            <a href="{{ route('todos.index') }}" class="font-semibold text-slate-600 hover:text-rose-500 dark:text-slate-200 dark:hover:text-rose-400 {{ request()->is('index') ? 'text-rose-500 dark:text-rose-400' : '' }}">一覧</a>
                            <a href="{{ route('user.index') }}" class="font-semibold text-slate-600 hover:text-rose-500 dark:text-slate-200 dark:hover:text-rose-400 {{ request()->is('user') ? 'text-rose-500 dark:text-rose-400' : '' }}">ユーザー設定</a>
                            <form method="POST" action="{{ route('logout') }}" class="inline-flex">
                                @csrf
                                <button type="submit" class="font-semibold text-slate-600 hover:text-rose-500 dark:text-slate-200 dark:hover:text-rose-400">ログアウト</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="font-semibold text-slate-600 hover:text-rose-500 dark:text-slate-200 dark:hover:text-rose-400">ログイン</a>
                            <a href="{{ route('register') }}" class="font-semibold text-slate-600 hover:text-rose-500 dark:text-slate-200 dark:hover:text-rose-400">新規登録</a>
                        @endauth
                    </nav>
                </div>
            </header>

            @if (isset($header))
                <header class="bg-white shadow mt-4 dark:bg-slate-900/70 dark:shadow-black/20">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <main class="py-10 px-4">
                <div class="max-w-7xl mx-auto space-y-6">
                    @hasSection('content')
                        @yield('content')
                    @else
                        {{ $slot ?? '' }}
                    @endif
                </div>
            </main>
        </div>
    </body>
</html>
