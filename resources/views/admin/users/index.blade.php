<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <!-- Toast Alerts -->
        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-emerald-50 dark:bg-emerald-950/20 text-emerald-600 dark:text-emerald-400 text-xs font-semibold border border-emerald-100 dark:border-emerald-900/50 flex items-center gap-2 animate-fade-in">
                <i data-lucide="check-circle" class="w-4.5 h-4.5 shrink-0"></i>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-6 p-4 rounded-xl bg-rose-50 dark:bg-rose-950/20 text-rose-600 dark:text-rose-455 text-xs font-semibold border border-rose-100 dark:border-rose-900/50 flex items-center gap-2 animate-fade-in">
                <i data-lucide="alert-triangle" class="w-4.5 h-4.5 shrink-0"></i>
                {{ session('error') }}
            </div>
        @endif

        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <div>
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-600 dark:text-emerald-400 hover:underline mb-3">
                    <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i> Back to Dashboard
                </a>
                <h1 class="font-heading font-extrabold text-2xl text-slate-900 dark:text-white flex items-center gap-2">
                    <span class="p-1.5 bg-emerald-100 text-emerald-700 dark:bg-emerald-950/30 dark:text-emerald-400 rounded-xl">
                        <i data-lucide="users" class="w-5.5 h-5.5"></i>
                    </span>
                    User Management
                </h1>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Audit platform accounts, review credentials, toggle farmer gold badges, or remove accounts.</p>
            </div>
        </div>

        <!-- Search / Filter bar -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-800/80 shadow-sm p-4 mb-8">
            <form method="GET" action="{{ route('admin.users.index') }}" class="flex flex-col sm:flex-row gap-4">
                <div class="flex-grow">
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, email, role, or location..."
                            class="w-full pl-10 pr-4 py-2 bg-slate-50 dark:bg-slate-900 text-slate-850 dark:text-white border border-slate-205 dark:border-slate-700 rounded-xl text-xs focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 font-medium">
                        <span class="absolute left-3.5 top-2.5 text-slate-400">
                            <i data-lucide="search" class="w-4 h-4"></i>
                        </span>
                    </div>
                </div>
                
                <div class="w-full sm:w-48">
                    <select name="role" class="w-full py-2 bg-slate-50 dark:bg-slate-900 text-slate-850 dark:text-white border border-slate-205 dark:border-slate-700 rounded-xl text-xs focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 font-medium">
                        <option value="">All Roles</option>
                        <option value="farmer" {{ request('role') === 'farmer' ? 'selected' : '' }}>Farmers</option>
                        <option value="buyer" {{ request('role') === 'buyer' ? 'selected' : '' }}>Buyers</option>
                        <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admins</option>
                    </select>
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl shadow-sm transition-colors">
                        Apply Filters
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 dark:bg-slate-700 dark:hover:bg-slate-655 text-slate-700 dark:text-slate-200 font-bold text-xs rounded-xl transition-colors text-center flex items-center justify-center">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Users Table -->
        <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-slate-800/80 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs border-collapse">
                    <thead>
                        <tr class="border-b border-slate-100 dark:border-slate-750 bg-slate-50/50 dark:bg-slate-900/30 text-slate-400 font-bold uppercase tracking-wider text-[10px]">
                            <th class="py-4 px-6">User Name</th>
                            <th class="py-4 px-4">Email Address</th>
                            <th class="py-4 px-4">Role</th>
                            <th class="py-4 px-4">Contact Phone</th>
                            <th class="py-4 px-4">Location</th>
                            <th class="py-4 px-4">Verification</th>
                            <th class="py-4 px-4">Registered Date</th>
                            <th class="py-4 px-6 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-750 font-medium text-slate-650 dark:text-slate-300">
                        @forelse($users as $user)
                            <tr class="hover:bg-slate-50/30 dark:hover:bg-slate-900/30 transition-colors">
                                <!-- User Name -->
                                <td class="py-4 px-6 font-bold text-slate-900 dark:text-white">
                                    <div class="flex items-center gap-2">
                                        <div class="w-7 h-7 bg-emerald-50 dark:bg-emerald-950/20 text-emerald-600 rounded-full flex items-center justify-center font-bold text-xs">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <span>{{ $user->name }}</span>
                                    </div>
                                </td>

                                <!-- Email -->
                                <td class="py-4 px-4 text-slate-700 dark:text-slate-305">
                                    {{ $user->email }}
                                </td>

                                <!-- Role -->
                                <td class="py-4 px-4">
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $user->role === 'admin' ? 'bg-amber-50 text-amber-605 dark:bg-amber-950/20 dark:text-amber-400' : ($user->role === 'farmer' ? 'bg-emerald-50 text-emerald-605 dark:bg-emerald-950/20 dark:text-emerald-400' : 'bg-blue-50 text-blue-605 dark:bg-blue-950/20 dark:text-blue-400') }}">
                                        {{ $user->role }}
                                    </span>
                                </td>

                                <!-- Phone -->
                                <td class="py-4 px-4">
                                    {{ $user->phone ?? '-' }}
                                </td>

                                <!-- Location -->
                                <td class="py-4 px-4">
                                    {{ $user->location ?? '-' }}
                                </td>

                                <!-- Verification Status (only for farmers) -->
                                <td class="py-4 px-4">
                                    @if($user->role === 'farmer')
                                        @if($user->is_verified)
                                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-600 dark:bg-emerald-950/20 dark:text-emerald-400">
                                                <i data-lucide="badge-check" class="w-3.5 h-3.5 fill-emerald-500/10"></i> Verified
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-600 dark:bg-amber-950/20 dark:text-amber-400">
                                                <i data-lucide="clock" class="w-3.5 h-3.5"></i> Pending
                                            </span>
                                        @endif
                                    @else
                                        <span class="text-slate-400">-</span>
                                    @endif
                                </td>

                                <!-- Registered date -->
                                <td class="py-4 px-4 text-slate-500 dark:text-slate-400 text-[11px]">
                                    {{ $user->created_at ? $user->created_at->format('M d, Y') : '-' }}
                                </td>

                                <!-- Actions -->
                                <td class="py-4 px-6 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        @if($user->role === 'farmer')
                                            <form method="POST" action="{{ route('admin.users.verify', $user->id) }}" class="inline-block">
                                                @csrf
                                                <button type="submit" class="p-1.5 {{ $user->is_verified ? 'bg-slate-100 text-slate-600 dark:bg-slate-700 dark:text-slate-200' : 'bg-emerald-600 text-white hover:bg-emerald-700' }} font-bold rounded-lg text-[10px] transition-all" title="Toggle Verification">
                                                    {{ $user->is_verified ? 'Suspend' : 'Verify' }}
                                                </button>
                                            </form>
                                        @endif
                                        
                                        @if($user->id !== auth()->id())
                                            <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this user? All their crop listings will be deleted.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-1.5 bg-rose-50 hover:bg-rose-100 dark:bg-rose-950/15 text-rose-600 dark:text-rose-400 border border-rose-100/50 rounded-lg transition-all" title="Delete Account">
                                                    <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="py-16 text-center text-slate-400 dark:text-slate-655 p-8">
                                    <div class="w-12 h-12 rounded-full bg-slate-50 dark:bg-slate-900 flex items-center justify-center mx-auto text-slate-400 mb-3 border border-slate-100 dark:border-slate-800">
                                        <i data-lucide="users" class="w-6 h-6"></i>
                                    </div>
                                    <div class="font-bold text-slate-700 dark:text-slate-350">No users found</div>
                                    <p class="text-xs text-slate-450 mt-1 max-w-xs mx-auto">No registered user profiles matched your current search parameters.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($users->hasPages())
                <div class="p-4 border-t border-slate-100 dark:border-slate-750">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
