<x-guest-layout>
    <h1 class="text-xl font-semibold mb-2">
        @if(($context ?? 'registration') === 'registration') Aktivasi Akun: OTP @else Verifikasi Login: OTP @endif
    </h1>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        @if(($context ?? 'registration') === 'registration')
            Masukkan kode OTP aktivasi akun yang dikirim ke email Anda. Setelah berhasil Anda bisa login dengan email & password. Kode berlaku 5 menit.
        @else
            Masukkan kode OTP login yang dikirim ke email Anda untuk menyelesaikan proses login. Kode berlaku 5 menit.
        @endif
    </div>
    @if(session('status') === 'reg-otp-sent')
        <div class="mb-4 text-sm text-green-600 dark:text-green-400">Kode OTP aktivasi dikirim.</div>
    @endif
    @if(session('status') === 'login-otp-sent')
        <div class="mb-4 text-sm text-green-600 dark:text-green-400">Kode OTP login dikirim.</div>
    @endif
    @if(session('status') === 'reg-otp-send-failed')
        <div class="mb-4 text-sm text-red-600 dark:text-red-400">Gagal mengirim OTP aktivasi. Coba kirim ulang.</div>
    @endif
    @if(session('status') === 'login-otp-send-failed')
        <div class="mb-4 text-sm text-red-600 dark:text-red-400">Gagal mengirim OTP login. Coba kirim ulang.</div>
    @endif
    @if(session('status') === 'otp-invalid')
        <div class="mb-4 text-sm text-red-600 dark:text-red-400">Kode salah. Silakan coba lagi.</div>
    @endif
    @if(session('status') === 'otp-attempts-exceeded')
        <div class="mb-4 text-sm text-red-600 dark:text-red-400">Percobaan salah melebihi batas. Kode hangus, kirim ulang untuk kode baru.</div>
    @endif
    @if(session('status') === 'otp-expired')
        <div class="mb-4 text-sm text-amber-600 dark:text-amber-400">Kode kadaluarsa. Kirim ulang untuk dapat kode baru.</div>
    @endif
    @if(session('status') === 'reg-otp-resent')
        <div class="mb-4 text-sm text-green-600 dark:text-green-400">Kode aktivasi baru dikirim.</div>
    @endif
    @if(session('status') === 'login-otp-resent')
        <div class="mb-4 text-sm text-green-600 dark:text-green-400">Kode login baru dikirim.</div>
    @endif
    @if(session('status') === 'otp-resend-throttled')
        <div class="mb-4 text-sm text-amber-600 dark:text-amber-400">Terlalu cepat. Tunggu sebentar sebelum kirim ulang lagi.</div>
    @endif
    <form method="POST" action="{{ route('otp.verify') }}" class="space-y-4">
        @csrf
        <div>
            <x-input-label for="code" value="Kode OTP" />
            <x-text-input id="code" name="code" type="text" inputmode="numeric" pattern="[0-9]{6}" maxlength="6" class="block mt-1 w-full" required autofocus />
            @error('code')
                <div class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</div>
            @enderror
        </div>
        <div class="flex items-center justify-between mt-4">
            <x-primary-button>Verifikasi OTP</x-primary-button>
            <form method="POST" action="{{ route('otp.resend') }}" class="inline">
                @csrf
                <x-secondary-button type="submit">Kirim Ulang</x-secondary-button>
            </form>
        </div>
    </form>
    <div class="mt-6 text-center">
        <a href="{{ route('login') }}" class="underline text-sm text-gray-600 dark:text-gray-400">Kembali ke login</a>
    </div>
</x-guest-layout>
