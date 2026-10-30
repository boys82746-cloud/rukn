{{-- Shared by "create" and "edit". Pass :listing to pre-fill it. --}}
@props([
    'categories',
    'action',
    'method' => 'POST',
    'listing' => null,
])

<form method="POST" action="{{ $action }}" class="card p-6 sm:p-8">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <x-form-field name="title" :label="__('ui.listing.title')" :value="$listing?->title"
        :hint="__('ui.hints.title')" required minlength="3" maxlength="60" />

    <div class="grid gap-x-4 sm:grid-cols-2">
        <x-select-field name="category_id" :label="__('ui.listing.category')" :hint="__('ui.hints.category')" required>
            <option value="">{{ __('ui.choose') }}</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected((string) old('category_id', $listing?->category_id) === (string) $category->id)>
                    {{ $category->icon }} {{ __('categories.'.$category->slug) }}
                </option>
            @endforeach
        </x-select-field>

        <x-select-field name="city" :label="__('ui.listing.city')" :hint="__('ui.hints.city')" required>
            <option value="">{{ __('ui.choose') }}</option>
            @foreach (config('marketplace.cities') as $city)
                <option value="{{ $city }}" @selected(old('city', $listing?->city) === $city)>
                    {{ __('cities.'.$city) }}
                </option>
            @endforeach
        </x-select-field>
    </div>

    <x-form-field name="price" type="number" :label="__('ui.listing.price')" :value="$listing?->price"
        :hint="__('ui.hints.price')" required min="0" max="10000000" step="1" inputmode="numeric" />

    <x-form-field name="description" :textarea="true" :rows="5" :counter="true"
        :label="__('ui.listing.description')" :value="$listing?->description"
        :hint="__('ui.hints.description')" required minlength="3" maxlength="155" />

    <div class="mt-2 flex flex-wrap gap-3">
        <button type="submit" class="btn btn-primary">
            {{ $listing ? __('ui.listing.save') : __('ui.listing.publish') }}
        </button>
        <a href="{{ $listing ? route('listings.show', $listing) : route('home') }}" class="btn btn-ghost">
            {{ __('ui.listing.cancel') }}
        </a>
    </div>
</form>
