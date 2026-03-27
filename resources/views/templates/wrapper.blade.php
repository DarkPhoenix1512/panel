<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Pterodactyl') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex">
    <link rel="icon" type="image/png" href="/favicons/favicon-32x32.png" sizes="32x32">
    <link rel="manifest" href="/favicons/manifest.json">
    <meta name="theme-color" content="#111827">
    @yield('assets')
    @include('layouts.scripts')
</head>
<body class="bg-gray-900 text-gray-100 min-h-screen font-sans">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-950 border-r border-gray-800 flex flex-col">
            <div class="h-16 flex items-center justify-center border-b border-gray-800">
                <img src="/favicons/favicon-32x32.png" alt="Logo" class="h-8 w-8 mr-2 inline-block">
                <span class="text-xl font-bold tracking-wide">{{ config('app.name', 'Pterodactyl') }}</span>
            </div>
            <nav class="flex-1 px-4 py-6">
                <ul class="space-y-2">
                    <li><a href="/" class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-800 transition"><svg class="h-5 w-5 mr-2 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6m-6 0v6m0 0H7m6 0h6"/></svg>Dashboard</a></li>
                    <li><a href="/servers" class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-800 transition"><svg class="h-5 w-5 mr-2 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="7" width="18" height="13" rx="2"/><path d="M8 3v4m8-4v4"/></svg>Server</a></li>
                    <li><a href="/account" class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-800 transition"><svg class="h-5 w-5 mr-2 text-yellow-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="7" r="4"/><path d="M5.5 21a8.38 8.38 0 0 1 13 0"/></svg>Account</a></li>
                    <li><a href="/settings" class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-800 transition"><svg class="h-5 w-5 mr-2 text-purple-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09a1.65 1.65 0 0 0-1-1.51 1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09a1.65 1.65 0 0 0 1.51-1 1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33h.09A1.65 1.65 0 0 0 12 3.09V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82v.09c0 .66.26 1.3.73 1.77z"/></svg>Einstellungen</a></li>
                </ul>
            </nav>
            <div class="p-4 border-t border-gray-800">
                <form method="POST" action="/logout">
                    @csrf
                    <button type="submit" class="w-full flex items-center px-3 py-2 rounded-lg hover:bg-gray-800 transition text-red-400"><svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 16l4-4m0 0l-4-4m4 4H7"/><path d="M3 12a9 9 0 1 1 18 0 9 9 0 0 1-18 0z"/></svg>Logout</button>
                </form>
            </div>
        </aside>
        <!-- Main Content -->
        <main class="flex-1 bg-gray-900 p-8 overflow-y-auto">
            @section('content')
                @yield('above-container')
                @yield('container')
                @yield('below-container')
            @show
        </main>
    </div>
    @section('scripts')
        {!! $asset->js('main.js') !!}
    @show
</body>
</html>
