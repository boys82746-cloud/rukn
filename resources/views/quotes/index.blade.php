@extends('Layout.app')

@section('content')
    <section class="hero-bg px-4 py-12 text-white">
        <div class="mx-auto max-w-3xl text-center">
            <h1 class="text-4xl font-extrabold md:text-5xl">{{ __('ui.hero.title') }}</h1>
            <p class="mt-3 text-lg opacity-90">{{ __('ui.hero.subtitle') }}</p>

            <form method="GET" action="{{ route('home') }}" class="mt-7 flex flex-col gap-3 sm:flex-row">
                <input type="search" name="q" value="{{ request('q') }}" class="input flex-1 text-ink"
                    placeholder="{{ __('ui.hero.search_placeholder') }}" aria-label="{{ __('ui.hero.search') }}">
                <button type="submit" class="btn btn-gold px-6">{{ __('ui.hero.search') }}</button>
                @if (request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
            </form>
        </div>
    </section>

    <div class="mx-auto max-w-6xl px-4 py-8">
        {{-- Category chips (the new feature) --}}
        <div class="mb-6 flex flex-wrap gap-2">
            <a href="{{ route('home', array_filter(['q' => request('q')])) }}"
                class="chip {{ request('category') ? '' : 'chip-active' }}">{{ __('ui.hero.all_categories') }}</a>
            @foreach ($categories as $category)
                <a href="{{ route('home', array_filter(['q' => request('q'), 'category' => $category->slug])) }}"
                    class="chip {{ request('category') === $category->slug ? 'chip-active' : '' }}">
                    {{ $category->icon }} {{ __('categories.'.$category->slug) }}
                </a>
            @endforeach
        </div>

        <div class="mb-5 flex flex-wrap items-center justify-between gap-3">
            <p class="font-bold text-muted">{{ __('ui.filters.results', ['count' => $quotes->total()]) }}</p>

            <form method="GET" action="{{ route('home') }}" class="flex items-center gap-2">
                <input type="hidden" name="q" value="{{ request('q') }}">
                <input type="hidden" name="category" value="{{ request('category') }}">
                <label for="sort" class="text-sm font-bold text-muted">{{ __('ui.filters.sort') }}</label>
                <select id="sort" name="sort" class="input w-auto py-2" onchange="this.form.submit()">
                    <option value="newest" @selected(request('sort', 'newest') === 'newest')>{{ __('ui.filters.newest') }}</option>
                    <option value="oldest" @selected(request('sort') === 'oldest')>{{ __('ui.filters.oldest') }}</option>
                </select>
                @if (request()->hasAny(['q', 'category', 'sort']))
                    <a href="{{ route('home') }}" class="text-sm font-bold text-brand hover:underline">{{ __('ui.filters.reset') }}</a>
                @endif
            </form>
        </div>

        @if ($quotes->isEmpty())
            <div class="card p-10 text-center">
                <h2 class="text-xl font-extrabold">{{ __('ui.filters.empty_title') }}</h2>
                <p class="mt-2 text-muted">{{ __('ui.filters.empty_text') }}</p>
            </div>
        @else
            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($quotes as $quote)
                    <x-quote-card :quote="$quote" />
                @endforeach
            </div>

            <div class="mt-8">{{ $quotes->links('pagination.market') }}</div>
        @endif
    </div>
@endsection
