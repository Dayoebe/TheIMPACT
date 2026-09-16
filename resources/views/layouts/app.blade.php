<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#132a31">
    <title>The IMPACT — Christian Youth Leadership & Public Impact Network</title>
    <meta name="description" content="The IMPACT is a network of Christian young leaders focused on governance, public policy, leadership, service and societal transformation across Africa.">
    <meta property="og:title" content="The IMPACT — Faith-led. Service-driven. Africa-focused.">
    <meta property="og:description" content="Developing Christ-centred young leaders to shape institutions, influence public policy and transform communities and nations.">
    <meta property="og:type" content="website">
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>
    <a href="#main" class="skip-link">Skip to content</a>
    {{ $slot }}
    @livewireScripts
</body>
</html>
