<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="font-heading font-bold text-2xl text-slate-800 dark:text-white">Create your account</h2>
        <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Join the fair trade farming revolution today.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" x-data="{ selectedRole: '{{ old('role', 'farmer') }}' }">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-semibold text-slate-700 dark:text-slate-300">Full Name</label>
            <div class="relative mt-1">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                    <i data-lucide="user" class="w-4 h-4"></i>
                </span>
                <input id="name" class="block w-full pl-10 pr-3 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all text-slate-900 dark:text-slate-100" type="text" name="name" :value="old('name')" required autofocus placeholder="John Doe" />
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-xs" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <label for="email" class="block text-sm font-semibold text-slate-700 dark:text-slate-300">Email Address</label>
            <div class="relative mt-1">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                    <i data-lucide="mail" class="w-4 h-4"></i>
                </span>
                <input id="email" class="block w-full pl-10 pr-3 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all text-slate-900 dark:text-slate-100" type="email" name="email" :value="old('email')" required placeholder="john@example.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs" />
        </div>

        <!-- Role Selection -->
        <div class="mt-4">
            <span class="block text-sm font-semibold text-slate-700 dark:text-slate-300">Choose your account type</span>
            <input type="hidden" name="role" :value="selectedRole" />
            <div class="grid grid-cols-2 gap-4 mt-2">
                <!-- Farmer Role Card -->
                <div @click="selectedRole = 'farmer'"
                     :class="selectedRole === 'farmer' ? 'border-emerald-500 bg-emerald-50/50 dark:bg-emerald-950/20 ring-2 ring-emerald-500/10' : 'border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 hover:border-emerald-500/50'"
                     class="border p-4 rounded-xl cursor-pointer transition-all flex flex-col items-center justify-center text-center">
                    <div :class="selectedRole === 'farmer' ? 'bg-emerald-500 text-white' : 'bg-slate-100 dark:bg-slate-700 text-slate-500 dark:text-slate-400'"
                         class="w-10 h-10 rounded-full flex items-center justify-center mb-2 transition-colors">
                        <i data-lucide="sprout" class="w-5 h-5"></i>
                    </div>
                    <span class="text-sm font-bold text-slate-800 dark:text-white">Farmer</span>
                    <span class="text-[11px] text-slate-500 mt-0.5">Sell your harvest directly</span>
                </div>

                <!-- Buyer Role Card -->
                <div @click="selectedRole = 'buyer'"
                     :class="selectedRole === 'buyer' ? 'border-emerald-500 bg-emerald-50/50 dark:bg-emerald-950/20 ring-2 ring-emerald-500/10' : 'border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 hover:border-emerald-500/50'"
                     class="border p-4 rounded-xl cursor-pointer transition-all flex flex-col items-center justify-center text-center">
                    <div :class="selectedRole === 'buyer' ? 'bg-emerald-500 text-white' : 'bg-slate-100 dark:bg-slate-700 text-slate-500 dark:text-slate-400'"
                         class="w-10 h-10 rounded-full flex items-center justify-center mb-2 transition-colors">
                        <i data-lucide="shopping-bag" class="w-5 h-5"></i>
                    </div>
                    <span class="text-sm font-bold text-slate-800 dark:text-white">Buyer</span>
                    <span class="text-[11px] text-slate-500 mt-0.5">Buy directly from source</span>
                </div>
            </div>
            <x-input-error :messages="$errors->get('role')" class="mt-2 text-xs" />
        </div>

        <!-- Phone Number -->
        <div class="mt-4">
            <label for="phone" class="block text-sm font-semibold text-slate-700 dark:text-slate-300">Phone Number</label>
            <div class="relative mt-1">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                    <i data-lucide="phone" class="w-4 h-4"></i>
                </span>
                <input id="phone" class="block w-full pl-10 pr-3 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all text-slate-900 dark:text-slate-100" type="tel" name="phone" :value="old('phone')" required placeholder="+91 98765 43210" />
            </div>
            <x-input-error :messages="$errors->get('phone')" class="mt-2 text-xs" />
        </div>

        <!-- Location -->
        <div class="mt-4">
            <label for="location" class="block text-sm font-semibold text-slate-700 dark:text-slate-300">Location (State, Region or City)</label>
            <div class="relative mt-1">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                    <i data-lucide="map-pin" class="w-4 h-4"></i>
                </span>
                <input id="location" class="block w-full pl-10 pr-3 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all text-slate-900 dark:text-slate-100" type="text" name="location" :value="old('location')" required placeholder="Punjab, India" />
            </div>
            <x-input-error :messages="$errors->get('location')" class="mt-2 text-xs" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password" class="block text-sm font-semibold text-slate-700 dark:text-slate-300">Password</label>
            <div class="relative mt-1">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                    <i data-lucide="lock" class="w-4 h-4"></i>
                </span>
                <input id="password" class="block w-full pl-10 pr-3 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all text-slate-900 dark:text-slate-100" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 dark:text-slate-300">Confirm Password</label>
            <div class="relative mt-1">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                    <i data-lucide="shield-check" class="w-4 h-4"></i>
                </span>
                <input id="password_confirmation" class="block w-full pl-10 pr-3 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all text-slate-900 dark:text-slate-100" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-xs" />
        </div>

        <div class="flex items-center justify-between mt-6">
            <a class="text-xs text-slate-600 hover:text-slate-950 dark:hover:text-white underline transition-colors" href="{{ route('login') }}">
                Already registered?
            </a>

            <button type="submit" class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm rounded-xl shadow-md shadow-emerald-100 dark:shadow-none hover:shadow-lg transition-all flex items-center gap-1.5">
                <i data-lucide="check" class="w-4 h-4"></i> Register
            </button>
        </div>
    </form>
</x-guest-layout>
