@props([
    'name',
    'label' => null,
    'hint' => null,
])

<div class="mb-4">
    @if ($label)
        <label for="{{ $name }}" class="label">{{ $label }}</label>
    @endif

    <select id="{{ $name }}" name="{{ $name }}" {{ $attributes->merge(['class' => 'input']) }}>
        {{ $slot }}
    </select>

    @if ($hint)
        <p class="mt-1 text-xs text-muted">{{ $hint }}</p>
    @endif

    @error($name)
        <p class="mt-1 text-xs font-bold text-red-600">{{ $message }}</p>
    @enderror
</div>
