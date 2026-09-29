@extends('layouts.auth')

@section('title', 'Create account')
@section('heading', 'Begin with purpose.')
@section('introduction', 'Create your member account and stay connected to the programmes and opportunities ahead.')

@section('content')
    <div class="member-auth-card">
        <p class="eyebrow">Join the network</p>
        <h2>Create an account.</h2>
        <p>Your account gives you member access. Dashboard access is granted separately by an administrator.</p>
        <form action="{{ route('register.store') }}" method="POST" class="member-auth-form">
            @csrf
            <label for="name">Full name</label>
            <input id="name" name="name" type="text" value="{{ old('name') }}" autocomplete="name" required autofocus>
            @error('name')<p class="member-field-error">{{ $message }}</p>@enderror
            <label for="email">Email address</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required>
            @error('email')<p class="member-field-error">{{ $message }}</p>@enderror
            <label for="password">Password</label>
            <input id="password" name="password" type="password" autocomplete="new-password" required>
            @error('password')<p class="member-field-error">{{ $message }}</p>@enderror
            <label for="password_confirmation">Confirm password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required>
            <small>Use at least 8 characters with letters and numbers.</small>
            <button type="submit">Create account <span aria-hidden="true">→</span></button>
        </form>
        <p class="member-auth-switch">Already have an account? <a href="{{ route('login') }}">Log in</a></p>
    </div>
@endsection
