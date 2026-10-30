@extends('Layout.auth')

@section('title', __('ui.auth.signup_title'))

@section('form')
    <form method="POST" action="{{ route('signup') }}">
        @csrf

        <h1 class="mb-6 text-3xl font-extrabold">{{ __('ui.auth.signup_title') }}</h1>

        <x-form-field name="name" :label="__('ui.auth.name')" :hint="__('ui.hints.name')" required minlength="2" maxlength="50" />
        <x-form-field name="email" type="email" :label="__('ui.auth.email')" :hint="__('ui.hints.email')" required />
        <x-form-field name="password" type="password" :label="__('ui.auth.password')" :hint="__('ui.hints.password')" required minlength="8" />

        <button type="submit" class="btn btn-primary mt-2 w-full">{{ __('ui.nav.signup') }}</button>

        <p class="mt-5 text-center text-sm text-muted">
            {{ __('ui.auth.have_account') }}
            <a href="{{ route('login') }}" class="font-bold text-brand hover:underline">{{ __('ui.nav.login') }}</a>
        </p>
    </form>
@endsection
