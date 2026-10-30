@extends('Layout.app')

@section('title', __('ui.listing.create_title'))

@section('content')
    <div class="mx-auto max-w-2xl px-4 py-8">
        <h1 class="text-3xl font-extrabold">{{ __('ui.listing.create_title') }}</h1>
        <p class="mb-6 mt-1 text-muted">{{ __('ui.listing.create_subtitle') }}</p>

        <x-listing-form :categories="$categories" :action="route('listings.store')" />
    </div>
@endsection
