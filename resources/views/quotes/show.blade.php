@extends('Layout.app')

@section('title', \Illuminate\Support\Str::limit($quote->text, 40))

@section('content')
    <div class="mx-auto max-w-3xl px-4 py-8">
        <a href="{{ route('home') }}" class="text-sm font-bold text-brand hover:underline">← {{ __('ui.back') }}</a>

        <article class="card mt-4 p-8">
            <span class="chip">{{ $quote->category->icon }} {{ __('categories.'.$quote->category->slug) }}</span>

            <p class="mt-6 text-2xl font-extrabold leading-loose">&ldquo;{{ $quote->text }}&rdquo;</p>

            <dl class="mt-8 grid grid-cols-2 gap-4 border-t border-line pt-5 text-sm">
                <div>
                    <dt class="text-muted">{{ __('ui.quote.publisher') }}</dt>
                    <dd class="font-bold text-brand">{{ $quote->user->name }}</dd>
                </div>
                <div>
                    <dt class="text-muted">{{ __('ui.quote.posted') }}</dt>
                    <dd class="font-bold">{{ $quote->created_at->format('Y-m-d') }}</dd>
                </div>
            </dl>

            {{-- Buttons are only a convenience; the server re-checks with the Policy --}}
            @can('update', $quote)
                <div class="mt-6 flex flex-wrap items-center gap-3 border-t border-line pt-5">
                    <span class="chip chip-active">{{ __('ui.quote.mine') }}</span>
                    <a href="{{ route('quotes.edit', $quote) }}" class="btn btn-ghost">{{ __('ui.quote.edit') }}</a>
                    <form method="POST" action="{{ route('quotes.destroy', $quote) }}"
                        onsubmit="return confirm('{{ __('ui.quote.delete_confirm') }}')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">{{ __('ui.quote.delete') }}</button>
                    </form>
                </div>
            @endcan
        </article>

        @if ($related->isNotEmpty())
            <h2 class="mb-4 mt-10 text-xl font-extrabold">{{ __('ui.quote.related') }}</h2>
            <div class="grid gap-5 sm:grid-cols-2">
                @foreach ($related as $item)
                    <x-quote-card :quote="$item" />
                @endforeach
            </div>
        @endif
    </div>
@endsection
