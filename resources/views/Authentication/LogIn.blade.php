@extends('Layout.auth')

@section('title', __('ui.auth.login_title'))

@section('form')
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <h1 class="mb-6 text-3xl font-extrabold">{{ __('ui.auth.login_title') }}</h1>

        <x-form-field name="email" type="email" :label="__('ui.auth.email')" :hint="__('ui.hints.email')" required />
        <x-form-field name="password" type="password" :label="__('ui.auth.password')" :hint="__('ui.hints.password')" required />

        <button type="submit" class="btn btn-primary mt-2 w-full">{{ __('ui.nav.login') }}</button>

        <p class="mt-5 text-center text-sm text-muted">
            {{ __('ui.auth.no_account') }}
            <a href="{{ route('signup') }}" class="font-bold text-brand hover:underline">{{ __('ui.nav.signup') }}</a>
        </p>
    </form>
@endsection
