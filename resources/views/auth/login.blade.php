<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="font-heading font-bold text-2xl text-slate-800 dark:text-white">Welcome back</h2>
        <p class="text-slate-600 dark:text-slate-400 text-sm mt-1">Sign in to your fair trade account.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-sm font-semibold text-emerald-600 dark:text-emerald-400" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-semibold text-slate-700 dark:text-slate-300">Email Address</label>
            <div class="relative mt-1">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                    <i data-lucide="mail" class="w-4 h-4"></i>
                </span>
                <input id="email" class="block w-full pl-10 pr-3 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all text-slate-900 dark:text-slate-100" type="email" name="email" :value="old('email')" required autofocus placeholder="john@example.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <div class="flex justify-between items-center">
                <label for="password" class="block text-sm font-semibold text-slate-700 dark:text-slate-300">Password</label>
                @if (Route::has('password.request'))
                    <a class="text-xs text-slate-600 hover:text-slate-900 dark:hover:text-white transition-colors" href="{{ route('password.request') }}">
                        Forgot password?
                    </a>
                @endif
            </div>
            <div class="relative mt-1">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                    <i data-lucide="lock" class="w-4 h-4"></i>
                </span>
                <input id="password" class="block w-full pl-10 pr-3 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all text-slate-900 dark:text-slate-100" type="password" name="password" required placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded border-slate-300 dark:border-slate-700 text-emerald-600 focus:ring-emerald-500 dark:bg-slate-900" name="remember">
                <span class="ms-2 text-xs text-slate-600 dark:text-slate-400">Remember me on this device</span>
            </label>
        </div>

        <div class="mt-6 flex flex-col gap-3">
            <button type="submit" class="w-full py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm rounded-xl shadow-md shadow-emerald-100 dark:shadow-none hover:shadow-lg transition-all flex items-center justify-center gap-1.5">
                <i data-lucide="log-in" class="w-4 h-4"></i> Log In
            </button>
            
            <p class="text-center text-xs text-slate-600 mt-2">
                Don't have an account? 
                <a href="{{ route('register') }}" class="text-emerald-600 dark:text-emerald-400 font-semibold hover:underline">Register here</a>
            </p>
        </div>
    </form>
</x-guest-layout>
