<div class="max-w-3xl mx-auto space-y-6">
    
    <!-- Page Header -->
    <div>
        <h1 class="text-2xl sm:text-3xl font-bold text-stone-900 tracking-tight">Create Task</h1>
        <p class="text-stone-500 text-xs sm:text-sm font-medium mt-1">Add a new academic task.</p>
    </div>

    <!-- Create Task Form Card -->
    <div class="bg-white rounded-3xl border border-stone-200/80 p-6 sm:p-8 shadow-2xs">
        <form wire:submit.prevent="saveTask" class="space-y-6">
            
            <!-- Title -->
            <div>
                <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider mb-2">
                    Title <span class="text-rose-600">*</span>
                </label>
                <input 
                    type="text" 
                    wire:model="title"
                    placeholder="Enter task title" 
                    class="w-full px-4 py-3 rounded-xl border border-stone-300 text-stone-900 text-sm focus:ring-eucalyptus-600 focus:border-eucalyptus-600 transition bg-stone-50/30"
                >
                @error('title') <span class="text-rose-600 text-xs mt-1.5 block font-medium">{{ $message }}</span> @enderror
            </div>

            <!-- Description -->
            <div>
                <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider mb-2">
                    Description
                </label>
                <textarea 
                    wire:model="description"
                    rows="4"
                    placeholder="Enter task description (optional)" 
                    class="w-full px-4 py-3 rounded-xl border border-stone-300 text-stone-900 text-sm focus:ring-eucalyptus-600 focus:border-eucalyptus-600 transition bg-stone-50/30"
                ></textarea>
                @error('description') <span class="text-rose-600 text-xs mt-1.5 block font-medium">{{ $message }}</span> @enderror
            </div>

            <!-- Category & Due Date Row -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider mb-2">
                        Category <span class="text-rose-600">*</span>
                    </label>
                    <select 
                        wire:model="category_id"
                        required
                        class="w-full px-4 py-3 rounded-xl border border-stone-300 text-stone-900 text-sm focus:ring-eucalyptus-600 focus:border-eucalyptus-600 transition bg-stone-50/30"
                    >
                        <option value="">Select category</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <span class="text-rose-600 text-xs mt-1.5 block font-medium">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider mb-2">
                        Due Date <span class="text-rose-600">*</span>
                    </label>
                    <input 
                        type="date" 
                        wire:model="due_date"
                        required
                        class="w-full px-4 py-3 rounded-xl border border-stone-300 text-stone-900 text-sm focus:ring-eucalyptus-600 focus:border-eucalyptus-600 transition bg-stone-50/30"
                    >
                    @error('due_date') <span class="text-rose-600 text-xs mt-1.5 block font-medium">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Status -->
            <div>
                <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider mb-2">
                    Status
                </label>
                <select 
                    wire:model="status"
                    class="w-full px-4 py-3 rounded-xl border border-stone-300 text-stone-900 text-sm focus:ring-eucalyptus-600 focus:border-eucalyptus-600 transition bg-stone-50/30"
                >
                    <option value="Pending">Pending</option>
                    <option value="Completed">Completed</option>
                </select>
                @error('status') <span class="text-rose-600 text-xs mt-1.5 block font-medium">{{ $message }}</span> @enderror
            </div>

            <!-- Reference Image Upload -->
            <div>
                <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider mb-2">
                    Reference Image <span class="text-stone-400 font-normal lowercase">(optional)</span>
                </label>
                
                <div class="border-2 border-dashed border-stone-300 hover:border-eucalyptus-500 rounded-2xl p-6 text-center transition bg-stone-50/50 relative">
                    <input 
                        type="file" 
                        wire:model="image"
                        accept="image/jpeg,image/png,image/jpg"
                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                    >
                    <div class="w-12 h-12 rounded-2xl bg-white border border-stone-200 text-stone-400 mx-auto flex items-center justify-center mb-2 shadow-2xs">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                    </div>
                    <p class="text-xs font-bold text-stone-700">Click to upload an image</p>
                    <p class="text-[11px] text-stone-400 mt-0.5">PNG, JPG, JPEG (Max 2MB)</p>
                </div>

                @error('image') <span class="text-rose-600 text-xs mt-1.5 block font-medium">{{ $message }}</span> @enderror

                @if ($image)
                    <div class="mt-3">
                        <p class="text-xs font-bold text-stone-600 mb-1">Image Preview:</p>
                        <img src="{{ $image->temporaryUrl() }}" class="h-28 rounded-2xl object-cover border border-stone-200 shadow-2xs">
                    </div>
                @endif
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-stone-100">
                <a 
                    href="{{ route('dashboard') }}" 
                    class="px-5 py-2.5 text-xs font-bold text-stone-700 bg-stone-100 hover:bg-stone-200 rounded-xl transition"
                >
                    Cancel
                </a>
                <button 
                    type="submit" 
                    class="px-6 py-2.5 text-xs font-bold text-white bg-eucalyptus-700 hover:bg-eucalyptus-800 rounded-xl shadow-xs transition"
                >
                    Save Task
                </button>
            </div>

        </form>
    </div>

</div>
