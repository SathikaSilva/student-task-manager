<div class="bg-rose-50/50 border border-rose-200/80 rounded-3xl p-6 sm:p-8 shadow-2xs space-y-4">
    <div class="flex items-start gap-4">
        <div class="w-10 h-10 rounded-2xl bg-rose-100 text-rose-600 flex items-center justify-center shrink-0 border border-rose-200">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
        </div>
        <div class="space-y-1">
            <h3 class="text-base font-bold text-stone-900">Delete Account</h3>
            <p class="text-xs text-rose-700 leading-relaxed">
                Once you delete your account, all your data will be permanently removed. This action cannot be undone.
            </p>
        </div>
    </div>

    <div class="pt-2 flex justify-end">
        <button 
            wire:click="confirmUserDeletion" 
            wire:loading.attr="disabled"
            class="px-5 py-2.5 text-xs font-bold text-rose-700 bg-white hover:bg-rose-100/60 rounded-xl transition border border-rose-300 shadow-2xs"
        >
            Delete Account
        </button>
    </div>

    <!-- Delete User Confirmation Modal -->
    <x-dialog-modal wire:model.live="confirmingUserDeletion">
        <x-slot name="title">
            Delete Account
        </x-slot>

        <x-slot name="content">
            Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.

            <div class="mt-4" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                <input type="password" class="w-full px-4 py-2.5 rounded-xl border border-stone-300 text-stone-900 text-sm focus:ring-rose-500 focus:border-rose-500 transition"
                            autocomplete="current-password"
                            placeholder="Password"
                            x-ref="password"
                            wire:model="password"
                            wire:keydown.enter="deleteUser" />

                <x-input-error for="password" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled" class="px-4 py-2 text-xs font-bold text-stone-700 bg-stone-100 hover:bg-stone-200 rounded-xl transition">
                Cancel
            </button>

            <button class="ms-3 px-5 py-2 text-xs font-bold text-white bg-rose-600 hover:bg-rose-700 rounded-xl transition shadow-xs" wire:click="deleteUser" wire:loading.attr="disabled">
                Delete Account
            </button>
        </x-slot>
    </x-dialog-modal>
</div>
