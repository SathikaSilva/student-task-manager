<x-app-layout>
    <div class="space-y-6">
        <!-- Page Header -->
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-stone-900 tracking-tight">Profile</h1>
            <p class="text-stone-500 text-xs sm:text-sm font-medium mt-1">Manage your account information and settings.</p>
        </div>

        <!-- 2-Column Profile Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-8 items-start">
            
            <!-- Left Column: Profile Information & Photo Upload -->
            <div>
                @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                    @livewire('profile.update-profile-information-form')
                @endif
            </div>

            <!-- Right Column: Password Update & Account Deletion -->
            <div class="space-y-6">
                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                    @livewire('profile.update-password-form')
                @endif

                @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                    @livewire('profile.delete-user-form')
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
