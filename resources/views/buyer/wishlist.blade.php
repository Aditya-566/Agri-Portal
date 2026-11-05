<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <!-- Wishlist Header -->
        <div class="mb-8">
            <a href="{{ route('buyer.dashboard') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-600 dark:text-emerald-400 hover:underline mb-3">
                <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i> Back to Dashboard
            </a>
            <h1 class="font-heading font-extrabold text-2xl text-slate-900 dark:text-white flex items-center gap-2">
                <span class="p-1.5 bg-rose-50 text-rose-600 dark:bg-rose-950/20 dark:text-rose-400 rounded-xl">
                    <i data-lucide="heart" class="w-5.5 h-5.5 fill-rose-500/10"></i>
                </span>
                My Saved Crop Listings
            </h1>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Keep track of fresh crops and produce you want to monitor, compare, or buy later.</p>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-emerald-50 dark:bg-emerald-950/20 text-emerald-600 dark:text-emerald-400 text-xs font-semibold border border-emerald-100 dark:border-emerald-900/50 flex items-center gap-2">
                <i data-lucide="check-circle" class="w-4.5 h-4.5 shrink-0"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(!empty($products) && $products->count() > 0)
            <!-- Products Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($products as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>

            <!-- Pagination -->
            @if($products->hasPages())
                <div class="mt-8 bg-white dark:bg-slate-800 p-4 rounded-2xl border border-slate-100 dark:border-slate-800">
                    {{ $products->links() }}
                </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-slate-800/80 shadow-sm p-16 text-center max-w-xl mx-auto space-y-4">
                <div class="w-16 h-16 rounded-full bg-rose-50 dark:bg-rose-950/15 flex items-center justify-center mx-auto text-rose-600 border border-rose-100/50 dark:border-rose-900/30">
                    <i data-lucide="heart" class="w-8 h-8"></i>
                </div>
                <h3 class="font-heading font-bold text-slate-800 dark:text-white text-base">Your Wishlist is Empty</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed max-w-xs mx-auto">
                    You haven't saved any crops yet. Explore the marketplace to find fresh produce directly from local farmers and save them here.
                </p>
                <div class="pt-2">
                    <a href="{{ route('products.index') }}" class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl shadow-md transition-all inline-flex items-center gap-1.5 hover:-translate-y-0.5">
                        <i data-lucide="search" class="w-4 h-4"></i> Browse Products
                    </a>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
