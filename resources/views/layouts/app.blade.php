<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Student Task Manager') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts & Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="font-sans antialiased bg-plaster text-slate-800">
        <x-banner />

        <div class="min-h-screen flex flex-col md:flex-row bg-plaster">
            
            <!-- Sidebar Navigation (Desktop) -->
            <aside class="bg-eucalyptus-700 text-white w-full md:w-64 shrink-0 hidden md:flex flex-col justify-between min-h-screen border-r border-eucalyptus-800/40">
                <div>
                    <!-- Sidebar Header / Logo -->
                    <div class="px-6 py-6 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-white/10 flex items-center justify-center text-white shrink-0 border border-white/15">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            </div>
                            <div>
                                <h1 class="font-bold text-base tracking-tight leading-tight text-white">Student</h1>
                                <p class="text-xs font-medium text-eucalyptus-200 tracking-wide">Task Manager</p>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Links -->
                    <nav class="px-4 py-2 space-y-1.5 font-medium text-sm">
                        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('dashboard') ? 'bg-white text-eucalyptus-800 font-semibold shadow-xs' : 'text-eucalyptus-100 hover:bg-white/10 hover:text-white' }}">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                            Dashboard
                        </a>

                        <a href="{{ route('tasks.create') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('tasks.create') ? 'bg-white text-eucalyptus-800 font-semibold shadow-xs' : 'text-eucalyptus-100 hover:bg-white/10 hover:text-white' }}">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Add Task
                        </a>

                        <a href="{{ route('categories.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('categories.*') ? 'bg-white text-eucalyptus-800 font-semibold shadow-xs' : 'text-eucalyptus-100 hover:bg-white/10 hover:text-white' }}">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 11h.01M7 15h.01M11 7h8M11 11h8M11 15h8"></path></svg>
                            Categories
                        </a>

                        @if (Route::has('profile.show'))
                            <a href="{{ route('profile.show') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('profile.show') ? 'bg-white text-eucalyptus-800 font-semibold shadow-xs' : 'text-eucalyptus-100 hover:bg-white/10 hover:text-white' }}">
                                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                Profile
                            </a>
                        @endif

                        <form method="POST" action="{{ route('logout') }}" x-data x-on:submit="if (!confirm('Are you sure you want to log out?')) $event.preventDefault();">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl transition text-eucalyptus-100 hover:bg-white/10 hover:text-white">
                                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                Logout
                            </button>
                        </form>
                    </nav>
                </div>
            </aside>

            <!-- Mobile Header Bar -->
            <div class="md:hidden bg-eucalyptus-700 text-white px-4 py-3.5 flex items-center justify-between border-b border-eucalyptus-800">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center text-white shrink-0 border border-white/15">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <span class="font-bold text-sm text-white">Student Task Manager</span>
                </div>

                <a href="{{ route('profile.show') }}" class="flex items-center gap-2 bg-white/10 border border-white/20 pl-1.5 pr-2.5 py-1 rounded-full text-xs font-semibold text-white">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos() && Auth::user()->profile_photo_url)
                        <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="w-6 h-6 rounded-full object-cover">
                    @else
                        <div class="w-6 h-6 rounded-full bg-white text-eucalyptus-800 font-bold text-xs flex items-center justify-center uppercase">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                    @endif
                    <span>{{ Auth::user()->name }}</span>
                </a>
            </div>

            <!-- Main Content Area -->
            <div class="flex-1 flex flex-col min-w-0">
                
                <!-- Desktop Top Navigation Header Bar -->
                <header class="bg-white border-b border-stone-200/80 px-6 py-4 hidden md:flex items-center justify-between sticky top-0 z-30 shadow-2xs">
                    <div class="flex items-center gap-3">
                        <h2 class="text-sm font-semibold text-stone-500">Welcome back, <span class="text-stone-900 font-bold">{{ Auth::user()->name }}</span></h2>
                    </div>

                    <div class="flex items-center gap-4">
                        <!-- Bell Icon -->
                        <button class="p-2 rounded-xl text-stone-400 hover:text-stone-600 hover:bg-stone-100 transition relative">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                            <span class="w-2 h-2 rounded-full bg-amber-500 absolute top-2 right-2 border border-white"></span>
                        </button>

                        <!-- User Profile Pill (Linked to Profile Page) -->
                        <a href="{{ route('profile.show') }}" title="Go to Profile" class="flex items-center gap-2.5 bg-stone-50 hover:bg-stone-100 border border-stone-200/80 pl-2 pr-3 py-1.5 rounded-full transition group">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos() && Auth::user()->profile_photo_url)
                                <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="w-7 h-7 rounded-full object-cover border border-stone-200">
                            @else
                                <div class="w-7 h-7 rounded-full bg-eucalyptus-700 text-white font-bold text-xs flex items-center justify-center uppercase">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                            @endif
                            <span class="text-xs font-bold text-stone-800 group-hover:text-eucalyptus-800 transition">{{ Auth::user()->name }}</span>
                        </a>
                    </div>
                </header>

                <!-- Main Content Body -->
                <main class="flex-1 p-4 sm:p-8 max-w-7xl w-full mx-auto space-y-6 pb-24 md:pb-8">
                    {{ $slot }}
                </main>
            </div>

            <!-- Mobile Bottom Navigation Bar -->
            <nav class="md:hidden fixed bottom-0 inset-x-0 bg-eucalyptus-700 text-white z-40 border-t border-eucalyptus-800/80 flex items-center justify-around py-2 px-1 shadow-lg">
                <a href="{{ route('dashboard') }}" class="flex flex-col items-center py-1 px-3 rounded-xl text-[11px] font-medium transition {{ request()->routeIs('dashboard') ? 'text-white bg-white/15 font-bold' : 'text-eucalyptus-200 hover:text-white' }}">
                    <svg class="w-5 h-5 mb-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Dashboard
                </a>

                <a href="{{ route('tasks.create') }}" class="flex flex-col items-center py-1 px-3 rounded-xl text-[11px] font-medium transition {{ request()->routeIs('tasks.create') ? 'text-white bg-white/15 font-bold' : 'text-eucalyptus-200 hover:text-white' }}">
                    <svg class="w-5 h-5 mb-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Add Task
                </a>

                <a href="{{ route('categories.index') }}" class="flex flex-col items-center py-1 px-3 rounded-xl text-[11px] font-medium transition {{ request()->routeIs('categories.*') ? 'text-white bg-white/15 font-bold' : 'text-eucalyptus-200 hover:text-white' }}">
                    <svg class="w-5 h-5 mb-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 11h.01M7 15h.01M11 7h8M11 11h8M11 15h8"></path></svg>
                    Categories
                </a>

                <a href="{{ route('profile.show') }}" class="flex flex-col items-center py-1 px-3 rounded-xl text-[11px] font-medium transition {{ request()->routeIs('profile.show') ? 'text-white bg-white/15 font-bold' : 'text-eucalyptus-200 hover:text-white' }}">
                    <svg class="w-5 h-5 mb-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    Profile
                </a>

                <form method="POST" action="{{ route('logout') }}" x-data x-on:submit="if (!confirm('Are you sure you want to log out?')) $event.preventDefault();" class="flex flex-col items-center">
                    @csrf
                    <button type="submit" class="flex flex-col items-center py-1 px-3 rounded-xl text-[11px] font-medium text-eucalyptus-200 hover:text-white transition">
                        <svg class="w-5 h-5 mb-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Logout
                    </button>
                </form>
            </nav>

        </div>

        @stack('modals')
        @livewireScripts
    </body>
</html>
