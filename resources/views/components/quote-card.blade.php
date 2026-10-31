@props(['quote'])

<article class="card flex h-full flex-col p-5 transition hover:-translate-y-0.5 hover:shadow-md">
    <span class="chip self-start">{{ $quote->category->icon }} {{ __('categories.'.$quote->category->slug) }}</span>

    <a href="{{ route('quotes.show', $quote) }}" class="mt-4 flex-1">
        <p class="text-lg font-bold leading-relaxed text-ink">&ldquo;{{ $quote->text }}&rdquo;</p>
    </a>

    <div class="mt-4 flex items-center justify-between border-t border-line pt-3 text-sm text-muted">
        <span class="font-bold text-brand">{{ $quote->user->name }}</span>
        <time datetime="{{ $quote->created_at->toDateString() }}">{{ $quote->created_at->format('Y-m-d') }}</time>
    </div>
</article>
