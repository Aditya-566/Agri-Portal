<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <!-- Breadcrumb / Header -->
        <div class="mb-8">
            <a href="{{ route('farmer.products.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-600 dark:text-emerald-400 hover:underline mb-3">
                <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i> Back to My Crop Listings
            </a>
            <h1 class="font-heading font-extrabold text-2xl text-slate-900 dark:text-white flex items-center gap-2">
                <span class="p-1.5 bg-emerald-100 text-emerald-700 dark:bg-emerald-950/30 dark:text-emerald-400 rounded-xl">
                    <i data-lucide="pencil" class="w-5.5 h-5.5"></i>
                </span>
                Edit Crop Listing
            </h1>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Update your crop listing details, stock quantity, harvest date, status or replace the listing photo.</p>
        </div>

        <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-slate-800/80 shadow-md p-6 sm:p-8">
            <form method="POST" action="{{ route('farmer.products.update', $product->id) }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Grid Details -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Crop Name -->
                    <div>
                        <label for="name" class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-2 flex items-center gap-1">
                            <i data-lucide="tag" class="w-3.5 h-3.5 text-emerald-650"></i> Crop Name
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" placeholder="e.g., Organic Red Tomatoes" 
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-900 text-slate-900 dark:text-white text-xs font-medium focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all @error('name') border-rose-500 @enderror" required>
                        @error('name')
                            <span class="text-rose-500 text-[10px] mt-1 font-bold block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Category Select -->
                    <div>
                        <label for="category_id" class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-2 flex items-center gap-1">
                            <i data-lucide="layers" class="w-3.5 h-3.5 text-emerald-650"></i> Category
                        </label>
                        <select name="category_id" id="category_id" 
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-900 text-slate-900 dark:text-white text-xs font-medium focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all @error('category_id') border-rose-500 @enderror" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="text-rose-500 text-[10px] mt-1 font-bold block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div>
                        <label for="price" class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-2 flex items-center gap-1">
                            <i data-lucide="indian-rupee" class="w-3.5 h-3.5 text-emerald-650"></i> Price per kg (₹)
                        </label>
                        <input type="number" step="0.01" min="0.01" name="price" id="price" value="{{ old('price', $product->price) }}" placeholder="0.00" 
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-900 text-slate-900 dark:text-white text-xs font-medium focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all @error('price') border-rose-500 @enderror" required>
                        @error('price')
                            <span class="text-rose-500 text-[10px] mt-1 font-bold block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Stock Quantity -->
                    <div>
                        <label for="quantity" class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-2 flex items-center gap-1">
                            <i data-lucide="package" class="w-3.5 h-3.5 text-emerald-650"></i> Available Quantity (kg)
                        </label>
                        <input type="number" step="0.1" min="1" name="quantity" id="quantity" value="{{ old('quantity', $product->quantity) }}" placeholder="100.0" 
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-900 text-slate-900 dark:text-white text-xs font-medium focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all @error('quantity') border-rose-500 @enderror" required>
                        @error('quantity')
                            <span class="text-rose-500 text-[10px] mt-1 font-bold block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Location -->
                    <div>
                        <label for="location" class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-2 flex items-center gap-1">
                            <i data-lucide="map-pin" class="w-3.5 h-3.5 text-emerald-650"></i> Harvest Location
                        </label>
                        <input type="text" name="location" id="location" value="{{ old('location', $product->location) }}" placeholder="City, State" 
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-900 text-slate-900 dark:text-white text-xs font-medium focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all @error('location') border-rose-500 @enderror" required>
                        @error('location')
                            <span class="text-rose-500 text-[10px] mt-1 font-bold block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Harvest Date -->
                    <div>
                        <label for="harvest_date" class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-2 flex items-center gap-1">
                            <i data-lucide="calendar" class="w-3.5 h-3.5 text-emerald-650"></i> Harvest Date
                        </label>
                        <input type="date" name="harvest_date" id="harvest_date" value="{{ old('harvest_date', $product->harvest_date ? $product->harvest_date->format('Y-m-d') : '') }}" 
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-900 text-slate-900 dark:text-white text-xs font-medium focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all @error('harvest_date') border-rose-500 @enderror" required>
                        @error('harvest_date')
                            <span class="text-rose-500 text-[10px] mt-1 font-bold block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-2 flex items-center gap-1">
                        <i data-lucide="align-left" class="w-3.5 h-3.5 text-emerald-650"></i> Crop Description
                    </label>
                    <textarea name="description" id="description" rows="4" placeholder="Detail your crop quality, farming methods, freshness, pesticide usage, etc." 
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-900 text-slate-900 dark:text-white text-xs font-medium focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all @error('description') border-rose-500 @enderror" required>{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <span class="text-rose-500 text-[10px] mt-1 font-bold block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Status Select and Organic Checkbox -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Status Selection -->
                    <div>
                        <label for="status" class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-2 flex items-center gap-1">
                            <i data-lucide="activity" class="w-3.5 h-3.5 text-emerald-650"></i> Stock Status
                        </label>
                        <select name="status" id="status" 
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-900 text-slate-900 dark:text-white text-xs font-medium focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all @error('status') border-rose-500 @enderror" required>
                            <option value="available" {{ old('status', $product->status) === 'available' ? 'selected' : '' }}>In Stock / Available</option>
                            <option value="sold_out" {{ old('status', $product->status) === 'sold_out' ? 'selected' : '' }}>Sold Out / Unavailable</option>
                        </select>
                        @error('status')
                            <span class="text-rose-500 text-[10px] mt-1 font-bold block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Organic Checkbox -->
                    <div class="bg-emerald-50/50 dark:bg-emerald-950/10 border border-emerald-100/50 dark:border-emerald-900/30 p-4.5 rounded-2xl flex items-start gap-3">
                        <div class="flex items-center h-5 mt-0.5">
                            <input type="checkbox" name="is_organic" id="is_organic" value="1" {{ old('is_organic', $product->is_organic) ? 'checked' : '' }}
                                class="w-4 h-4 text-emerald-600 border-slate-300 dark:border-slate-700 rounded focus:ring-emerald-500 bg-white dark:bg-slate-900">
                        </div>
                        <div>
                            <label for="is_organic" class="text-xs font-bold text-emerald-800 dark:text-emerald-300 cursor-pointer flex items-center gap-1 select-none">
                                <i data-lucide="leaf" class="w-4 h-4 text-emerald-600 fill-emerald-500/10"></i> 100% Certified Organic Crop
                            </label>
                            <p class="text-[10px] text-slate-550 dark:text-slate-400 mt-0.5">Check this option if your crops are produced organically using eco-friendly fertilizing and farming methods.</p>
                        </div>
                    </div>
                </div>

                <!-- Crop Image Selection and current image view -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-2 flex items-center gap-1">
                        <i data-lucide="image" class="w-3.5 h-3.5 text-emerald-650"></i> Crop Image
                    </label>
                    <div class="flex items-center gap-4">
                        <div class="w-20 h-20 rounded-2xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-750 flex items-center justify-center text-slate-400 shrink-0 overflow-hidden" id="preview-container">
                            @if($product->image_path)
                                <img src="{{ asset('storage/' . $product->image_path) }}" id="preview-img" class="w-full h-full object-cover" />
                                <i data-lucide="sprout" class="w-8 h-8 text-emerald-600/30 hidden" id="preview-placeholder"></i>
                            @else
                                <img id="preview-img" class="w-full h-full object-cover hidden" />
                                <i data-lucide="sprout" class="w-8 h-8 text-emerald-600/30" id="preview-placeholder"></i>
                            @endif
                        </div>
                        <div class="flex-grow">
                            <input type="file" name="image" id="image" accept="image/*"
                                class="hidden" onchange="previewImage(this)">
                            <label for="image" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 dark:bg-slate-700 dark:hover:bg-slate-655 text-slate-700 dark:text-slate-200 text-xs font-bold rounded-xl cursor-pointer border border-slate-200 dark:border-slate-600 inline-block transition-colors">
                                Replace Image
                            </label>
                            <p class="text-[10px] text-slate-400 mt-1.5">Leave empty to keep current crop photo. Max file size: 2MB.</p>
                        </div>
                    </div>
                    @error('image')
                        <span class="text-rose-500 text-[10px] mt-1 font-bold block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit / Cancel -->
                <div class="flex items-center justify-end gap-3 border-t border-slate-100 dark:border-slate-750 pt-6">
                    <a href="{{ route('farmer.products.index') }}" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-250 dark:bg-slate-700 dark:hover:bg-slate-655 text-slate-700 dark:text-slate-200 font-bold text-xs rounded-xl transition-colors">
                        Cancel
                    </a>
                    <button type="submit" class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl shadow-md transition-all flex items-center gap-1.5 hover:-translate-y-0.5">
                        <i data-lucide="check" class="w-4 h-4"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Image Preview Script -->
    <script>
        function previewImage(input) {
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewImg = document.getElementById('preview-img');
                    const placeholder = document.getElementById('preview-placeholder');
                    previewImg.src = e.target.result;
                    previewImg.classList.remove('hidden');
                    if(placeholder) placeholder.classList.add('hidden');
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
</x-app-layout>
