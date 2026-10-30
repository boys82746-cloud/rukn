@props(['value'])

<span {{ $attributes }}>
    @if ((int) $value === 0)
        {{ __('ui.free') }}
    @else
        {{ number_format((int) $value) }} {{ __('ui.currency') }}
    @endif
</span>
