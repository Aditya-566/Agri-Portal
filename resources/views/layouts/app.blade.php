<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Fair Trade Agri') }} - Smart Farming & Organic Marketplace</title>

        <!-- Google Fonts: Sora, Outfit, and Inter -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&family=Outfit:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Lucide Icons CDN -->
        <script src="https://unpkg.com/lucide@latest"></script>

        <!-- SweetAlert2 CDN -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- Scripts & Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            [x-cloak] { display: none !important; }
            body {
                font-family: 'Inter', sans-serif;
            }
            h1, h2, h3, h4, h5, h6, .font-heading {
                font-family: 'Sora', 'Outfit', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased min-h-screen text-[#1E1E1E] bg-[#F8F5F0] relative overflow-x-hidden farming-grid grain-overlay">
        
        <!-- Cinematic Sunlight Ray Overlay -->
        <div class="absolute inset-0 sunlight-ray pointer-events-none z-0"></div>

        <!-- Ambient Blurred Elements -->
        <div class="absolute top-[-10%] left-[-10%] w-[50%] h-[50%] rounded-full blob-teal animate-pulse-slow pointer-events-none z-0"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[50%] h-[50%] rounded-full blob-orange animate-pulse-slow pointer-events-none z-0" style="animation-delay: 4s"></div>
        <div class="absolute top-[40%] right-[10%] w-[30%] h-[40%] rounded-full blob-sky animate-pulse-slow pointer-events-none z-0" style="animation-delay: 2s"></div>

        <!-- Floating leaf patterns -->
        <div class="absolute top-[15%] right-[5%] text-[#00B894]/10 animate-float-slow pointer-events-none z-0">
            <svg class="w-16 h-16 transform rotate-45" fill="currentColor" viewBox="0 0 24 24"><path d="M17,8C8,10 5.9,16.17 3.82,21.34L5.71,22L6.58,20C9,20.28 14.86,18.88 17.5,16C21,12.23 21.75,4 21.75,4C21.75,4 14,3 10.25,6.5C7.43,9.11 6,15 6,17.5L5.71,17.5C7.79,12.33 10,8 17,8Z"/></svg>
        </div>
        <div class="absolute bottom-[20%] left-[5%] text-[#4F6F52]/10 animate-float-medium pointer-events-none z-0" style="animation-delay: 3s">
            <svg class="w-12 h-12 transform -rotate-12" fill="currentColor" viewBox="0 0 24 24"><path d="M17,8C8,10 5.9,16.17 3.82,21.34L5.71,22L6.58,20C9,20.28 14.86,18.88 17.5,16C21,12.23 21.75,4 21.75,4C21.75,4 14,3 10.25,6.5C7.43,9.11 6,15 6,17.5L5.71,17.5C7.79,12.33 10,8 17,8Z"/></svg>
        </div>

        <div class="min-h-screen flex flex-col relative z-10">
            @include('layouts.navigation')

            <!-- Page Heading (with spacing for fixed navbar) -->
            @isset($header)
                <header class="pt-28 pb-6 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 z-30">
                    <div class="glass-premium rounded-3xl p-5 border border-white/40 shadow-premium flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="p-3 rounded-2xl bg-[#00B894]/10 text-[#00B894]">
                                <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                            </span>
                            <div>
                                <h1 class="font-heading font-black text-2xl text-[#1E1E1E]">
                                    {{ $header }}
                                </h1>
                            </div>
                        </div>
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-grow pt-24 @isset($header) pt-0 @endisset">
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="bg-gradient-to-br from-[#4F6F52] via-[#2A3E30] to-[#1E1E1E] text-white border-t border-white/10 py-16 relative overflow-hidden mt-20">
                <div class="absolute inset-0 opacity-5 pointer-events-none farming-grid"></div>
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                        <div class="space-y-4">
                            <a href="{{ route('home') }}" class="flex items-center gap-2">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#00B894] to-[#FF9F1C] text-white flex items-center justify-center shadow-lg">
                                    <i data-lucide="sprout" class="w-6 h-6"></i>
                                </div>
                                <span class="font-heading font-black text-xl tracking-tight text-white">
                                    AGRI<span class="text-[#00B894]">PORTAL</span>
                                </span>
                            </a>
                            <p class="text-sm text-white/70 leading-relaxed font-medium">
                                A next-generation smart farming and organic digital marketplace. Connecting verified Indian growers directly with buyers.
                            </p>
                        </div>
                        <div>
                            <h4 class="font-heading font-black text-white mb-5 uppercase tracking-wider text-xs">Platform</h4>
                            <ul class="space-y-3 text-sm text-white/70">
                                <li><a href="{{ route('products.index') }}" class="hover:text-[#00B894] transition-colors">Marketplace</a></li>
                                <li><a href="{{ route('market-prices.index') }}" class="hover:text-[#00B894] transition-colors">Market Rates</a></li>
                                <li><a href="{{ route('ai-recommendations.index') }}" class="hover:text-[#00B894] transition-colors">Smart Advisor</a></li>
                                <li><a href="{{ route('weather.index') }}" class="hover:text-[#00B894] transition-colors">Agri Weather</a></li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="font-heading font-black text-white mb-5 uppercase tracking-wider text-xs">Empowerment</h4>
                            <ul class="space-y-3 text-sm text-white/70">
                                <li><a href="{{ route('about') }}" class="hover:text-[#00B894] transition-colors">Our Vision</a></li>
                                <li><a href="{{ route('contact') }}" class="hover:text-[#00B894] transition-colors">Contact Support</a></li>
                                <li><span class="text-[#00B894] font-extrabold flex items-center gap-1"><i data-lucide="sparkles" class="w-3.5 h-3.5 text-[#FF9F1C]"></i> 0% Middlemen Fees</span></li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="font-heading font-black text-white mb-5 uppercase tracking-wider text-xs">Join the Movement</h4>
                            <p class="text-sm text-white/70 mb-5 leading-relaxed font-medium">
                                Support local organic growers and experience sustainable farm-to-table delivery.
                            </p>
                            <div class="flex gap-2">
                                <a href="{{ route('register') }}" class="px-5 py-2.5 bg-[#00B894] hover:bg-[#02d4ab] text-white font-extrabold text-xs uppercase tracking-wider rounded-xl shadow-md transition-all">
                                    Get Started
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="border-t border-white/10 pt-8 text-center text-xs text-white/40 flex flex-col sm:flex-row justify-between gap-4 items-center">
                        <p>&copy; {{ date('Y') }} Fair Trade Agri-Portal. Empowering Farmers, Promoting Sustainability.</p>
                        <div class="flex gap-4 text-white/40">
                            <span class="flex items-center gap-1"><i data-lucide="shield-check" class="w-3.5 h-3.5 text-[#00B894]"></i> Indian Organic Standard</span>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                lucide.createIcons();
            });
            window.addEventListener('content-changed', () => {
                lucide.createIcons();
            });
        </script>
    </body>
</html>
