@extends('layouts.auth')

@section('title', 'Create account')
@section('heading', 'Begin with purpose.')
@section('introduction', 'Create your member account and stay connected to the programmes and opportunities ahead.')

@section('content')
    <div class="member-auth-card w-[min(470px,100%)] [&_>_.eyebrow]:text-plum [&_h2]:my-3 [&_h2]:text-[clamp(42px,11vw,58px)] [&_>_p:not(.eyebrow)]:text-[13px] [&_>_p:not(.eyebrow)]:leading-[1.75] [&_>_p:not(.eyebrow)]:text-muted">
        <p class="eyebrow text-[10px] leading-[1.8] font-bold tracking-[1.5px] uppercase">Join the network</p>
        <h2>Create an account.</h2>
        <p>Your account gives you member access. Dashboard access is granted separately by an administrator.</p>
        <form action="{{ route('register.store') }}" method="POST" class="member-auth-form mt-7 grid [&_>_label:not(.member-remember)]:text-[10px] [&_>_label:not(.member-remember)]:font-bold [&_>_input]:mt-2 [&_>_input]:mb-4.5 [&_>_input]:h-13 [&_>_input]:w-full [&_>_input]:rounded-lg [&_>_input]:border [&_>_input]:border-line [&_>_input]:bg-white [&_>_input]:px-3.5 [&_>_input]:text-sm [&_>_input]:outline-none [&_>_input]:focus:border-plum [&_>_input]:focus:ring-3 [&_>_input]:focus:ring-plum/10 [&_>_button]:mt-2 [&_>_button]:flex [&_>_button]:min-h-13 [&_>_button]:items-center [&_>_button]:justify-between [&_>_button]:rounded-lg [&_>_button]:bg-ink [&_>_button]:px-4.5 [&_>_button]:py-3.5 [&_>_button]:text-xs [&_>_button]:font-extrabold [&_>_button]:text-white">
            @csrf
            <label for="name">Full name</label>
            <input id="name" name="name" type="text" value="{{ old('name') }}" autocomplete="name" required autofocus>
            @error('name')<p class="member-field-error -mt-2.5 mb-4 text-[10px] text-red-700">{{ $message }}</p>@enderror
            <label for="email">Email address</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required>
            @error('email')<p class="member-field-error -mt-2.5 mb-4 text-[10px] text-red-700">{{ $message }}</p>@enderror
            <label for="password">Password</label>
            <input id="password" name="password" type="password" autocomplete="new-password" required>
            @error('password')<p class="member-field-error -mt-2.5 mb-4 text-[10px] text-red-700">{{ $message }}</p>@enderror
            <label for="password_confirmation">Confirm password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required>
            <small>Use at least 8 characters with letters and numbers.</small>
            <button type="submit">Create account <span aria-hidden="true">→</span></button>
        </form>
        <p class="member-auth-switch mt-5 text-[11px] text-muted [&_a]:font-extrabold [&_a]:text-plum [&_a]:underline [&_a]:underline-offset-4">Already have an account? <a href="{{ route('login') }}">Log in</a></p>
    </div>
@endsection
