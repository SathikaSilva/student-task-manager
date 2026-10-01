<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <div class="flex flex-col items-center gap-2">
                <div class="w-12 h-12 rounded-2xl bg-eucalyptus-700 text-white flex items-center justify-center shadow-md">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <h1 class="font-bold text-2xl text-stone-900 tracking-tight">Student Task Manager</h1>
                <p class="text-xs text-stone-500 font-medium">Organise your academic tasks with ease.</p>
            </div>
        </x-slot>

        <div class="mb-6">
            <h2 class="text-lg font-bold text-stone-900">Welcome back</h2>
            <p class="text-xs text-stone-500">Sign in to continue to your account.</p>
        </div>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-xs text-emerald-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block text-xs font-bold text-stone-700 uppercase tracking-wider mb-1">Email address</label>
                <input id="email" class="w-full px-4 py-2.5 rounded-xl border border-stone-300 text-stone-900 text-sm focus:ring-eucalyptus-600 focus:border-eucalyptus-600 transition" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Enter your email" />
            </div>

            <div>
                <label for="password" class="block text-xs font-bold text-stone-700 uppercase tracking-wider mb-1">Password</label>
                <input id="password" class="w-full px-4 py-2.5 rounded-xl border border-stone-300 text-stone-900 text-sm focus:ring-eucalyptus-600 focus:border-eucalyptus-600 transition" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
            </div>

            <div class="flex items-center justify-between text-xs pt-1">
                <label for="remember_me" class="flex items-center cursor-pointer">
                    <x-checkbox id="remember_me" name="remember" class="rounded-md border-stone-300 text-eucalyptus-700 focus:ring-eucalyptus-600" />
                    <span class="ms-2 text-stone-600 font-medium">{{ __('Remember me') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-stone-500 hover:text-stone-900 font-medium hover:underline" href="{{ route('password.request') }}">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>

            <div class="pt-3">
                <button type="submit" class="w-full bg-soot hover:bg-eucalyptus-900 text-white font-bold py-3 rounded-xl transition text-sm shadow-xs">
                    Sign in
                </button>
            </div>

            <div class="text-center pt-4 border-t border-stone-100 text-xs text-stone-500">
                Don't have an account? 
                <a href="{{ route('register') }}" class="font-bold text-eucalyptus-700 hover:underline">Register</a>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
