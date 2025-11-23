<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-neutral-800 dark:text-neutral-100 leading-tight">{{ __('Pengaturan Akun') }}</h2>
                <p class="text-sm text-neutral-500 dark:text-neutral-400 mt-1">Kelola informasi profil dan keamanan akun Anda.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-neutral-50 dark:bg-neutral-950 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <div class="md:col-span-1 space-y-6">
                    
                    <div class="bg-white dark:bg-neutral-900 rounded-2xl shadow-sm border border-neutral-200 dark:border-neutral-800 overflow-hidden relative">
                        <div class="h-32 bg-gradient-to-r from-emerald-600 to-teal-500"></div>
                        <div class="px-6 pb-6 relative">
                            <div class="-mt-12 mb-4">
                                <div class="h-24 w-24 rounded-full ring-4 ring-white dark:ring-neutral-900 bg-neutral-100 dark:bg-neutral-800 flex items-center justify-center text-3xl font-bold text-emerald-600 shadow-lg">
                                    {{ Str::upper(Str::substr($user->name, 0, 1)) }}
                                </div>
                            </div>
                            <div class="mb-6">
                                <h3 class="text-xl font-bold text-neutral-900 dark:text-white">{{ $user->name }}</h3>
                                <p class="text-sm text-neutral-500 dark:text-neutral-400">{{ $user->email }}</p>
                                <div class="mt-3 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800">
                                    <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full mr-1.5"></span>
                                    Akun Aktif
                                </div>
                            </div>
                            <div class="border-t border-neutral-100 dark:border-neutral-800 pt-4 space-y-3 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-neutral-500">Bergabung</span>
                                    <span class="font-medium text-neutral-800 dark:text-neutral-200">{{ $user->created_at->translatedFormat('d F Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-blue-50 dark:bg-blue-900/20 rounded-2xl p-5 border border-blue-100 dark:border-blue-800/50">
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0 mt-0.5">
                                <svg class="h-5 w-5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-sm font-semibold text-blue-800 dark:text-blue-300 mb-1">Tips Keamanan</h4>
                                <p class="text-xs text-blue-700 dark:text-blue-400 leading-relaxed">
                                    Jangan bagikan kode OTP kepada siapapun.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-2 space-y-6">
                    
                    <div class="p-6 sm:p-8 bg-white dark:bg-neutral-900 shadow-sm sm:rounded-2xl border border-neutral-200 dark:border-neutral-800">
                        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-neutral-100 dark:border-neutral-800">
                            <div class="p-2 bg-emerald-50 dark:bg-emerald-900/30 rounded-lg text-emerald-600">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-neutral-900 dark:text-white">Informasi Profil</h3>
                                <p class="text-sm text-neutral-500">Perbarui data akun Anda.</p>
                            </div>
                        </div>
                        <div class="max-w-xl">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <div class="p-6 sm:p-8 bg-white dark:bg-neutral-900 shadow-sm sm:rounded-2xl border border-neutral-200 dark:border-neutral-800">
                        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-neutral-100 dark:border-neutral-800">
                            <div class="p-2 bg-amber-50 dark:bg-amber-900/30 rounded-lg text-amber-600">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-neutral-900 dark:text-white">Ganti Password</h3>
                                <p class="text-sm text-neutral-500">Amankan akun dengan password kuat.</p>
                            </div>
                        </div>
                        <div class="max-w-xl">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    <div class="p-6 sm:p-8 bg-white dark:bg-neutral-900 shadow-sm sm:rounded-2xl border border-red-100 dark:border-red-900/30 relative overflow-hidden">
                        <div class="relative z-10">
                            <div class="flex items-center gap-3 mb-6 pb-4 border-b border-neutral-100 dark:border-neutral-800">
                                <div class="p-2 bg-red-50 dark:bg-red-900/30 rounded-lg text-red-600">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-red-600 dark:text-red-400">Hapus Akun</h3>
                                    <p class="text-sm text-neutral-500">Tindakan ini permanen.</p>
                                </div>
                            </div>
                            <div class="max-w-xl">
                                @include('profile.partials.delete-user-form')
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>