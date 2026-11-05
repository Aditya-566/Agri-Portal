<x-app-layout>
    <!-- Script for Charts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Ambient organic glowing light spots -->
    <div class="absolute top-20 right-10 w-80 h-80 blob-teal rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-40 left-20 w-96 h-96 blob-orange rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute inset-0 sunlight-ray opacity-45 pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 relative z-10">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
            <div>
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-black uppercase tracking-wider bg-primary/10 text-primary border border-primary/20 shadow-sm">
                    <i data-lucide="shield-check" class="w-3.5 h-3.5 text-primary"></i> Platform Control Center
                </span>
                <h1 class="font-heading font-black text-3xl text-charcoal mt-3 flex items-center gap-2">
                    Admin Command Dashboard
                </h1>
                <p class="text-xs text-charcoal/70 mt-1">Audit direct agricultural trades, verify seller credentials, moderate listings, and monitor platform demographics.</p>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-8 p-4.5 rounded-2xl bg-primary/5 text-primary text-xs font-semibold border border-primary/15 flex items-center gap-2.5 shadow-sm">
                <i data-lucide="check-circle" class="w-5 h-5 shrink-0 text-primary"></i>
                {{ session('success') }}
            </div>
        @endif

        <!-- Admin stats cards -->
        <div class="grid grid-cols-2 lg:grid-cols-6 gap-5 mb-8">
            <!-- Trade Volume -->
            <div class="glass-teal p-4.5 rounded-2xl border border-primary/20 shadow-premium flex items-center gap-3 hover:scale-[1.02] transition-all duration-300">
                <div class="p-2.5 bg-primary/10 text-primary rounded-xl shrink-0">
                    <i data-lucide="wallet" class="w-5 h-5"></i>
                </div>
                <div>
                    <span class="text-[9px] uppercase font-black text-charcoal/50 tracking-wider block">Trade Volume</span>
                    <span class="text-sm font-black text-charcoal block mt-0.5">₹{{ number_format($stats['total_revenue'], 2) }}</span>
                </div>
            </div>

            <!-- Total Users -->
            <div class="glass-premium p-4.5 rounded-2xl border border-white/50 shadow-premium flex items-center gap-3 hover:scale-[1.02] transition-all duration-300">
                <div class="p-2.5 bg-primary/10 text-primary rounded-xl shrink-0">
                    <i data-lucide="users" class="w-5 h-5"></i>
                </div>
                <div>
                    <span class="text-[9px] uppercase font-black text-charcoal/50 tracking-wider block">Total Users</span>
                    <span class="text-sm font-black text-charcoal block mt-0.5">{{ $stats['total_users'] }}</span>
                </div>
            </div>

            <!-- Farmers -->
            <div class="glass-premium p-4.5 rounded-2xl border border-white/50 shadow-premium flex items-center gap-3 hover:scale-[1.02] transition-all duration-300">
                <div class="p-2.5 bg-primary/10 text-primary rounded-xl shrink-0">
                    <i data-lucide="sprout" class="w-5 h-5"></i>
                </div>
                <div>
                    <span class="text-[9px] uppercase font-black text-charcoal/50 tracking-wider block">Farmers</span>
                    <span class="text-sm font-black text-charcoal block mt-0.5">{{ $stats['total_farmers'] }}</span>
                </div>
            </div>

            <!-- Buyers -->
            <div class="glass-premium p-4.5 rounded-2xl border border-white/50 shadow-premium flex items-center gap-3 hover:scale-[1.02] transition-all duration-300">
                <div class="p-2.5 bg-primary/10 text-primary rounded-xl shrink-0">
                    <i data-lucide="shopping-bag" class="w-5 h-5"></i>
                </div>
                <div>
                    <span class="text-[9px] uppercase font-black text-charcoal/50 tracking-wider block">Buyers</span>
                    <span class="text-sm font-black text-charcoal block mt-0.5">{{ $stats['total_buyers'] }}</span>
                </div>
            </div>

            <!-- Listed crops -->
            <div class="glass-premium p-4.5 rounded-2xl border border-white/50 shadow-premium flex items-center gap-3 hover:scale-[1.02] transition-all duration-300">
                <div class="p-2.5 bg-primary/10 text-primary rounded-xl shrink-0">
                    <i data-lucide="package" class="w-5 h-5"></i>
                </div>
                <div>
                    <span class="text-[9px] uppercase font-black text-charcoal/50 tracking-wider block">Crops Listed</span>
                    <span class="text-sm font-black text-charcoal block mt-0.5">{{ $stats['total_products'] }}</span>
                </div>
            </div>

            <!-- Orders -->
            <div class="glass-orange p-4.5 rounded-2xl border border-secondary/20 shadow-premium flex items-center gap-3 hover:scale-[1.02] transition-all duration-300">
                <div class="p-2.5 bg-secondary/10 text-secondary rounded-xl shrink-0">
                    <i data-lucide="receipt" class="w-5 h-5"></i>
                </div>
                <div>
                    <span class="text-[9px] uppercase font-black text-charcoal/50 tracking-wider block">Orders Logged</span>
                    <span class="text-sm font-black text-charcoal block mt-0.5">{{ $stats['total_orders'] }}</span>
                </div>
            </div>
        </div>

        <!-- Administrative controls quick navigator -->
        <div class="grid grid-cols-3 gap-4 mb-8">
            <a href="{{ route('admin.users.index') }}" class="p-5 rounded-3xl glass-premium border border-white/40 hover:border-primary/50 hover:bg-white shadow-premium-hover flex flex-col items-center justify-center text-center transition-all group">
                <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center mb-2.5 group-hover:scale-110 transition-transform">
                    <i data-lucide="user-check" class="w-5 h-5"></i>
                </div>
                <span class="text-xs font-black text-charcoal uppercase tracking-wider">Verify Sellers Queue</span>
            </a>
            <a href="{{ route('admin.products.index') }}" class="p-5 rounded-3xl glass-premium border border-white/40 hover:border-primary/50 hover:bg-white shadow-premium-hover flex flex-col items-center justify-center text-center transition-all group">
                <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center mb-2.5 group-hover:scale-110 transition-transform">
                    <i data-lucide="alert-octagon" class="w-5 h-5"></i>
                </div>
                <span class="text-xs font-black text-charcoal uppercase tracking-wider">Moderate Listings</span>
            </a>
            <a href="{{ route('admin.categories.index') }}" class="p-5 rounded-3xl glass-premium border border-white/40 hover:border-primary/50 hover:bg-white shadow-premium-hover flex flex-col items-center justify-center text-center transition-all group">
                <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center mb-2.5 group-hover:scale-110 transition-transform">
                    <i data-lucide="tags" class="w-5 h-5"></i>
                </div>
                <span class="text-xs font-black text-charcoal uppercase tracking-wider">Crop Categories</span>
            </a>
        </div>

        <!-- SaaS Dynamics charts grid -->
        <div class="grid lg:grid-cols-2 gap-8 mb-8">
            <!-- Platform trade dynamics line chart -->
            <div class="glass-premium p-6 rounded-3xl border border-white/50 shadow-premium space-y-4">
                <h3 class="font-heading font-black text-charcoal text-base">Trade Volume Dynamics</h3>
                <div class="h-64 relative">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>

            <!-- User Roles distribution breakdown -->
            <div class="glass-premium p-6 rounded-3xl border border-white/50 shadow-premium space-y-4">
                <h3 class="font-heading font-black text-charcoal text-base">Demographics Breakdown</h3>
                <div class="h-64 relative">
                    <canvas id="userChart"></canvas>
                </div>
            </div>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Left 2 Cols: Pending verifications queue -->
            <div class="lg:col-span-2 space-y-6">
                <div class="glass-premium p-6 rounded-3xl border border-white/50 shadow-premium space-y-4">
                    <div class="flex items-center justify-between border-b border-primary/10 pb-4">
                        <div>
                            <h3 class="font-heading font-black text-charcoal text-base">Pending Verification Requests</h3>
                            <p class="text-[10px] text-charcoal/50 mt-0.5">Farmers awaiting credentials review to sell directly.</p>
                        </div>
                        <a href="{{ route('admin.users.index') }}" class="text-xs font-black text-primary hover:underline uppercase tracking-wider">View Full Queue</a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs border-collapse">
                            <thead>
                                <tr class="border-b border-primary/10 text-charcoal/40 font-black uppercase tracking-wider text-[10px]">
                                    <th class="py-3 px-4">Farmer Name</th>
                                    <th class="py-3 px-4">Contact Phone</th>
                                    <th class="py-3 px-4">Harvest Location</th>
                                    <th class="py-3 px-4 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-primary/5 font-medium text-charcoal/85">
                                @forelse($pendingFarmers as $farmer)
                                    <tr class="hover:bg-primary/5 transition-colors">
                                        <td class="py-3.5 px-4 font-bold text-charcoal">{{ $farmer->name }}</td>
                                        <td class="py-3.5 px-4 text-charcoal/70">{{ $farmer->phone ?? 'N/A' }}</td>
                                        <td class="py-3.5 px-4">
                                            <span class="flex items-center gap-1 text-charcoal/70">
                                                <i data-lucide="map-pin" class="w-3.5 h-3.5 text-primary"></i> {{ $farmer->location ?? 'N/A' }}
                                            </span>
                                        </td>
                                        <td class="py-3.5 px-4 text-right">
                                            <form method="POST" action="{{ route('admin.users.verify', $farmer->id) }}" class="inline-block">
                                                @csrf
                                                <button type="submit" class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-primary hover:opacity-95 text-white font-black text-[10px] uppercase tracking-wider rounded-xl shadow-premium transition-all">
                                                    Approve Farmer <i data-lucide="check" class="w-3.5 h-3.5"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-12 text-center text-charcoal/40">
                                            <div class="mb-3 text-primary/30"><i data-lucide="user-check" class="w-10 h-10 mx-auto"></i></div>
                                            No farmers pending verification. All sellers are active.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Right 1 Col: Recent order feeds -->
            <div class="space-y-6">
                <div class="glass-premium p-6 rounded-3xl border border-white/50 shadow-premium space-y-4">
                    <h3 class="font-heading font-black text-charcoal text-base pb-3 border-b border-primary/10">
                        Platform Trade Logs
                    </h3>

                    <div class="space-y-4.5 max-h-[350px] overflow-y-auto pr-1">
                        @forelse($recentOrders as $order)
                            <div class="p-3.5 bg-white/40 rounded-2xl border border-primary/5 hover:border-primary/20 hover:bg-white transition-all flex justify-between items-center gap-2 text-xs">
                                <div>
                                    <span class="font-mono font-bold text-primary">#{{ substr($order->id, -6) }}</span>
                                    <span class="text-[9px] text-charcoal/50 block mt-0.5 font-semibold">Buyer: {{ $order->buyer?->name ?? 'N/A' }}</span>
                                </div>
                                <div class="text-right">
                                    <span class="font-black text-charcoal block">₹{{ number_format($order->total_amount, 2) }}</span>
                                    <span class="inline-flex items-center gap-0.5 px-2 py-0.5 rounded-lg text-[9px] font-black uppercase tracking-wider bg-primary/10 text-primary border border-primary/15 mt-1">
                                        {{ $order->status }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-10 text-charcoal/40 text-xs font-semibold">
                                <div class="mb-3 text-primary/30"><i data-lucide="receipt" class="w-8 h-8 mx-auto"></i></div>
                                No direct trades logged yet.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart JS Setup Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // 1. Revenue Dynamics Chart
            const revenueCtx = document.getElementById('revenueChart').getContext('2d');
            
            // Create nice gradient for line chart
            const gradientFill = revenueCtx.createLinearGradient(0, 0, 0, 240);
            gradientFill.addColorStop(0, 'rgba(0, 184, 148, 0.25)'); // primary (Teal)
            gradientFill.addColorStop(1, 'rgba(0, 184, 148, 0.00)');

            new Chart(revenueCtx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($months) !!},
                    datasets: [{
                        label: 'Gross Settlement Volume (₹)',
                        data: {!! json_encode($monthlyRevenue) !!},
                        borderColor: '#00B894',
                        backgroundColor: gradientFill,
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointRadius: 4,
                        pointBackgroundColor: '#FF9F1C',
                        pointHoverRadius: 6,
                        pointHoverBackgroundColor: '#00B894'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            grid: { color: 'rgba(0, 184, 148, 0.04)' },
                            ticks: { color: '#94a3b8', font: { size: 10, weight: 'bold' } }
                        },
                        x: {
                            grid: { display: false },
                            ticks: { color: '#94a3b8', font: { size: 10, weight: 'bold' } }
                        }
                    }
                }
            });

            // 2. User Demographic Chart
            const userCtx = document.getElementById('userChart').getContext('2d');
            new Chart(userCtx, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($userRoles) !!},
                    datasets: [{
                        data: {!! json_encode($userCounts) !!},
                        backgroundColor: ['#00B894', '#FF9F1C', '#C97B63'],
                        borderWidth: 3,
                        borderColor: '#F8F5F0'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: { color: '#64748b', font: { size: 10, weight: 'bold' } }
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>
