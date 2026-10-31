@props(['action', 'categories', 'quote' => null, 'method' => 'POST', 'submit'])

<form method="POST" action="{{ $action }}">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <x-form-field name="text" textarea rows="4" counter :label="__('ui.quote.text')" :hint="__('ui.hints.text')"
        :value="$quote?->text" required minlength="3" maxlength="155" />

    <x-select-field name="category_id" :label="__('ui.quote.category')" :hint="__('ui.hints.category')" required>
        <option value="">{{ __('ui.choose') }}</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" @selected((int) old('category_id', $quote?->category_id) === $category->id)>
                {{ $category->icon }} {{ __('categories.'.$category->slug) }}
            </option>
        @endforeach
    </x-select-field>

    <div class="mt-2 flex gap-3">
        <button type="submit" class="btn btn-primary">{{ $submit }}</button>
        <a href="{{ url()->previous() }}" class="btn btn-ghost">{{ __('ui.quote.cancel') }}</a>
    </div>
</form>
