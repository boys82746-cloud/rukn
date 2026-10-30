<header class="sticky top-0 z-40 border-b border-line bg-white/90 backdrop-blur">
    <nav class="mx-auto flex max-w-6xl items-center gap-3 px-4 py-3">
        <a href="{{ route('home') }}" class="flex items-center gap-2">
            <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-brand text-lg font-extrabold text-gold-light">
                {{ mb_substr(__('ui.app_name'), 0, 1) }}
            </span>
            <span class="text-xl font-extrabold text-brand">{{ __('ui.app_name') }}</span>
        </a>

        <div class="ms-auto flex items-center gap-2 sm:gap-3">
            {{-- Language switcher: shows the language you can switch TO --}}
            <a href="{{ route('lang', app()->getLocale() === 'ar' ? 'en' : 'ar') }}"
                class="rounded-lg px-2 py-1 text-sm font-bold text-muted hover:text-brand">
                {{ __('ui.nav.lang') }}
            </a>

            <a href="{{ route('listings.create') }}" class="btn btn-gold px-4 py-2 text-sm">
                + {{ __('ui.nav.post_ad') }}
            </a>

            @auth
                <span class="hidden text-sm font-bold sm:inline">{{ auth()->user()->name }}</span>

                {{-- Logout is a POST request (safer than a plain link) --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-ghost px-4 py-2 text-sm">{{ __('ui.nav.logout') }}</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-ghost px-4 py-2 text-sm">{{ __('ui.nav.login') }}</a>
                <a href="{{ route('signup') }}" class="btn btn-primary hidden px-4 py-2 text-sm sm:inline-flex">{{ __('ui.nav.signup') }}</a>
            @endauth
        </div>
    </nav>
</header>
