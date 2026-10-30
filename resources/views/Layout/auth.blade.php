{{-- Two-column layout for log in / sign up. Child pages fill the "form" section. --}}
@extends('Layout.app')

@section('content')
    <div class="mx-auto grid max-w-5xl gap-8 px-4 py-10 md:grid-cols-2 md:py-16">
        <div class="card p-6 sm:p-8">
            @yield('form')
        </div>

        <aside class="hero-bg hidden rounded-3xl p-10 text-white md:flex md:flex-col md:justify-center">
            <h2 class="text-3xl font-extrabold">{{ __('ui.auth.perks_title') }}</h2>
            <ul class="mt-6 space-y-4 text-lg">
                @foreach (['perk1', 'perk2', 'perk3'] as $perk)
                    <li class="flex items-start gap-3">
                        <span class="mt-1 flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-gold text-sm font-bold text-ink">✓</span>
                        <span>{{ __('ui.auth.'.$perk) }}</span>
                    </li>
                @endforeach
            </ul>
        </aside>
    </div>
@endsection
