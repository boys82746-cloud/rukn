@if (session('status'))
    <div class="mx-auto mt-4 max-w-6xl px-4">
        <div class="rounded-xl border border-brand/20 bg-brand-light px-4 py-3 text-sm font-bold text-brand-dark" role="status">
            {{ session('status') }}
        </div>
    </div>
@endif
