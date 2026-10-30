@props([
    'name',
    'id' => null,
    'label' => null,
    'type' => 'text',
    'hint' => null,
    'textarea' => false,
    'value' => null,
    'rows' => 4,
    'counter' => false,
])

@php
    $fieldId = $id ?: $name;
    // Never echo a password back into the page
    $current = $type === 'password' ? '' : old($name, $value);
    $merge = ['class' => 'input peer user-invalid:border-red-500'];

    if ($counter) {
        // Live "12/155" character counter (see the data-count span below)
        $merge['oninput'] = "this.parentElement.querySelector('[data-count]').textContent = this.value.length";
    }
@endphp

<div class="mb-4">
    @if ($label)
        <label for="{{ $fieldId }}" class="label">{{ $label }}</label>
    @endif

    @if ($textarea)
        <textarea id="{{ $fieldId }}" name="{{ $name }}" rows="{{ $rows }}"
            {{ $attributes->merge($merge) }}>{{ $current }}</textarea>
    @else
        <input id="{{ $fieldId }}" name="{{ $name }}" type="{{ $type }}"
            @if ($type !== 'password') value="{{ $current }}" @endif
            {{ $attributes->merge($merge) }}>
    @endif

    {{-- Short guidance under every field (non-functional requirement) --}}
    @if ($hint || $counter)
        <div class="mt-1 flex items-center justify-between gap-3 text-xs text-muted">
            <p>{{ $hint }}</p>
            @if ($counter)
                <span><span data-count>{{ mb_strlen((string) $current) }}</span>/{{ $attributes->get('maxlength') }}</span>
            @endif
        </div>
    @endif

    @error($name)
        <p class="mt-1 text-xs font-bold text-red-600">{{ $message }}</p>
    @enderror
</div>
