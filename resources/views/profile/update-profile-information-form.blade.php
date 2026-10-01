<div class="bg-white rounded-3xl border border-stone-200/80 p-6 sm:p-8 shadow-2xs">
    <div class="mb-6">
        <h3 class="text-lg font-bold text-stone-900">Profile Information</h3>
        <p class="text-xs text-stone-500 mt-0.5">Update your personal information and profile photo.</p>
    </div>

    <form wire:submit="updateProfileInformation" class="space-y-6">
        
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="text-center">
                <!-- Profile Photo File Input -->
                <input 
                    type="file" 
                    id="photo" 
                    class="hidden"
                    wire:model.live="photo"
                    x-ref="photo"
                    x-on:change="
                        photoName = $refs.photo.files[0].name;
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            photoPreview = e.target.result;
                        };
                        reader.readAsDataURL($refs.photo.files[0]);
                    " 
                />

                <div class="relative inline-block mx-auto">
                    <!-- Current Profile Photo -->
                    <div x-show="! photoPreview" class="w-32 h-32 rounded-full overflow-hidden relative mx-auto flex items-center justify-center bg-eucalyptus-700 text-white font-bold text-4xl shadow-md border-4 border-stone-100">
                        @if ($this->user->profile_photo_url)
                            <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="w-full h-full object-cover">
                        @else
                            {{ substr($this->user->name, 0, 1) }}
                        @endif
                    </div>

                    <!-- New Profile Photo Preview -->
                    <div x-show="photoPreview" style="display: none;" class="w-32 h-32 rounded-full overflow-hidden relative mx-auto shadow-md border-4 border-stone-100 bg-cover bg-no-repeat bg-center"
                         x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </div>

                    <!-- Camera Icon Overlay Button -->
                    <button 
                        type="button" 
                        x-on:click.prevent="$refs.photo.click()"
                        class="absolute bottom-1 right-1 w-9 h-9 bg-soot hover:bg-eucalyptus-900 text-white rounded-full flex items-center justify-center shadow-md border-2 border-white transition"
                        title="Click to change photo"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </button>
                </div>

                <p class="text-[11px] text-stone-500 font-medium mt-2">Click icon to change photo</p>

                @if ($this->user->profile_photo_path)
                    <button type="button" class="mt-2 text-xs font-bold text-rose-600 hover:underline" wire:click="deleteProfilePhoto">
                        Remove Photo
                    </button>
                @endif

                <x-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <!-- Full Name -->
        <div>
            <label for="name" class="block text-xs font-bold text-stone-700 uppercase tracking-wider mb-1.5">Full Name</label>
            <div class="relative">
                <svg class="w-4 h-4 text-stone-400 absolute left-3.5 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                <input id="name" type="text" class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-stone-300 text-stone-900 text-sm focus:ring-eucalyptus-600 focus:border-eucalyptus-600 transition bg-stone-50/30" wire:model="state.name" required autocomplete="name" placeholder="Full Name" />
            </div>
            <x-input-error for="name" class="mt-1" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-bold text-stone-700 uppercase tracking-wider mb-1.5">Email Address</label>
            <div class="relative">
                <svg class="w-4 h-4 text-stone-400 absolute left-3.5 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                <input id="email" type="email" class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-stone-300 text-stone-900 text-sm focus:ring-eucalyptus-600 focus:border-eucalyptus-600 transition bg-stone-50/30" wire:model="state.email" required autocomplete="username" placeholder="email@example.com" />
            </div>
            <x-input-error for="email" class="mt-1" />
        </div>

        <!-- Action / Save Button -->
        <div class="pt-2 flex items-center justify-between">
            <x-action-message class="text-xs font-bold text-emerald-600" on="saved">
                Saved successfully.
            </x-action-message>

            <button type="submit" wire:loading.attr="disabled" wire:target="photo" class="w-full bg-eucalyptus-700 hover:bg-eucalyptus-800 text-white font-bold py-3 rounded-xl transition text-sm shadow-xs">
                Save Changes
            </button>
        </div>
    </form>
</div>
