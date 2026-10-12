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
<body class="admin-login-body min-h-screen bg-paper">
    <main class="admin-login-shell grid min-h-screen lg:grid-cols-[1.08fr_.92fr]">
        <section class="admin-login-story hidden flex-col justify-between bg-ink px-16 py-12 text-white lg:flex [&_.brand-wordmark_strong]:text-white [&_.brand-mark-base]:fill-white [&_.brand-mark-person]:fill-white [&_.brand-mark-growth]:fill-white [&_h1]:my-5 [&_h1]:max-w-175 [&_h1]:text-[clamp(56px,6vw,84px)] [&_.eyebrow]:text-gold">
            <a href="{{ route('home') }}" aria-label="Return to THE IMPACT home"><x-brand-logo /></a>
            <div>
                <p class="eyebrow text-[10px] leading-[1.8] font-bold tracking-[1.5px] uppercase">Secure administration</p>
                <h1>Steward the mission.<br><em>Shape the experience.</em></h1>
                <p>One protected workspace for the content, programmes, people and settings that power THE IMPACT.</p>
            </div>
            <small>Faith · Leadership · Transformation</small>
        </section>
        <section class="admin-login-panel grid place-items-center px-5 py-8 lg:p-15">
            <div class="admin-login-card w-[min(440px,100%)] [&_>_.eyebrow]:text-plum [&_h2]:my-3 [&_h2]:text-[clamp(42px,11vw,58px)] [&_>_p:not(.eyebrow)]:text-[13px] [&_>_p:not(.eyebrow)]:leading-[1.75] [&_>_p:not(.eyebrow)]:text-muted">
                <p class="eyebrow text-[10px] leading-[1.8] font-bold tracking-[1.5px] uppercase">Authorised access only</p>
                <h2>Welcome back.</h2>
                <p>Sign in with your super-administrator account to continue.</p>

                <form action="{{ route('admin.login.store') }}" method="POST" class="admin-login-form mt-8 grid [&_label]:text-[10px] [&_label]:font-bold [&_>_input]:mt-2 [&_>_input]:mb-4.5 [&_>_input]:h-13 [&_>_input]:w-full [&_>_input]:rounded-lg [&_>_input]:border [&_>_input]:border-line [&_>_input]:bg-white [&_>_input]:px-3.5 [&_>_input]:text-sm [&_>_input]:outline-none [&_>_input]:focus:border-plum [&_>_input]:focus:ring-3 [&_>_input]:focus:ring-plum/10">
                    @csrf
                    <label for="email">Email address</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required autofocus>
                    @error('email')<p class="admin-field-error -mt-3 mb-4.5 text-[10px] text-red-700">{{ $message }}</p>@enderror

                    <div class="admin-password-label flex items-center justify-between [&_span]:text-[9px] [&_span]:text-muted"><label for="password">Password</label><span>Protected</span></div>
                    <input id="password" name="password" type="password" autocomplete="current-password" required>
                    @error('password')<p class="admin-field-error -mt-3 mb-4.5 text-[10px] text-red-700">{{ $message }}</p>@enderror

                    <label class="admin-remember flex min-h-11 items-center gap-2 text-[10px] text-muted [&_input]:size-4 [&_input]:accent-plum"><input type="checkbox" name="remember" value="1"> <span>Keep me signed in on this device</span></label>
                    <button type="submit" class="admin-login-button mt-2.5 flex min-h-13 items-center justify-between rounded-lg bg-ink px-4.5 py-3.5 text-xs font-extrabold text-white">Sign in to dashboard <span aria-hidden="true">→</span></button>
                </form>
                <a href="{{ route('home') }}" class="admin-back-link mt-4 inline-flex min-h-11 items-center text-[10px] text-muted">← Return to the public website</a>
            </div>
        </section>
    </main>
</body>
</html>
