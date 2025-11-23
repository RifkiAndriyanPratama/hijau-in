<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-emerald-700 dark:text-emerald-300 leading-tight">{{ __('Profil Akun') }}</h2>
            <span class="text-xs px-2 py-1 rounded bg-emerald-100 text-emerald-700 dark:bg-emerald-700/60 dark:text-emerald-200">Aktif</span>
        </div>
    </x-slot>

    <div class="py-10 bg-neutral-50 dark:bg-neutral-950">
        <div class="max-w-6xl mx-auto px-4 lg:px-8">
            <div class="grid gap-8 md:grid-cols-3">
                <!-- Sidebar summary -->
                <div class="md:col-span-1 space-y-6">
                    <div class="bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 shadow-sm rounded-xl p-6 flex flex-col items-center">
                        <div class="h-24 w-24 rounded-full ring-4 ring-emerald-200 dark:ring-emerald-600 bg-gradient-to-br from-emerald-500 to-emerald-600 flex items-center justify-center text-white text-3xl font-semibold">
                            {{ Str::upper(Str::substr($user->name,0,1)) }}
                        </div>
                        <h3 class="mt-4 text-lg font-semibold text-gray-800 dark:text-gray-100">{{ $user->name }}</h3>
                        <p class="text-sm text-emerald-700 dark:text-emerald-300 font-medium">{{ $user->email }}</p>
                        <div class="mt-4 w-full text-xs text-gray-600 dark:text-gray-400 space-y-1">
                            <p><span class="font-medium text-gray-700 dark:text-gray-300">Dibuat:</span> {{ $user->created_at->format('d M Y') }}</p>
                            <p><span class="font-medium text-gray-700 dark:text-gray-300">Update:</span> {{ $user->updated_at->diffForHumans() }}</p>
                            <p><span class="font-medium text-gray-700 dark:text-gray-300">Status:</span> <span class="text-emerald-600 dark:text-emerald-400">Aktif (OTP)</span></p>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 shadow-sm rounded-xl p-6 space-y-4">
                        <h4 class="font-semibold text-emerald-700 dark:text-emerald-300 text-sm flex items-center gap-2">
                            <svg class="h-4 w-4 text-emerald-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 2l7 4v6c0 5-3.5 9-7 10-3.5-1-7-5-7-10V6l7-4z"/></svg>
                            Tips Keamanan
                        </h4>
                        <ul class="text-xs list-disc ms-4 text-gray-600 dark:text-gray-400 space-y-1">
                            <li>Gunakan password unik & panjang.</li>
                            <li>Jangan bagikan kode OTP ke siapa pun.</li>
                            <li>Perbarui profil bila data berubah.</li>
                        </ul>
                    </div>
                </div>

                <!-- Main forms -->
                <div class="md:col-span-2 space-y-8">
                    <div class="bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 shadow-sm rounded-xl p-6">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                    <div class="bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 shadow-sm rounded-xl p-6">
                        @include('profile.partials.update-password-form')
                    </div>
                    <div class="bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 shadow-sm rounded-xl p-6">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
