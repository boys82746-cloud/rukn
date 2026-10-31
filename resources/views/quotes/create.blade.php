@extends('Layout.app')

@section('title', __('ui.quote.create_title'))

@section('content')
    <div class="mx-auto max-w-xl px-4 py-10">
        <div class="card p-6 sm:p-8">
            <h1 class="text-3xl font-extrabold">{{ __('ui.quote.create_title') }}</h1>
            <p class="mb-6 mt-2 text-muted">{{ __('ui.quote.create_subtitle') }}</p>

            <x-quote-form :action="route('quotes.store')" :categories="$categories" :submit="__('ui.quote.publish')" />
        </div>
    </div>
@endsection
