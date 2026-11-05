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
                        <i data-lucide="tags" class="w-5.5 h-5.5"></i>
                    </span>
                    Crop Categories
                </h1>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Configure agricultural categories, classify crop types, and customize catalog browsing.</p>
            </div>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Left 1 Col: Create Category Form -->
            <div class="lg:col-span-1">
                <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-slate-800/80 shadow-sm p-6 space-y-6 sticky top-6">
                    <h3 class="font-heading font-extrabold text-slate-900 dark:text-white text-base pb-3 border-b border-slate-50 dark:border-slate-700/50 flex items-center gap-2">
                        <i data-lucide="plus-circle" class="w-5 h-5 text-emerald-650"></i>
                        Add New Category
                    </h3>

                    <form method="POST" action="{{ route('admin.categories.store') }}" class="space-y-4">
                        @csrf
                        
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-xs font-bold text-slate-500 dark:text-slate-450 uppercase mb-2">Category Name</label>
                            <input type="text" name="name" id="name" required placeholder="e.g. Vegetables, Grains, Fruits"
                                class="w-full px-4 py-2 bg-slate-50 dark:bg-slate-900 text-slate-850 dark:text-white border border-slate-205 dark:border-slate-700 rounded-xl text-xs focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 font-medium @error('name') border-rose-500 @enderror">
                            @error('name')
                                <p class="text-xs text-rose-500 font-semibold mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-xs font-bold text-slate-500 dark:text-slate-450 uppercase mb-2">Description</label>
                            <textarea name="description" id="description" rows="3" required placeholder="Describe what types of crops fall into this category..."
                                class="w-full px-4 py-2 bg-slate-50 dark:bg-slate-900 text-slate-850 dark:text-white border border-slate-205 dark:border-slate-700 rounded-xl text-xs focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 font-medium @error('description') border-rose-500 @enderror"></textarea>
                            @error('description')
                                <p class="text-xs text-rose-500 font-semibold mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Icon selection -->
                        <div>
                            <label for="icon" class="block text-xs font-bold text-slate-500 dark:text-slate-450 uppercase mb-2 font-heading">Lucide Icon name</label>
                            <div class="relative">
                                <select name="icon" id="icon" required class="w-full px-4 py-2 bg-slate-50 dark:bg-slate-900 text-slate-850 dark:text-white border border-slate-205 dark:border-slate-700 rounded-xl text-xs focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 font-medium">
                                    <option value="sprout">sprout (Vegetables/Seedlings)</option>
                                    <option value="wheat">wheat (Grains/Cereals)</option>
                                    <option value="grape">grape (Grapes/Berries)</option>
                                    <option value="citrus">citrus (Oranges/Lemons)</option>
                                    <option value="carrot">carrot (Root Vegetables)</option>
                                    <option value="nut">nut (Dry Fruits/Seeds)</option>
                                    <option value="coffee">coffee (Coffee/Beans)</option>
                                    <option value="leaf">leaf (Herbs/Foliage)</option>
                                    <option value="flower">flower (Floriculture/Plants)</option>
                                    <option value="package">package (Other/General)</option>
                                </select>
                            </div>
                            <p class="text-[10px] text-slate-400 mt-1.5">Select a Lucide icon representation. The selected icon is displayed dynamically in navigation/cards.</p>
                        </div>

                        <button type="submit" class="w-full py-2.5 bg-emerald-650 hover:bg-emerald-700 text-white font-extrabold text-xs rounded-xl shadow-sm hover:shadow transition-all flex items-center justify-center gap-1.5 mt-2">
                            <i data-lucide="check" class="w-4 h-4"></i>
                            Save Category
                        </button>
                    </form>
                </div>
            </div>

            <!-- Right 2 Cols: Categories List -->
            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-slate-800/80 shadow-sm p-6 space-y-6">
                    <h3 class="font-heading font-extrabold text-slate-900 dark:text-white text-base pb-3 border-b border-slate-50 dark:border-slate-700/50">
                        Active Categories List
                    </h3>

                    <div class="grid sm:grid-cols-2 gap-4">
                        @forelse($categories as $category)
                            <div class="p-4 rounded-2xl bg-slate-50/50 dark:bg-slate-900/20 border border-slate-100/50 dark:border-slate-750 flex flex-col justify-between gap-4 group hover:border-emerald-500/30 transition-all">
                                <div class="space-y-2">
                                    <div class="flex items-center gap-3">
                                        <div class="p-2 bg-emerald-50 dark:bg-emerald-950/20 text-emerald-600 dark:text-emerald-450 rounded-xl group-hover:scale-105 transition-transform duration-300">
                                            <i data-lucide="{{ $category->icon ?: 'sprout' }}" class="w-5 h-5"></i>
                                        </div>
                                        <div>
                                            <span class="block text-slate-900 dark:text-white font-extrabold text-sm">{{ $category->name }}</span>
                                            <span class="block text-[9px] font-mono text-slate-400 mt-0.5">/categories/{{ $category->slug }}</span>
                                        </div>
                                    </div>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed font-medium pt-1">
                                        {{ $category->description }}
                                    </p>
                                </div>

                                <div class="flex items-center justify-between border-t border-slate-100/50 dark:border-slate-750/50 pt-3 mt-auto">
                                    <span class="text-[10px] font-bold text-slate-450 uppercase flex items-center gap-1">
                                        <i data-lucide="package-open" class="w-3.5 h-3.5"></i>
                                        {{ $category->products()->count() }} Crops listed
                                    </span>

                                    <form method="POST" action="{{ route('admin.categories.destroy', $category->id) }}" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this category? (Will fail if category has active products)');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-950/20 border border-transparent hover:border-rose-100/30 dark:hover:border-rose-900/30 rounded-lg transition-all" title="Delete Category">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-2 text-center py-16 text-slate-400 dark:text-slate-655">
                                <div class="w-12 h-12 rounded-full bg-slate-50 dark:bg-slate-900 flex items-center justify-center mx-auto text-slate-400 mb-3 border border-slate-100 dark:border-slate-800">
                                    <i data-lucide="tags" class="w-6 h-6"></i>
                                </div>
                                <div class="font-bold text-slate-700 dark:text-slate-350">No categories found</div>
                                <p class="text-xs text-slate-450 mt-1 max-w-xs mx-auto">Click "Add New Category" to create a category grouping for agriculture products.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
