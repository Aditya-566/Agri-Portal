<x-app-layout>
    <!-- Script for Charts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Ambient organic glowing light spots -->
    <div class="absolute top-20 left-10 w-80 h-80 blob-teal rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-40 right-20 w-96 h-96 blob-orange rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute inset-0 sunlight-ray opacity-45 pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 relative z-10">
        <!-- Dashboard Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
            <div>
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-black uppercase tracking-wider bg-primary/10 text-primary border border-primary/20 shadow-sm">
                    <i data-lucide="trending-up" class="w-3.5 h-3.5 text-primary"></i> APMC Live Index
                </span>
                <h1 class="font-heading font-black text-3xl text-charcoal mt-3 flex items-center gap-2">
                    Market Prices & Trends
                </h1>
                <p class="text-xs text-charcoal/70 mt-1">
                    Daily monitored wholesale market rates. Farmers can benchmark their listing prices against official fair-market values.
                </p>
            </div>
        </div>

        <!-- Search / Filter bar -->
        <div class="glass-premium rounded-3xl border border-white/50 shadow-premium p-6 mb-10">
            <form method="GET" action="{{ route('market-prices.index') }}" class="flex flex-col md:flex-row gap-4">
                <!-- Region Search -->
                <div class="flex-grow">
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-wider mb-2">Search Location</label>
                    <div class="relative">
                        <input type="text" name="region" value="{{ request('region') }}" placeholder="Search by region (e.g. Maharashtra, Punjab)..."
                            class="w-full pl-10 pr-4 py-3 bg-white/40 text-charcoal border border-primary/20 rounded-2xl text-xs focus:ring-2 focus:ring-primary focus:border-primary font-bold transition-all shadow-sm">
                        <span class="absolute left-3.5 top-3.5 text-primary">
                            <i data-lucide="map-pin" class="w-4 h-4"></i>
                        </span>
                    </div>
                </div>
                
                <!-- Category Select -->
                <div class="w-full md:w-64">
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-wider mb-2">Category Filter</label>
                    <div class="relative">
                        <select name="category" class="w-full pl-4 pr-10 py-3 bg-white/40 text-charcoal border border-primary/20 rounded-2xl text-xs focus:ring-2 focus:ring-primary focus:border-primary font-bold transition-all appearance-none cursor-pointer">
                            <option value="">All Categories</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                        <span class="absolute right-3.5 top-3.5 text-charcoal/40 pointer-events-none">
                            <i data-lucide="chevrons-up-down" class="w-4 h-4"></i>
                        </span>
                    </div>
                </div>

                <div class="flex items-end gap-2.5">
                    <button type="submit" class="h-[46px] px-6 bg-gradient-to-r from-primary to-forest hover:opacity-90 text-white font-black text-xs uppercase tracking-wider rounded-2xl shadow-md transition-all flex items-center gap-1.5">
                        <i data-lucide="filter" class="w-4 h-4"></i> Apply
                    </button>
                    <a href="{{ route('market-prices.index') }}" class="h-[46px] px-6 bg-white/60 hover:bg-white text-charcoal/80 border border-primary/15 rounded-2xl font-black text-xs uppercase tracking-wider transition-all flex items-center justify-center">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Prices Cards Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($prices as $price)
                @php
                    $change = 0;
                    if($price->prev_price > 0) {
                        $change = (($price->current_price - $price->prev_price) / $price->prev_price) * 100;
                    }
                    $isUp = $price->trend === 'up';
                    $isDown = $price->trend === 'down';
                    $isStable = $price->trend === 'stable';

                    // Pluck data for charts
                    $history = collect($price->price_history ?? []);
                    $dates = $history->pluck('date');
                    $rates = $history->pluck('price');
                @endphp
                <div class="glass-premium rounded-3xl border border-white/50 shadow-premium hover:-translate-y-1.5 hover:shadow-premium-hover hover:border-primary/30 transition-all duration-300 p-6 flex flex-col justify-between group">
                    <div class="space-y-5">
                        <!-- Card Header -->
                        <div class="flex items-start justify-between gap-3">
                            <div class="flex items-center gap-3">
                                <div class="p-3 bg-primary/10 text-primary rounded-2xl">
                                    <i data-lucide="{{ $price->category?->icon ?: 'sprout' }}" class="w-5 h-5"></i>
                                </div>
                                <div>
                                    <h3 class="font-heading font-black text-base text-charcoal group-hover:text-primary transition-colors">
                                        {{ $price->crop_name }}
                                    </h3>
                                    <span class="text-[10px] text-charcoal/50 font-bold uppercase tracking-wider block mt-0.5">
                                        <i data-lucide="map-pin" class="w-3 h-3 inline pb-0.5 text-primary"></i> {{ $price->region }}
                                    </span>
                                </div>
                            </div>

                            <!-- Trend Badge -->
                            <div>
                                @if($isUp)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[9px] font-black uppercase tracking-wider bg-primary/10 text-primary border border-primary/15">
                                        <i data-lucide="trending-up" class="w-3.5 h-3.5"></i> +{{ number_format($change, 1) }}%
                                    </span>
                                @elseif($isDown)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[9px] font-black uppercase tracking-wider bg-clay/10 text-clay border border-clay/15">
                                        <i data-lucide="trending-down" class="w-3.5 h-3.5"></i> {{ number_format($change, 1) }}%
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[9px] font-black uppercase tracking-wider bg-secondary/10 text-secondary border border-secondary/15">
                                        <i data-lucide="minus" class="w-3.5 h-3.5"></i> Stable
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Price Info -->
                        <div class="flex items-baseline justify-between border-b border-primary/5 pb-4">
                            <div>
                                <span class="text-3xl font-black font-heading text-charcoal">₹{{ number_format($price->current_price, 2) }}</span>
                                <span class="text-charcoal/60 text-xs font-black">/ kg</span>
                            </div>
                            <div class="text-right">
                                <span class="text-[8px] text-charcoal/50 block font-black uppercase tracking-wider">PREVIOUS RATE</span>
                                <span class="text-xs font-black text-charcoal/80 block">₹{{ number_format($price->prev_price ?: $price->current_price, 2) }}</span>
                            </div>
                        </div>

                        <!-- Mini Trend Canvas -->
                        @if($history->isNotEmpty())
                            <div class="space-y-2">
                                <span class="text-[8px] font-black text-charcoal/50 uppercase tracking-widest block font-mono">7-DAY TRADING RANGE</span>
                                <div class="h-28 relative">
                                    <canvas class="market-sparkline-chart"
                                            data-dates="{{ json_encode($dates) }}"
                                            data-prices="{{ json_encode($rates) }}"
                                            data-trend="{{ $price->trend }}"></canvas>
                                </div>
                            </div>
                        @else
                            <div class="h-28 flex items-center justify-center bg-charcoal/5 rounded-2xl border border-dashed border-primary/10">
                                <span class="text-[10px] text-charcoal/55 font-bold">Historical data unavailable</span>
                            </div>
                        @endif
                    </div>

                    <!-- Marketplace Quick-link -->
                    <div class="mt-5 pt-4 border-t border-primary/5 flex items-center justify-between">
                        <span class="text-[8px] text-charcoal/50 font-black uppercase tracking-wider">Benchmark reference</span>
                        <a href="{{ route('products.index', ['search' => $price->crop_name]) }}" class="text-[10px] font-black uppercase tracking-wider text-primary hover:text-forest hover:underline inline-flex items-center gap-0.5">
                            Browse Listings <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-16 glass-premium rounded-3xl border border-white/50 shadow-premium p-8">
                    <div class="w-16 h-16 rounded-full bg-primary/10 flex items-center justify-center mx-auto text-primary mb-4 border border-primary/15">
                        <i data-lucide="trending-up" class="w-8 h-8"></i>
                    </div>
                    <h3 class="font-heading font-black text-charcoal text-base">No Index Prices Found</h3>
                    <p class="text-xs text-charcoal/60 mt-1 max-w-xs mx-auto font-semibold">No market prices found matching your current filters or region searches.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Script to render sparkline charts -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const canvases = document.querySelectorAll('.market-sparkline-chart');
            canvases.forEach((canvas, index) => {
                const dates = JSON.parse(canvas.getAttribute('data-dates'));
                const prices = JSON.parse(canvas.getAttribute('data-prices'));
                const trend = canvas.getAttribute('data-trend');

                // Context setup
                const ctx = canvas.getContext('2d');
                
                // Beautiful linear gradient fills
                const chartGradient = ctx.createLinearGradient(0, 0, 0, 110);
                let strokeColor = '#FF9F1C'; // stable/orange by default
                
                if (trend === 'up') {
                    strokeColor = '#00B894'; // Emerald Teal
                    chartGradient.addColorStop(0, 'rgba(0, 184, 148, 0.18)');
                    chartGradient.addColorStop(1, 'rgba(0, 184, 148, 0.00)');
                } else if (trend === 'down') {
                    strokeColor = '#C97B63'; // Earth Clay
                    chartGradient.addColorStop(0, 'rgba(201, 123, 99, 0.18)');
                    chartGradient.addColorStop(1, 'rgba(201, 123, 99, 0.00)');
                } else {
                    strokeColor = '#FF9F1C'; // Warm Orange (Stable)
                    chartGradient.addColorStop(0, 'rgba(255, 159, 28, 0.18)');
                    chartGradient.addColorStop(1, 'rgba(255, 159, 28, 0.00)');
                }

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: dates,
                        datasets: [{
                            data: prices,
                            borderColor: strokeColor,
                            backgroundColor: chartGradient,
                            borderWidth: 2,
                            fill: true,
                            tension: 0.35,
                            pointRadius: 0,
                            pointHoverRadius: 4,
                            pointBackgroundColor: strokeColor,
                            pointBorderColor: '#ffffff',
                            pointBorderWidth: 1.5
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                enabled: true,
                                mode: 'index',
                                intersect: false,
                                backgroundColor: 'rgba(30, 30, 30, 0.85)',
                                titleColor: '#ffffff',
                                bodyColor: '#ffffff',
                                borderColor: 'rgba(0, 184, 148, 0.15)',
                                borderWidth: 1,
                                cornerRadius: 12,
                                padding: 8,
                                callbacks: {
                                    label: function(context) {
                                        return 'Rate: ₹' + context.parsed.y.toFixed(2) + ' / kg';
                                    }
                                },
                                titleFont: { size: 9, family: 'Outfit', weight: 'bold' },
                                bodyFont: { size: 9, family: 'Nunito', weight: 'bold' }
                            }
                        },
                        interaction: {
                            intersect: false,
                            mode: 'index',
                        },
                        scales: {
                            x: {
                                display: false // hide X axis labels
                            },
                            y: {
                                grid: {
                                    color: 'rgba(0, 184, 148, 0.03)'
                                },
                                border: {
                                    dash: [4, 4]
                                },
                                ticks: {
                                    color: '#888888',
                                    font: { size: 8, weight: 'bold' },
                                    maxTicksLimit: 3
                                }
                            }
                        }
                    }
                });
            });
        });
    </script>
</x-app-layout>ayout>
