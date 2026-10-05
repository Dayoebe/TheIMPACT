<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="theme-color" content="#341027">
    <title>Admin sign in — THE IMPACT</title>
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="admin-login-body">
    <main class="admin-login-shell">
        <section class="admin-login-story">
            <a href="{{ route('home') }}" aria-label="Return to THE IMPACT home"><x-brand-logo /></a>
            <div>
                <p class="eyebrow">Secure administration</p>
                <h1>Steward the mission.<br><em>Shape the experience.</em></h1>
                <p>One protected workspace for the content, programmes, people and settings that power THE IMPACT.</p>
            </div>
            <small>Faith · Leadership · Transformation</small>
        </section>
        <section class="admin-login-panel">
            <div class="admin-login-card">
                <p class="eyebrow">Authorised access only</p>
                <h2>Welcome back.</h2>
                <p>Sign in with your super-administrator account to continue.</p>

                <form action="{{ route('admin.login.store') }}" method="POST" class="admin-login-form">
                    @csrf
                    <label for="email">Email address</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required autofocus>
                    @error('email')<p class="admin-field-error">{{ $message }}</p>@enderror

                    <div class="admin-password-label"><label for="password">Password</label><span>Protected</span></div>
                    <input id="password" name="password" type="password" autocomplete="current-password" required>
                    @error('password')<p class="admin-field-error">{{ $message }}</p>@enderror

                    <label class="admin-remember"><input type="checkbox" name="remember" value="1"> <span>Keep me signed in on this device</span></label>
                    <button type="submit" class="admin-login-button">Sign in to dashboard <span aria-hidden="true">→</span></button>
                </form>
                <a href="{{ route('home') }}" class="admin-back-link">← Return to the public website</a>
            </div>
        </section>
    </main>
</body>
</html>
