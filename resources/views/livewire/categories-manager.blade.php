<div class="space-y-6">
    
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-stone-900 tracking-tight">Categories</h1>
            <p class="text-stone-500 text-xs sm:text-sm font-medium mt-1">Manage your task categories.</p>
        </div>
    </div>

    <!-- Flash Message -->
    @if (session()->has('message'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-2xl text-xs sm:text-sm font-semibold shadow-2xs flex items-center gap-2.5">
            <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            {{ session('message') }}
        </div>
    @endif

    <!-- Add Category Form Card -->
    <div class="bg-white p-6 rounded-2xl border border-stone-200/80 shadow-2xs space-y-3">
        <h2 class="text-base font-bold text-stone-900">Add New Category</h2>
        <form wire:submit.prevent="createCategory" class="flex flex-col sm:flex-row gap-3 items-start">
            <div class="flex-1 w-full">
                <input 
                    type="text" 
                    wire:model="name"
                    placeholder="e.g. University, Study, Personal, Exams..." 
                    class="w-full px-4 py-2.5 rounded-xl border border-stone-300 text-stone-900 text-sm focus:ring-eucalyptus-600 focus:border-eucalyptus-600 transition"
                >
                @error('name') 
                    <span class="text-rose-600 text-xs mt-1 block font-medium">{{ $message }}</span> 
                @enderror
            </div>
            <button 
                type="submit" 
                class="w-full sm:w-auto bg-eucalyptus-700 hover:bg-eucalyptus-800 text-white font-bold text-xs sm:text-sm px-6 py-2.5 rounded-xl shadow-xs transition shrink-0"
            >
                + Add Category
            </button>
        </form>
    </div>

    <!-- Categories List Grid / Cards -->
    <div class="bg-white rounded-2xl border border-stone-200/80 shadow-2xs overflow-hidden">
        <div class="p-4 border-b border-stone-100 bg-stone-50/60 flex items-center justify-between">
            <h2 class="font-bold text-stone-900 text-sm">Your Categories ({{ count($categories) }})</h2>
        </div>

        @if ($categories->isEmpty())
            <div class="p-12 text-center text-stone-400 text-xs font-medium">
                No categories created yet. Add one above!
            </div>
        @else
            <div class="divide-y divide-stone-100">
                @foreach ($categories as $category)
                    <div class="p-4 sm:p-5 flex items-center justify-between hover:bg-stone-50/50 transition">
                        <div class="flex items-center gap-3.5">
                            <div class="w-10 h-10 rounded-xl bg-eucalyptus-50 text-eucalyptus-700 border border-eucalyptus-100 flex items-center justify-center font-bold">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 11h.01M7 15h.01M13 7h7M13 11h7M13 15h7M4 19h16a2 2 0 002-2V7a2 2 0 00-2-2H4a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-stone-900 text-sm">{{ $category->name }}</h3>
                                <p class="text-xs text-stone-500 font-medium">
                                    {{ $category->tasks_count }} {{ Str::plural('task', $category->tasks_count) }}
                                </p>
                            </div>
                        </div>

                        <!-- Delete Button -->
                        <button 
                            wire:click="deleteCategory({{ $category->id }})"
                            wire:confirm="Are you sure you want to delete this category?"
                            class="px-3.5 py-1.5 text-xs font-semibold text-rose-700 bg-rose-50 hover:bg-rose-100 rounded-xl transition border border-rose-200/80"
                        >
                            Delete
                        </button>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</div>
