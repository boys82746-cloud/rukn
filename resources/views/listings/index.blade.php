@extends('Layout.app')

@section('title', __('ui.nav.home'))

@section('content')
    @php
        $activeCategory = (string) request('category', '');
        $hasFilters = request()->filled('q') || request()->filled('category') || request()->filled('city')
            || request()->filled('min') || request()->filled('max');
    @endphp

    {{-- One GET form: the search box and the filter bar send the same query string --}}
    <form method="GET" action="{{ route('home') }}">

        {{-- Hero + search --}}
        <section class="hero-bg text-white">
            <div class="mx-auto max-w-6xl px-4 py-12 sm:py-16">
                <h1 class="text-3xl font-extrabold sm:text-5xl">{{ __('ui.hero.title') }}</h1>
                <p class="mt-3 max-w-2xl text-lg text-white/80">{{ __('ui.hero.subtitle') }}</p>

                <div class="mt-8 grid gap-3 rounded-2xl bg-white p-3 shadow-xl sm:grid-cols-[1fr_auto_auto_auto]">
                    <input type="search" name="q" value="{{ request('q') }}" maxlength="60"
                        class="input" placeholder="{{ __('ui.hero.search_placeholder') }}"
                        aria-label="{{ __('ui.hero.search') }}">

                    <select name="category" class="input sm:w-48" aria-label="{{ __('ui.listing.category') }}">
                        <option value="">{{ __('ui.hero.all_categories') }}</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->slug }}" @selected($activeCategory === $category->slug)>
                                {{ $category->icon }} {{ __('categories.'.$category->slug) }}
                            </option>
                        @endforeach
                    </select>

                    <select name="city" class="input sm:w-44" aria-label="{{ __('ui.listing.city') }}">
                        <option value="">{{ __('ui.hero.all_cities') }}</option>
                        @foreach (config('marketplace.cities') as $city)
                            <option value="{{ $city }}" @selected(request('city') === $city)>{{ __('cities.'.$city) }}</option>
                        @endforeach
                    </select>

                    <button type="submit" class="btn btn-gold">{{ __('ui.hero.search') }}</button>
                </div>

                {{-- Quick category chips --}}
                <div class="mt-5 flex flex-wrap gap-2">
                    <a href="{{ route('home') }}" class="chip {{ $activeCategory === '' ? 'chip-active' : '' }}">
                        {{ __('ui.hero.all_categories') }}
                    </a>
                    @foreach ($categories as $category)
                        <a href="{{ route('home', ['category' => $category->slug]) }}"
                            class="chip {{ $activeCategory === $category->slug ? 'chip-active' : '' }}">
                            <span>{{ $category->icon }}</span> {{ __('categories.'.$category->slug) }}
                        </a>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Price + sort filter bar --}}
        <section class="mx-auto max-w-6xl px-4 pt-6">
            <div class="card flex flex-wrap items-end gap-3 p-4">
                <div class="w-32">
                    <label for="min" class="label">{{ __('ui.filters.min_price') }}</label>
                    <input id="min" type="number" name="min" min="0" value="{{ request('min') }}" class="input">
                </div>

                <div class="w-32">
                    <label for="max" class="label">{{ __('ui.filters.max_price') }}</label>
                    <input id="max" type="number" name="max" min="0" value="{{ request('max') }}" class="input">
                </div>

                <div class="w-48">
                    <label for="sort" class="label">{{ __('ui.filters.sort') }}</label>
                    <select id="sort" name="sort" class="input" onchange="this.form.submit()">
                        @foreach (['newest', 'price_asc', 'price_desc'] as $option)
                            <option value="{{ $option }}" @selected(request('sort', 'newest') === $option)>
                                {{ __('ui.filters.'.$option) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">{{ __('ui.filters.apply') }}</button>

                @if ($hasFilters)
                    <a href="{{ route('home') }}" class="btn btn-ghost">{{ __('ui.filters.reset') }}</a>
                @endif

                <p class="ms-auto text-sm font-bold text-muted">
                    {{ __('ui.filters.results', ['count' => $listings->total()]) }}
                </p>
            </div>
        </section>
    </form>

    {{-- Results --}}
    <section class="mx-auto max-w-6xl px-4 py-8">
        @if ($listings->isEmpty())
            <div class="card py-16 text-center">
                <div class="text-5xl">🔍</div>
                <h2 class="mt-4 text-xl font-extrabold">{{ __('ui.filters.empty_title') }}</h2>
                <p class="mx-auto mt-2 max-w-md text-muted">{{ __('ui.filters.empty_text') }}</p>
                <a href="{{ route('listings.create') }}" class="btn btn-gold mt-6">+ {{ __('ui.nav.post_ad') }}</a>
            </div>
        @else
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($listings as $listing)
                    <x-listing-card :listing="$listing" />
                @endforeach
            </div>

            <div class="mt-8">
                {{ $listings->links('pagination.market') }}
            </div>
        @endif
    </section>
@endsection
