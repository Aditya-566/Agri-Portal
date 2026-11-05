<x-app-layout>
    <!-- Script for Charts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Ambient organic glowing light spots -->
    <div class="absolute top-20 left-10 w-80 h-80 blob-teal rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-40 right-20 w-96 h-96 blob-orange rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute inset-0 sunlight-ray opacity-40 pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 relative z-10">
        <!-- Dashboard Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
            <div>
                <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl text-xs font-black uppercase tracking-wider bg-primary/10 text-primary border border-primary/20 shadow-sm">
                    <i data-lucide="shield-check" class="w-4 h-4 text-primary"></i> Smart Farming Control Center
                </span>
                <h1 class="font-heading font-black text-3xl text-charcoal mt-3 flex items-center gap-2">
                    Welcome back, {{ Auth::user()->name }}
                </h1>
                <p class="text-xs text-charcoal/70 mt-1">Manage listed crops, track buyer orders, monitor soil indices, and view earnings analytics.</p>
            </div>
            
            <div class="flex items-center gap-3">
                @if(auth()->user()->is_verified)
                    <span class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl text-xs font-extrabold uppercase tracking-wider bg-secondary/10 text-secondary border border-secondary/15 shadow-sm">
                        <i data-lucide="award" class="w-4 h-4 text-secondary animate-bounce"></i> Verified Gold Farmer
                    </span>
                @else
                    <span class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl text-xs font-extrabold uppercase tracking-wider bg-clay/10 text-clay border border-clay/15 shadow-sm" title="Verification Pending">
                        <i data-lucide="clock" class="w-4 h-4 text-clay animate-pulse"></i> Verification Pending
                    </span>
                @endif
            </div>
        </div>

        <!-- Main Dashboard Content Grid -->
        <div class="grid lg:grid-cols-12 gap-8">
            <!-- Left Side: Core Dashboard (Analytics & Tables) -->
            <div class="lg:col-span-9 space-y-8">
                <!-- Stats counters -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-6">
                    <!-- Total Earnings -->
                    <div class="glass-teal p-5 rounded-2xl border border-primary/20 shadow-premium flex items-center gap-4 hover:scale-[1.02] transition-all duration-300">
                        <div class="p-3 bg-primary/15 text-primary rounded-xl shrink-0">
                            <i data-lucide="wallet" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <span class="text-[9px] uppercase font-black text-charcoal/50 tracking-wider block">Total Earnings</span>
                            <span class="text-xl font-black text-charcoal mt-1 block">₹{{ number_format($totalEarnings, 2) }}</span>
                        </div>
                    </div>

                    <!-- Listed Crops -->
                    <div class="glass-premium p-5 rounded-2xl border border-white/50 shadow-premium flex items-center gap-4 hover:scale-[1.02] transition-all duration-300">
                        <div class="p-3 bg-primary/10 text-primary rounded-xl shrink-0">
                            <i data-lucide="sprout" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <span class="text-[9px] uppercase font-black text-charcoal/50 tracking-wider block">Listed Crops</span>
                            <span class="text-xl font-black text-charcoal mt-1 block">{{ $totalProducts }} varieties</span>
                        </div>
                    </div>

                    <!-- Active Orders -->
                    <div class="glass-orange p-5 rounded-2xl border border-secondary/20 shadow-premium flex items-center gap-4 hover:scale-[1.02] transition-all duration-300">
                        <div class="p-3 bg-secondary/15 text-secondary rounded-xl shrink-0">
                            <i data-lucide="shopping-bag" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <span class="text-[9px] uppercase font-black text-charcoal/50 tracking-wider block">Active Orders</span>
                            <span class="text-xl font-black text-charcoal mt-1 block">{{ $activeOrdersCount }} pending</span>
                        </div>
                    </div>

                    <!-- Completed Sales -->
                    <div class="glass-premium p-5 rounded-2xl border border-white/50 shadow-premium flex items-center gap-4 hover:scale-[1.02] transition-all duration-300">
                        <div class="p-3 bg-primary/10 text-primary rounded-xl shrink-0">
                            <i data-lucide="check-circle" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <span class="text-[9px] uppercase font-black text-charcoal/50 tracking-wider block">Completed Sales</span>
                            <span class="text-xl font-black text-charcoal mt-1 block">{{ $completedOrdersCount }} orders</span>
                        </div>
                    </div>
                </div>

                <!-- Quick actions grid -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    <a href="{{ route('farmer.products.create') }}" class="p-5 rounded-3xl glass-premium border border-white/40 hover:border-primary/50 hover:bg-white shadow-premium-hover flex flex-col items-center justify-center text-center transition-all group">
                        <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center mb-2.5 group-hover:scale-110 transition-transform">
                            <i data-lucide="plus-circle" class="w-5 h-5"></i>
                        </div>
                        <span class="text-xs font-black text-charcoal uppercase tracking-wider">Add Crop Listing</span>
                    </a>
                    <a href="{{ route('farmer.products.index') }}" class="p-5 rounded-3xl glass-premium border border-white/40 hover:border-primary/50 hover:bg-white shadow-premium-hover flex flex-col items-center justify-center text-center transition-all group">
                        <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center mb-2.5 group-hover:scale-110 transition-transform">
                            <i data-lucide="folder-git" class="w-5 h-5"></i>
                        </div>
                        <span class="text-xs font-black text-charcoal uppercase tracking-wider">Manage Listings</span>
                    </a>
                    <a href="{{ route('farmer.orders.index') }}" class="p-5 rounded-3xl glass-premium border border-white/40 hover:border-primary/50 hover:bg-white shadow-premium-hover flex flex-col items-center justify-center text-center transition-all group">
                        <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center mb-2.5 group-hover:scale-110 transition-transform">
                            <i data-lucide="shopping-cart" class="w-5 h-5"></i>
                        </div>
                        <span class="text-xs font-black text-charcoal uppercase tracking-wider">Orders List</span>
                    </a>
                    <a href="{{ route('ai-recommendations.index') }}" class="p-5 rounded-3xl glass-premium border border-white/40 hover:border-primary/50 hover:bg-white shadow-premium-hover flex flex-col items-center justify-center text-center transition-all group">
                        <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center mb-2.5 group-hover:scale-110 transition-transform">
                            <i data-lucide="sparkles" class="w-5 h-5"></i>
                        </div>
                        <span class="text-xs font-black text-charcoal uppercase tracking-wider">AI Crop Advisor</span>
                    </a>
                </div>

                <!-- Interactive Charts Grid -->
                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Chart 1: Monthly Earnings -->
                    <div class="p-6 glass-premium rounded-3xl border border-white/50 shadow-premium space-y-4">
                        <div class="flex items-center justify-between">
                            <h3 class="font-heading font-extrabold text-charcoal text-base">Monthly Earnings</h3>
                            <span class="p-1.5 rounded-xl bg-primary/10 text-primary"><i data-lucide="trending-up" class="w-4 h-4"></i></span>
                        </div>
                        <div class="h-64 relative">
                            <canvas id="earningsChart"></canvas>
                        </div>
                    </div>

                    <!-- Chart 2: Inventory Breakdown -->
                    <div class="p-6 glass-premium rounded-3xl border border-white/50 shadow-premium space-y-4">
                        <div class="flex items-center justify-between">
                            <h3 class="font-heading font-extrabold text-charcoal text-base">Crop Inventory Distribution</h3>
                            <span class="p-1.5 rounded-xl bg-primary/10 text-primary"><i data-lucide="pie-chart" class="w-4 h-4"></i></span>
                        </div>
                        <div class="h-64 relative">
                            <canvas id="inventoryChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Recent orders table -->
                <div class="p-6 glass-premium rounded-3xl border border-white/50 shadow-premium space-y-4">
                    <div class="flex items-center justify-between border-b border-primary/10 pb-4">
                        <div class="flex items-center gap-2">
                            <i data-lucide="shopping-bag" class="w-5 h-5 text-primary"></i>
                            <h3 class="font-heading font-extrabold text-charcoal text-base">Recent Orders Received</h3>
                        </div>
                        <a href="{{ route('farmer.orders.index') }}" class="text-xs font-bold text-primary hover:underline uppercase tracking-wider">View All Orders</a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs border-collapse">
                            <thead>
                                <tr class="border-b border-primary/5 text-charcoal/40 font-bold uppercase tracking-wider">
                                    <th class="py-3.5 px-4">Order ID</th>
                                    <th class="py-3.5 px-4">Buyer</th>
                                    <th class="py-3.5 px-4">Total Amount</th>
                                    <th class="py-3.5 px-4">Status</th>
                                    <th class="py-3.5 px-4">Date</th>
                                    <th class="py-3.5 px-4 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-primary/5 font-semibold text-charcoal/80">
                                @forelse($recentOrders as $order)
                                    <tr class="hover:bg-white/40 transition-colors">
                                        <td class="py-3.5 px-4 font-mono font-bold text-charcoal">#{{ substr($order->id, -6) }}</td>
                                        <td class="py-3.5 px-4">{{ $order->buyer?->name ?? 'Direct Buyer' }}</td>
                                        <td class="py-3.5 px-4 font-black text-charcoal">₹{{ number_format($order->total_amount, 2) }}</td>
                                        <td class="py-3.5 px-4">
                                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-xl text-[10px] font-black uppercase tracking-wider {{ $order->status === 'completed' ? 'bg-primary/10 text-primary border border-primary/20' : ($order->status === 'pending' ? 'bg-secondary/10 text-secondary border border-secondary/20' : ($order->status === 'accepted' ? 'bg-blue-500/10 text-blue-600 border border-blue-500/20' : 'bg-slate-500/10 text-slate-500 border border-slate-500/20')) }}">
                                                {{ $order->status }}
                                            </span>
                                        </td>
                                        <td class="py-3.5 px-4 text-charcoal/60">{{ $order->created_at->format('M d, Y') }}</td>
                                        <td class="py-3.5 px-4 text-right">
                                            <a href="{{ route('farmer.orders.show', $order->id) }}" class="inline-flex items-center gap-1.5 px-3 py-2 bg-white/80 border border-primary/10 hover:border-primary text-charcoal font-extrabold text-xs uppercase tracking-wider rounded-xl transition-all shadow-sm">
                                                Details <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-primary"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="py-12 text-center text-charcoal/40">
                                            <div class="flex flex-col items-center justify-center space-y-2">
                                                <i data-lucide="search-code" class="w-8 h-8 text-primary/40"></i>
                                                <p class="text-sm">No orders received yet.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Right Side: Sidebar Widgets -->
            <div class="lg:col-span-3 space-y-8">
                <!-- Soil & Farm Health Widget -->
                <div class="p-6 glass-premium rounded-3xl border border-white/50 shadow-premium space-y-5">
                    <h3 class="font-heading font-extrabold text-charcoal text-base flex items-center gap-1.5">
                        <i data-lucide="activity" class="w-5 h-5 text-primary"></i> Farm Soil Index
                    </h3>
                    
                    <div class="space-y-4">
                        <div class="p-3.5 rounded-2xl bg-white/40 border border-primary/5">
                            <div class="flex justify-between items-center text-xs">
                                <span class="text-charcoal/60 font-bold">Soil Moisture</span>
                                <span class="text-primary font-black">68% (Optimal)</span>
                            </div>
                            <div class="w-full bg-cream h-2 rounded-full mt-2 overflow-hidden border border-primary/5">
                                <div class="bg-primary h-2 rounded-full" style="width: 68%"></div>
                            </div>
                        </div>

                        <div class="p-3.5 rounded-2xl bg-white/40 border border-primary/5">
                            <div class="flex justify-between items-center text-xs">
                                <span class="text-charcoal/60 font-bold">Soil pH</span>
                                <span class="text-secondary font-black">6.4 (Slightly Acidic)</span>
                            </div>
                            <div class="w-full bg-cream h-2 rounded-full mt-2 overflow-hidden border border-primary/5">
                                <div class="bg-secondary h-2 rounded-full" style="width: 64%"></div>
                            </div>
                        </div>

                        <div class="p-3.5 rounded-2xl bg-white/40 border border-primary/5">
                            <div class="flex justify-between items-center text-xs">
                                <span class="text-charcoal/60 font-bold">Organic Nitrogen (N)</span>
                                <span class="text-clay font-black">82% (Excellent)</span>
                            </div>
                            <div class="w-full bg-cream h-2 rounded-full mt-2 overflow-hidden border border-primary/5">
                                <div class="bg-clay h-2 rounded-full" style="width: 82%"></div>
                            </div>
                        </div>
                    </div>
                    
                    <span class="block text-[10px] text-center text-charcoal/40 font-bold uppercase tracking-wider">Indexed from regional sensors</span>
                </div>

                <!-- Weather Insight Card -->
                <div class="p-6 glass-premium rounded-3xl border border-white/50 shadow-premium space-y-4">
                    <h3 class="font-heading font-extrabold text-charcoal text-base flex items-center gap-1.5">
                        <i data-lucide="cloud-sun" class="w-5 h-5 text-primary"></i> Harvest Weather
                    </h3>

                    <div class="p-5 rounded-2xl bg-gradient-to-tr from-primary to-secondary text-white space-y-3 shadow-premium relative overflow-hidden group">
                        <div class="absolute inset-0 bg-white/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="flex justify-between items-center relative z-10">
                            <div>
                                <span class="text-[9px] uppercase font-black text-white/80">Live Forecast</span>
                                <h4 class="font-heading font-black text-2xl">31&deg;C</h4>
                                <span class="text-xs font-bold text-white/90">Partly Cloudy • Dry</span>
                            </div>
                            <i data-lucide="sun" class="w-12 h-12 text-white/90 animate-spin" style="animation-duration: 20s"></i>
                        </div>
                        <div class="border-t border-white/20 pt-2 flex justify-between text-[10px] text-white/80 relative z-10">
                            <span>Humidity: 45%</span>
                            <span>Rain Chance: 10%</span>
                        </div>
                    </div>

                    <a href="{{ route('weather.index') }}" class="block text-center py-2.5 text-xs font-extrabold text-primary bg-primary/5 hover:bg-primary/10 rounded-2xl transition-colors">
                        Detailed Meteorological Advisory &rarr;
                    </a>
                </div>

                <!-- AI Recommendations Preview Widget -->
                <div class="p-6 glass-premium rounded-3xl border border-white/50 shadow-premium space-y-4 relative overflow-hidden">
                    <div class="absolute inset-0 bg-primary/5 animate-pulse-slow"></div>
                    <div class="relative z-10 space-y-3">
                        <h3 class="font-heading font-extrabold text-charcoal text-base flex items-center gap-1.5">
                            <i data-lucide="sparkles" class="w-5 h-5 text-primary"></i> AI Crop Suggestions
                        </h3>
                        <p class="text-xs text-charcoal/60 font-medium">
                            Based on your region's historical soil temperature and moisture parameters.
                        </p>
                        
                        <div class="p-3.5 rounded-2xl bg-white/40 border border-primary/5 flex items-center justify-between text-xs">
                            <span class="font-bold text-charcoal/70">Next Crop suggestion</span>
                            <span class="font-extrabold text-primary bg-primary/10 px-2.5 py-1 rounded-xl">Millet / Rabi crops</span>
                        </div>
                        
                        <a href="{{ route('ai-recommendations.index') }}" class="block text-center py-2.5 text-xs font-extrabold text-primary bg-primary/5 hover:bg-primary/10 rounded-2xl transition-colors">
                            Analyze Soil Health &rarr;
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart JS Setup Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // 1. Earnings Line Chart
            const earningsCtx = document.getElementById('earningsChart').getContext('2d');
            new Chart(earningsCtx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($months) !!},
                    datasets: [{
                        label: 'Earnings (₹)',
                        data: {!! json_encode($monthlyEarnings) !!},
                        borderColor: '#00B894',
                        backgroundColor: 'rgba(0, 184, 148, 0.06)',
                        borderWidth: 3.5,
                        fill: true,
                        tension: 0.35,
                        pointRadius: 5,
                        pointBackgroundColor: '#FF9F1C',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2
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
                            ticks: { color: '#888888', font: { size: 10, weight: 'bold' } }
                        },
                        x: {
                            grid: { display: false },
                            ticks: { color: '#888888', font: { size: 10, weight: 'bold' } }
                        }
                    }
                }
            });

            // 2. Inventory Bar/Doughnut Chart
            const inventoryCtx = document.getElementById('inventoryChart').getContext('2d');
            const cropNames = {!! json_encode($cropNames) !!};
            const cropQuantities = {!! json_encode($cropQuantities) !!};

            if(cropNames.length === 0) {
                inventoryCtx.font = "14px Outfit";
                inventoryCtx.fillStyle = "#94a3b8";
                inventoryCtx.textAlign = "center";
                inventoryCtx.fillText("No crop inventory listed to analyze.", 150, 100);
            } else {
                new Chart(inventoryCtx, {
                    type: 'doughnut',
                    data: {
                        labels: cropNames,
                        datasets: [{
                            data: cropQuantities,
                            backgroundColor: [
                                '#00B894', '#FF9F1C', '#C97B63', '#4F6F52', '#D6F0FF', '#FFF3D6'
                            ],
                            borderWidth: 3,
                            borderColor: 'rgba(255, 255, 255, 0.8)'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'right',
                                labels: { color: '#888888', font: { size: 10, weight: 'bold' } }
                            }
                        }
                    }
                });
            }
        });
    </script>
</x-app-layout>
