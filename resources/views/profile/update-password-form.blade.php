<div class="bg-white rounded-3xl border border-stone-200/80 p-6 sm:p-8 shadow-2xs">
    <div class="mb-6">
        <h3 class="text-lg font-bold text-stone-900">Update Password</h3>
        <p class="text-xs text-stone-500 mt-0.5">Change your password to keep your account secure.</p>
    </div>

    <form wire:submit="updatePassword" class="space-y-4">
        
        <!-- Current Password -->
        <div>
            <label for="current_password" class="block text-xs font-bold text-stone-700 uppercase tracking-wider mb-1.5">Current Password</label>
            <div class="relative">
                <svg class="w-4 h-4 text-stone-400 absolute left-3.5 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                <input id="current_password" type="password" class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-stone-300 text-stone-900 text-sm focus:ring-eucalyptus-600 focus:border-eucalyptus-600 transition bg-stone-50/30" wire:model="state.current_password" autocomplete="current-password" placeholder="Enter your current password" />
            </div>
            <x-input-error for="current_password" class="mt-1" />
        </div>

        <!-- New Password -->
        <div>
            <label for="password" class="block text-xs font-bold text-stone-700 uppercase tracking-wider mb-1.5">New Password</label>
            <div class="relative">
                <svg class="w-4 h-4 text-stone-400 absolute left-3.5 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                <input id="password" type="password" class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-stone-300 text-stone-900 text-sm focus:ring-eucalyptus-600 focus:border-eucalyptus-600 transition bg-stone-50/30" wire:model="state.password" autocomplete="new-password" placeholder="Enter your new password" />
            </div>
            <x-input-error for="password" class="mt-1" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-xs font-bold text-stone-700 uppercase tracking-wider mb-1.5">Confirm New Password</label>
            <div class="relative">
                <svg class="w-4 h-4 text-stone-400 absolute left-3.5 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                <input id="password_confirmation" type="password" class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-stone-300 text-stone-900 text-sm focus:ring-eucalyptus-600 focus:border-eucalyptus-600 transition bg-stone-50/30" wire:model="state.password_confirmation" autocomplete="new-password" placeholder="Confirm your new password" />
            </div>
            <x-input-error for="password_confirmation" class="mt-1" />
        </div>

        <!-- Action / Save Button -->
        <div class="pt-2 flex items-center justify-between">
            <x-action-message class="text-xs font-bold text-emerald-600" on="saved">
                Password updated.
            </x-action-message>

            <button type="submit" class="w-full bg-eucalyptus-700 hover:bg-eucalyptus-800 text-white font-bold py-3 rounded-xl transition text-sm shadow-xs">
                Update Password
            </button>
        </div>
    </form>
</div>
