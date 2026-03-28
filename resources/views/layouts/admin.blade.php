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
        <link rel="stylesheet" href="{{ asset('css/admin-dark.css') }}">
        @stack('styles')
    </head>
    <body>
        <header>
            <nav>
                <a href="{{ route('admin.index') }}" class="@if(Route::currentRouteName() === 'admin.index') active @endif"><span class="icon"><i class="fa-solid fa-gauge"></i></span>Dashboard</a>
                <a href="{{ route('admin.users') }}" class="@if(starts_with(Route::currentRouteName(), 'admin.users')) active @endif"><span class="icon"><i class="fa-solid fa-users"></i></span>Benutzer</a>
                <a href="{{ route('admin.settings') }}" class="@if(starts_with(Route::currentRouteName(), 'admin.settings')) active @endif"><span class="icon"><i class="fa-solid fa-gear"></i></span>Einstellungen</a>
                <a href="{{ route('admin.servers') }}" class="@if(starts_with(Route::currentRouteName(), 'admin.servers')) active @endif"><span class="icon"><i class="fa-solid fa-server"></i></span>Server</a>
                <a href="{{ route('admin.nests') }}" class="@if(starts_with(Route::currentRouteName(), 'admin.nests')) active @endif"><span class="icon"><i class="fa-solid fa-layer-group"></i></span>Nests</a>
                <a href="{{ route('admin.mounts') }}" class="@if(starts_with(Route::currentRouteName(), 'admin.mounts')) active @endif"><span class="icon"><i class="fa-solid fa-magic"></i></span>Mounts</a>
                <a href="{{ route('admin.api.index') }}" class="@if(starts_with(Route::currentRouteName(), 'admin.api')) active @endif"><span class="icon"><i class="fa-solid fa-gamepad"></i></span>API</a>
                <a href="{{ route('admin.databases') }}" class="@if(starts_with(Route::currentRouteName(), 'admin.databases')) active @endif"><span class="icon"><i class="fa-solid fa-database"></i></span>Datenbanken</a>
                <a href="{{ route('admin.locations') }}" class="@if(starts_with(Route::currentRouteName(), 'admin.locations')) active @endif"><span class="icon"><i class="fa-solid fa-globe"></i></span>Standorte</a>
                <a href="{{ route('admin.nodes') }}" class="@if(starts_with(Route::currentRouteName(), 'admin.nodes')) active @endif"><span class="icon"><i class="fa-solid fa-sitemap"></i></span>Nodes</a>
                <a href="{{ route('account') }}" class="@if(Route::currentRouteName() === 'account') active @endif" style="float:right;"><span class="icon"><i class="fa-solid fa-user"></i></span>{{ Auth::user()->name_first }} {{ Auth::user()->name_last }}</a>
                <a href="{{ route('auth.logout') }}" id="logoutButton" style="float:right;"><span class="icon"><i class="fa-solid fa-right-from-bracket"></i></span>Logout</a>
            </nav>
        </header>
        <main class="container">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    Es gab einen Fehler bei der Validierung der Daten.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @foreach (Alert::getMessages() as $type => $messages)
                @foreach ($messages as $message)
                    <div class="alert alert-{{ $type }} alert-dismissable" role="alert">
                        {{ $message }}
                    </div>
                @endforeach
            @endforeach
            @yield('content')
        </main>
        <footer class="text-muted" style="text-align:center; padding:1rem 0;">
            &copy; {{ date('Y') }} {{ config('app.name', 'Panel') }}
        </footer>
        @stack('scripts')
    </body>
</html>