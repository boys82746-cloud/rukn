@extends('Layout.app')

@section('title', __('ui.quote.edit_title'))

@section('content')
    <div class="mx-auto max-w-xl px-4 py-10">
        <div class="card p-6 sm:p-8">
            <h1 class="mb-6 text-3xl font-extrabold">{{ __('ui.quote.edit_title') }}</h1>

            <x-quote-form :action="route('quotes.update', $quote)" method="PUT" :quote="$quote"
                :categories="$categories" :submit="__('ui.quote.save')" />
        </div>
    </div>
@endsection
