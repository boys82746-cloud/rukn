@extends('Layout.app')

@section('title', __('ui.listing.edit_title'))

@section('content')
    <div class="mx-auto max-w-2xl px-4 py-8">
        <h1 class="mb-6 text-3xl font-extrabold">{{ __('ui.listing.edit_title') }}</h1>

        <x-listing-form :listing="$listing" :categories="$categories"
            :action="route('listings.update', $listing)" method="PUT" />
    </div>
@endsection
