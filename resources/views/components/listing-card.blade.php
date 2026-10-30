@props(['listing'])

@php
    $isMine = auth()->check() && (int) auth()->id() === (int) $listing->user_id;
@endphp

<a href="{{ route('listings.show', $listing) }}"
    class="card group flex flex-col overflow-hidden transition hover:-translate-y-0.5 hover:shadow-md">

    <div class="relative flex h-28 items-center justify-center bg-brand-light text-5xl">
        {{ $listing->category->icon }}

        @if ($isMine)
            <span class="absolute end-3 top-3 rounded-full bg-gold px-2.5 py-0.5 text-xs font-bold text-ink">
                {{ __('ui.listing.mine') }}
            </span>
        @endif
    </div>

    <div class="flex flex-1 flex-col p-4">
        <span class="text-xs font-bold text-brand">{{ __('categories.'.$listing->category->slug) }}</span>

        <h3 class="mt-1 line-clamp-1 text-lg font-extrabold">{{ $listing->title }}</h3>
        <p class="mt-1 line-clamp-2 text-sm leading-6 text-muted">{{ $listing->description }}</p>

        <div class="mt-auto flex items-center justify-between gap-2 pt-4">
            <x-price :value="$listing->price" class="text-lg font-extrabold text-brand" />
            <span class="text-xs text-muted">📍 {{ __('cities.'.$listing->city) }}</span>
        </div>

        <div class="mt-2 text-xs text-muted">
            {{ $listing->user->name }} · {{ $listing->created_at->diffForHumans() }}
        </div>
    </div>
</a>
