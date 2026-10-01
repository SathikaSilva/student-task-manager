<div class="min-h-screen flex flex-col sm:justify-center items-center pt-8 sm:pt-0 bg-plaster p-4">
    <div class="w-full sm:max-w-md space-y-6">
        <div class="text-center">
            {{ $logo }}
        </div>

        <div class="bg-white px-8 py-8 shadow-xl rounded-3xl border border-stone-200/80">
            {{ $slot }}
        </div>
    </div>
</div>
