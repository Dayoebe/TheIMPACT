@extends('layouts.auth')

@section('title', 'Log in')
@section('heading', 'Welcome back to the network.')
@section('introduction', 'Continue your journey of faith-led growth, service and contribution.')

@section('content')
    <div class="member-auth-card">
        <p class="eyebrow">Member access</p>
        <h2>Log in.</h2>
        <p>Use the email address and password attached to your account.</p>
        <form action="{{ route('login.store') }}" method="POST" class="member-auth-form">
            @csrf
            <label for="email">Email address</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required autofocus>
            @error('email')<p class="member-field-error">{{ $message }}</p>@enderror
            <label for="password">Password</label>
            <input id="password" name="password" type="password" autocomplete="current-password" required>
            @error('password')<p class="member-field-error">{{ $message }}</p>@enderror
            <label class="member-remember"><input type="checkbox" name="remember" value="1"><span>Keep me signed in</span></label>
            <button type="submit">Log in <span aria-hidden="true">→</span></button>
        </form>
        <p class="member-auth-switch">New to the network? <a href="{{ route('register') }}">Create an account</a></p>
    </div>
@endsection
