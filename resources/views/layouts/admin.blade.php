<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ config('app.name', 'Pterodactyl') }} - @yield('title')</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="_token" content="{{ csrf_token() }}">

        <!-- Modern minimalist dark mode -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="{{ asset('css/tailwind.css') }}" rel="stylesheet">
        @stack('styles')
    </head>
    <body>
        <header class="bg-gray-900 border-b border-gray-800 py-4 px-8">
            <nav class="flex flex-wrap items-center justify-between gap-2">
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('admin.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-md text-gray-200 hover:text-blue-400 transition @if(Route::currentRouteName() === 'admin.index') text-blue-400 @endif"><i class="fa-solid fa-gauge"></i>Dashboard</a>
                    <a href="{{ route('admin.users') }}" class="flex items-center gap-2 px-3 py-2 rounded-md text-gray-200 hover:text-blue-400 transition @if(starts_with(Route::currentRouteName(), 'admin.users')) text-blue-400 @endif"><i class="fa-solid fa-users"></i>Benutzer</a>
                    <a href="{{ route('admin.settings') }}" class="flex items-center gap-2 px-3 py-2 rounded-md text-gray-200 hover:text-blue-400 transition @if(starts_with(Route::currentRouteName(), 'admin.settings')) text-blue-400 @endif"><i class="fa-solid fa-gear"></i>Einstellungen</a>
                    <a href="{{ route('admin.servers') }}" class="flex items-center gap-2 px-3 py-2 rounded-md text-gray-200 hover:text-blue-400 transition @if(starts_with(Route::currentRouteName(), 'admin.servers')) text-blue-400 @endif"><i class="fa-solid fa-server"></i>Server</a>
                    <a href="{{ route('admin.nests') }}" class="flex items-center gap-2 px-3 py-2 rounded-md text-gray-200 hover:text-blue-400 transition @if(starts_with(Route::currentRouteName(), 'admin.nests')) text-blue-400 @endif"><i class="fa-solid fa-layer-group"></i>Nests</a>
                    <a href="{{ route('admin.mounts') }}" class="flex items-center gap-2 px-3 py-2 rounded-md text-gray-200 hover:text-blue-400 transition @if(starts_with(Route::currentRouteName(), 'admin.mounts')) text-blue-400 @endif"><i class="fa-solid fa-magic"></i>Mounts</a>
                    <a href="{{ route('admin.api.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-md text-gray-200 hover:text-blue-400 transition @if(starts_with(Route::currentRouteName(), 'admin.api')) text-blue-400 @endif"><i class="fa-solid fa-gamepad"></i>API</a>
                    <a href="{{ route('admin.databases') }}" class="flex items-center gap-2 px-3 py-2 rounded-md text-gray-200 hover:text-blue-400 transition @if(starts_with(Route::currentRouteName(), 'admin.databases')) text-blue-400 @endif"><i class="fa-solid fa-database"></i>Datenbanken</a>
                    <a href="{{ route('admin.locations') }}" class="flex items-center gap-2 px-3 py-2 rounded-md text-gray-200 hover:text-blue-400 transition @if(starts_with(Route::currentRouteName(), 'admin.locations')) text-blue-400 @endif"><i class="fa-solid fa-globe"></i>Standorte</a>
                    <a href="{{ route('admin.nodes') }}" class="flex items-center gap-2 px-3 py-2 rounded-md text-gray-200 hover:text-blue-400 transition @if(starts_with(Route::currentRouteName(), 'admin.nodes')) text-blue-400 @endif"><i class="fa-solid fa-sitemap"></i>Nodes</a>
                </div>
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('account') }}" class="flex items-center gap-2 px-3 py-2 rounded-md text-gray-200 hover:text-blue-400 transition @if(Route::currentRouteName() === 'account') text-blue-400 @endif"><i class="fa-solid fa-user"></i>{{ Auth::user()->name_first }} {{ Auth::user()->name_last }}</a>
                    <a href="{{ route('auth.logout') }}" id="logoutButton" class="flex items-center gap-2 px-3 py-2 rounded-md text-gray-200 hover:text-red-400 transition"><i class="fa-solid fa-right-from-bracket"></i>Logout</a>
                </div>
            </nav>
        </header>
        <main class="max-w-5xl mx-auto my-8 p-6 bg-gray-900 rounded-lg shadow-lg">
            @if (count($errors) > 0)
                <div class="bg-red-900 text-red-200 border border-red-700 rounded p-4 mb-4">
                    <div class="font-bold mb-2">Es gab einen Fehler bei der Validierung der Daten.</div>
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @foreach (Alert::getMessages() as $type => $messages)
                @foreach ($messages as $message)
                    <div class="mb-4 p-4 rounded border @if($type==='danger') bg-red-900 text-red-200 border-red-700 @elseif($type==='success') bg-green-900 text-green-200 border-green-700 @elseif($type==='warning') bg-yellow-900 text-yellow-200 border-yellow-700 @else bg-blue-900 text-blue-200 border-blue-700 @endif">
                        {{ $message }}
                    </div>
                @endforeach
            @endforeach
            @yield('content')
        </main>
        <footer class="text-gray-500 text-center py-4">
            &copy; {{ date('Y') }} {{ config('app.name', 'Panel') }}
        </footer>
        @stack('scripts')
    </body>
</html>