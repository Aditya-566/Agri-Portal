<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Fair Trade Agri') }} - Direct Farmer Marketplace</title>

        <!-- Google Fonts: Sora, Outfit, and Inter -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&family=Outfit:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Lucide Icons CDN -->
        <script src="https://unpkg.com/lucide@latest"></script>

        <!-- Scripts & Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
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

        <div class="min-h-screen flex flex-col justify-center items-center py-12 px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="sm:mx-auto sm:w-full sm:max-w-md text-center">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 group">
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-[#00B894] to-[#FF9F1C] flex items-center justify-center text-white shadow-lg group-hover:scale-105 transition-all duration-200">
                        <i data-lucide="sprout" class="w-7 h-7"></i>
                    </div>
                    <span class="font-heading font-black text-2xl tracking-tight text-[#1E1E1E]">
                        Fair<span class="text-[#00B894]">Trade</span>
                    </span>
                </a>
            </div>

            <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
                <div class="glass-premium py-8 px-6 shadow-premium rounded-3xl border border-white/50 sm:px-10">
                    {{ $slot }}
                </div>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                lucide.createIcons();
            });
        </script>
    </body>
</html>
