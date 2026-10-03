<div class="space-y-6">
    
    <!-- Page Header & Action Button -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-stone-900 tracking-tight">Dashboard</h1>
            <p class="text-stone-500 text-xs sm:text-sm font-medium mt-1">Here's a quick overview of your academic tasks.</p>
        </div>

        <a 
            href="{{ route('tasks.create') }}"
            class="bg-eucalyptus-700 hover:bg-eucalyptus-800 text-white font-bold text-xs sm:text-sm px-5 py-2.5 rounded-xl shadow-xs transition flex items-center justify-center gap-2 shrink-0 self-start sm:self-auto"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
            + Add Task
        </a>
    </div>

    <!-- Daily Motivational Quote Banner (External API Integration) -->
    <div class="bg-gradient-to-r from-eucalyptus-800 to-eucalyptus-700 text-white p-5 sm:p-6 rounded-3xl shadow-xs border border-eucalyptus-900/40 relative overflow-hidden flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div class="space-y-1.5 max-w-2xl z-10">
            <div class="flex items-center gap-2">
                <span class="bg-white/15 text-eucalyptus-100 text-[10px] font-extrabold uppercase tracking-wider px-2.5 py-0.5 rounded-full border border-white/20">
                    Daily Motivation
                </span>
            </div>
            <p class="text-sm sm:text-base font-semibold text-white italic leading-relaxed">
                "{{ $quote }}"
            </p>
            <p class="text-xs font-medium text-eucalyptus-200">
                — {{ $author }}
            </p>
        </div>

        <button 
            wire:click="loadMotivationalQuote" 
            wire:loading.attr="disabled"
            class="shrink-0 bg-white/10 hover:bg-white/20 text-white font-bold text-xs px-3.5 py-2 rounded-xl border border-white/20 transition flex items-center gap-1.5 self-end sm:self-auto"
            title="Fetch a new quote from external API"
        >
            <svg class="w-3.5 h-3.5" wire:loading.class="animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
            <span>New Quote</span>
        </button>
    </div>

    <!-- Flash Message -->
    @if (session()->has('message'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-2xl text-xs sm:text-sm font-semibold shadow-2xs flex items-center gap-2.5">
            <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            {{ session('message') }}
        </div>
    @endif

    <!-- 3 Summary Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-5">
        <!-- Total Tasks -->
        <div class="bg-white p-5 rounded-2xl border border-stone-200/80 shadow-2xs flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 border border-blue-100 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                </div>
                <div>
                    <p class="text-xs font-bold text-stone-400 uppercase tracking-wider">Total Tasks</p>
                    <p class="text-2xl sm:text-3xl font-bold text-stone-900 mt-0.5">{{ $totalTasks }}</p>
                </div>
            </div>
        </div>

        <!-- Pending Tasks -->
        <div class="bg-white p-5 rounded-2xl border border-stone-200/80 shadow-2xs flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 border border-amber-100 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <p class="text-xs font-bold text-amber-700 uppercase tracking-wider">Pending Tasks</p>
                    <p class="text-2xl sm:text-3xl font-bold text-stone-900 mt-0.5">{{ $pendingTasks }}</p>
                </div>
            </div>
        </div>

        <!-- Completed Tasks -->
        <div class="bg-white p-5 rounded-2xl border border-stone-200/80 shadow-2xs flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 border border-emerald-100 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <div>
                    <p class="text-xs font-bold text-emerald-700 uppercase tracking-wider">Completed Tasks</p>
                    <p class="text-2xl sm:text-3xl font-bold text-stone-900 mt-0.5">{{ $completedTasks }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Tabs Row -->
    <div class="bg-white p-3 rounded-2xl border border-stone-200/80 shadow-2xs flex items-center justify-between gap-4">
        <div class="flex items-center gap-2 w-full sm:w-auto overflow-x-auto">
            <button 
                wire:click="$set('filter', 'all')"
                class="px-4 py-2 text-xs font-bold rounded-xl transition shrink-0 {{ $filter === 'all' ? 'bg-eucalyptus-700 text-white shadow-2xs' : 'text-stone-600 hover:bg-stone-100' }}"
            >
                All ({{ $totalTasks }})
            </button>
            <button 
                wire:click="$set('filter', 'pending')"
                class="px-4 py-2 text-xs font-bold rounded-xl transition shrink-0 {{ $filter === 'pending' ? 'bg-amber-600 text-white shadow-2xs' : 'text-stone-600 hover:bg-stone-100' }}"
            >
                Pending ({{ $pendingTasks }})
            </button>
            <button 
                wire:click="$set('filter', 'completed')"
                class="px-4 py-2 text-xs font-bold rounded-xl transition shrink-0 {{ $filter === 'completed' ? 'bg-emerald-600 text-white shadow-2xs' : 'text-stone-600 hover:bg-stone-100' }}"
            >
                Completed ({{ $completedTasks }})
            </button>
        </div>
    </div>

    <!-- Task Cards List -->
    @if ($tasks->isEmpty())
        <div class="bg-white rounded-2xl border border-stone-200/80 p-12 text-center shadow-2xs space-y-3">
            <div class="w-14 h-14 mx-auto rounded-2xl bg-stone-100 border border-stone-200 flex items-center justify-center text-stone-400">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
            </div>
            <div>
                <h3 class="text-base font-bold text-stone-900">No tasks found</h3>
                <p class="text-stone-500 text-xs mt-1">No tasks matching your current search or filter.</p>
            </div>
            <a 
                href="{{ route('tasks.create') }}"
                class="inline-flex items-center text-xs font-bold text-eucalyptus-700 hover:text-eucalyptus-900 hover:underline pt-2"
            >
                + Create your first task
            </a>
        </div>
    @else
        <div class="space-y-4">
            @foreach ($tasks as $task)
                <div class="bg-white p-5 rounded-2xl border border-stone-200/80 shadow-2xs flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 hover:border-eucalyptus-300 transition">
                    
                    <!-- Left: Reference Thumbnail + Info -->
                    <div class="flex items-start gap-4 flex-1 min-w-0">
                        <!-- Image Thumbnail -->
                        <div class="w-16 h-16 rounded-xl bg-stone-100 border border-stone-200 overflow-hidden shrink-0 flex items-center justify-center">
                            @if ($task->image_path)
                                <a href="{{ Storage::url($task->image_path) }}" target="_blank" title="View image">
                                    <img src="{{ Storage::url($task->image_path) }}" alt="{{ $task->title }}" class="w-full h-full object-cover">
                                </a>
                            @else
                                <svg class="w-6 h-6 text-stone-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            @endif
                        </div>

                        <!-- Task Details -->
                        <div class="space-y-1 min-w-0">
                            <div class="flex items-center gap-2 flex-wrap">
                                <h3 class="font-bold text-stone-900 text-base leading-snug {{ $task->status === 'Completed' ? 'line-through text-stone-400' : '' }}">
                                    {{ $task->title }}
                                </h3>
                                @if ($task->category)
                                    <span class="bg-blue-50 text-blue-700 text-xs font-semibold px-2.5 py-0.5 rounded-lg border border-blue-100">
                                        {{ $task->category->name }}
                                    </span>
                                @else
                                    <span class="bg-stone-100 text-stone-600 text-xs font-medium px-2.5 py-0.5 rounded-lg">
                                        General
                                    </span>
                                @endif
                            </div>

                            @if ($task->description)
                                <p class="text-stone-500 text-xs line-clamp-2 leading-relaxed">
                                    {{ $task->description }}
                                </p>
                            @endif

                            <div class="flex items-center gap-3 text-xs text-stone-400 font-medium pt-1">
                                <span class="flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('d M Y') : 'No due date' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Status Badge & Action Buttons -->
                    <div class="flex items-center justify-between sm:justify-end gap-3 w-full sm:w-auto pt-3 sm:pt-0 border-t sm:border-t-0 border-stone-100">
                        <!-- Status Pill -->
                        <span class="px-3 py-1 rounded-full text-xs font-bold {{ $task->status === 'Completed' ? 'bg-emerald-100 text-emerald-800 border border-emerald-200/60' : 'bg-amber-100 text-amber-800 border border-amber-200/60' }}">
                            {{ $task->status }}
                        </span>

                        <!-- Action Buttons -->
                        <div class="flex items-center gap-2">
                            <!-- Toggle Complete -->
                            <button 
                                wire:click="toggleComplete({{ $task->id }})"
                                class="px-3.5 py-1.5 text-xs font-semibold rounded-xl text-white transition {{ $task->status === 'Completed' ? 'bg-stone-800 hover:bg-stone-900' : 'bg-eucalyptus-700 hover:bg-eucalyptus-800' }}"
                            >
                                {{ $task->status === 'Completed' ? 'Mark Pending' : '✓ Mark Complete' }}
                            </button>

                            <!-- Edit -->
                            <button 
                                wire:click="openEditModal({{ $task->id }})"
                                class="px-3.5 py-1.5 text-xs font-semibold text-stone-700 bg-stone-100 hover:bg-stone-200 rounded-xl transition border border-stone-200/80"
                            >
                                Edit
                            </button>

                            <!-- Delete -->
                            <button 
                                wire:click="deleteTask({{ $task->id }})"
                                wire:confirm="Are you sure you want to delete this task?"
                                class="px-3.5 py-1.5 text-xs font-semibold text-rose-700 bg-rose-50 hover:bg-rose-100 rounded-xl transition border border-rose-200/80"
                            >
                                Delete
                            </button>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    @endif

    <!-- CREATE / EDIT TASK MODAL -->
    @if ($isModalOpen)
        <div class="fixed inset-0 bg-stone-900/40 backdrop-blur-xs z-50 flex items-center justify-center p-4 overflow-y-auto">
            <div class="bg-white rounded-3xl border border-stone-200 shadow-2xl max-w-lg w-full p-6 sm:p-8 space-y-5 my-8">
                
                <!-- Modal Header -->
                <div class="flex items-center justify-between border-b border-stone-100 pb-4">
                    <div>
                        <h2 class="text-lg font-bold text-stone-900">
                            {{ $editingTaskId ? 'Edit Task' : 'Create Task' }}
                        </h2>
                        <p class="text-xs text-stone-500 mt-0.5">Fill in the details for your academic task.</p>
                    </div>
                    <button wire:click="closeModal" class="text-stone-400 hover:text-stone-600 p-1.5 rounded-xl hover:bg-stone-100 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <form wire:submit.prevent="saveTask" class="space-y-4">
                    <!-- Title -->
                    <div>
                        <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider mb-1.5">Title <span class="text-rose-600">*</span></label>
                        <input 
                            type="text" 
                            wire:model="title"
                            placeholder="Enter task title" 
                            class="w-full px-4 py-2.5 rounded-xl border border-stone-300 text-stone-900 text-sm focus:ring-eucalyptus-600 focus:border-eucalyptus-600 transition"
                        >
                        @error('title') <span class="text-rose-600 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider mb-1.5">Description</label>
                        <textarea 
                            wire:model="description"
                            rows="3"
                            placeholder="Enter task description (optional)" 
                            class="w-full px-4 py-2.5 rounded-xl border border-stone-300 text-stone-900 text-sm focus:ring-eucalyptus-600 focus:border-eucalyptus-600 transition"
                        ></textarea>
                        @error('description') <span class="text-rose-600 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                    </div>

                    <!-- Category & Due Date Row -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider mb-1.5">Category <span class="text-rose-600">*</span></label>
                            <select 
                                wire:model="category_id"
                                required
                                class="w-full px-4 py-2.5 rounded-xl border border-stone-300 text-stone-900 text-sm focus:ring-eucalyptus-600 focus:border-eucalyptus-600 transition"
                            >
                                <option value="">Select category</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id') <span class="text-rose-600 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider mb-1.5">Due Date <span class="text-rose-600">*</span></label>
                            <input 
                                type="date" 
                                wire:model="due_date"
                                required
                                class="w-full px-4 py-2.5 rounded-xl border border-stone-300 text-stone-900 text-sm focus:ring-eucalyptus-600 focus:border-eucalyptus-600 transition"
                            >
                            @error('due_date') <span class="text-rose-600 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider mb-1.5">Status</label>
                        <select 
                            wire:model="status"
                            class="w-full px-4 py-2.5 rounded-xl border border-stone-300 text-stone-900 text-sm focus:ring-eucalyptus-600 focus:border-eucalyptus-600 transition"
                        >
                            <option value="Pending">Pending</option>
                            <option value="Completed">Completed</option>
                        </select>
                        @error('status') <span class="text-rose-600 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                    </div>

                    <!-- Reference Image Upload -->
                    <div>
                        <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider mb-1.5">Reference Image (Optional)</label>
                        
                        <div class="border-2 border-dashed border-stone-300 hover:border-eucalyptus-500 rounded-2xl p-4 text-center transition bg-stone-50/50 relative">
                            <input 
                                type="file" 
                                wire:model="image"
                                accept="image/jpeg,image/png,image/jpg"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                            >
                            <svg class="w-8 h-8 text-stone-400 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                            <p class="text-xs font-bold text-stone-700">Click to upload an image</p>
                            <p class="text-[11px] text-stone-400 mt-0.5">PNG, JPG, JPEG (Max 2MB)</p>
                        </div>

                        @error('image') <span class="text-rose-600 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror

                        @if ($image)
                            <div class="mt-3">
                                <img src="{{ $image->temporaryUrl() }}" class="h-20 rounded-xl object-cover border border-stone-200">
                            </div>
                        @elseif ($existingImagePath)
                            <div class="mt-3">
                                <img src="{{ Storage::url($existingImagePath) }}" class="h-20 rounded-xl object-cover border border-stone-200">
                            </div>
                        @endif
                    </div>

                    <!-- Modal Actions -->
                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-stone-100">
                        <button 
                            type="button" 
                            wire:click="closeModal"
                            class="px-4 py-2.5 text-xs font-bold text-stone-700 bg-stone-100 hover:bg-stone-200 rounded-xl transition"
                        >
                            Cancel
                        </button>
                        <button 
                            type="submit" 
                            class="px-5 py-2.5 text-xs font-bold text-white bg-eucalyptus-700 hover:bg-eucalyptus-800 rounded-xl shadow-xs transition"
                        >
                            {{ $editingTaskId ? 'Update Task' : 'Save Task' }}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    @endif

</div>
