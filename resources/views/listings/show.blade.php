@extends('Layout.app')

@section('title', $listing->title)

@section('content')
    @php
        $isOwner = auth()->check() && (int) auth()->id() === (int) $listing->user_id;
        $arrow = app()->getLocale() === 'ar' ? '→' : '←';
    @endphp

    <div class="mx-auto max-w-4xl px-4 py-8">
        <a href="{{ route('home') }}" class="text-sm font-bold text-brand hover:underline">{{ $arrow }} {{ __('ui.back') }}</a>

        <article class="card mt-4 overflow-hidden">
            <div class="flex h-44 items-center justify-center bg-brand-light text-7xl">{{ $listing->category->icon }}</div>

            <div class="grid gap-8 p-6 sm:p-8 md:grid-cols-[1fr_16rem]">
                <div>
                    <div class="flex flex-wrap gap-2">
                        <span class="chip">{{ $listing->category->icon }} {{ __('categories.'.$listing->category->slug) }}</span>
                        <span class="chip">📍 {{ __('cities.'.$listing->city) }}</span>
                    </div>

                    <h1 class="mt-4 text-3xl font-extrabold">{{ $listing->title }}</h1>
                    <x-price :value="$listing->price" class="mt-2 block text-2xl font-extrabold text-brand" />

                    <p class="mt-6 whitespace-pre-line text-lg leading-8">{{ $listing->description }}</p>
                </div>

                <aside class="space-y-4">
                    {{-- Seller --}}
                    <div class="rounded-xl border border-line bg-cream p-4">
                        <p class="text-xs font-bold text-muted">{{ __('ui.listing.seller') }}</p>
                        <div class="mt-2 flex items-center gap-3">
                            <span class="flex h-11 w-11 items-center justify-center rounded-full bg-brand text-lg font-extrabold text-gold-light">
                                {{ mb_substr($listing->user->name, 0, 1) }}
                            </span>
                            <div>
                                <p class="font-extrabold">{{ $listing->user->name }}</p>
                                <p class="text-xs text-muted">
                                    {{ __('ui.listing.member_since') }} {{ $listing->user->created_at->format('Y') }}
                                </p>
                            </div>
                        </div>
                        <p class="mt-3 text-xs text-muted">
                            {{ __('ui.listing.posted') }}: {{ $listing->created_at->format('Y-m-d') }}
                            · {{ $listing->created_at->diffForHumans() }}
                        </p>
                    </div>

                    {{-- Owner actions: the server checks ownership again (ListingPolicy) --}}
                    @if ($isOwner)
                        <div class="flex flex-col gap-2">
                            <a href="{{ route('listings.edit', $listing) }}" class="btn btn-primary">{{ __('ui.listing.edit') }}</a>

                            <form method="POST" action="{{ route('listings.destroy', $listing) }}"
                                onsubmit="return confirm(@js(__('ui.listing.delete_confirm')))">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger w-full">{{ __('ui.listing.delete') }}</button>
                            </form>
                        </div>
                    @endif
                </aside>
            </div>
        </article>

        @if ($related->isNotEmpty())
            <section class="mt-10">
                <h2 class="mb-4 text-2xl font-extrabold">{{ __('ui.listing.related') }}</h2>
                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($related as $item)
                        <x-listing-card :listing="$item" />
                    @endforeach
                </div>
            </section>
        @endif
    </div>
@endsection
