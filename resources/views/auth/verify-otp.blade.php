@extends('layouts.guest')

@section('content')
    <div class="w-full max-w-md bg-white dark:bg-night-800 rounded-3xl shadow-2xl dark:shadow-night-950/50 overflow-hidden p-8 md:p-12 m-4 transition-colors duration-300">
        <div class="text-center">
            {{-- Icon --}}
            <div class="mx-auto w-16 h-16 bg-primary-100 dark:bg-night-900 rounded-full flex items-center justify-center mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary-600 dark:text-primary-400" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>

            <h1 class="font-serif text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-4">Verifikasi OTP</h1>

            <p class="text-gray-600 dark:text-white/60 mb-2 leading-relaxed">
                Masukkan kode 6 digit yang telah dikirim ke:
            </p>

            <p class="text-primary-700 dark:text-primary-400 font-bold mb-6">{{ $email ?? session('otp_email') }}</p>

            @if (session('success'))
                <div class="bg-green-50 border border-green-300 text-green-800 dark:bg-green-900/20 dark:border-green-800 dark:text-green-300 px-4 py-3 rounded-xl mb-6 text-sm font-medium">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-50 border border-red-300 text-red-800 dark:bg-red-900/20 dark:border-red-850 dark:text-red-350 px-4 py-3 rounded-xl mb-6 text-sm font-medium">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('otp.verify') }}" x-data="otpForm()" class="space-y-6">
                @csrf

                {{-- OTP Input Fields --}}
                <div class="flex justify-center gap-2">
                    @for ($i = 0; $i < 6; $i++)
                        <input type="text" maxlength="1" inputmode="numeric" pattern="[0-9]"
                            x-ref="otp{{ $i }}" @input="handleInput($event, {{ $i }})"
                            @keydown.backspace="handleBackspace($event, {{ $i }})" @paste="handlePaste($event)"
                            class="w-12 h-14 text-center text-xl font-bold text-gray-900 dark:text-white bg-white dark:bg-night-900 border-2 border-gray-300 dark:border-night-700 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition placeholder-gray-400 dark:placeholder-white/30">
                    @endfor
                </div>

                {{-- Hidden input for form submission --}}
                <input type="hidden" name="otp" x-model="otpValue">

                <button type="submit"
                    class="w-full bg-primary-900 text-white font-bold py-3 px-6 rounded-full hover:bg-primary-800 transition shadow-lg transform hover:-translate-y-1">
                    Verifikasi
                </button>
            </form>

            {{-- Timer and Resend --}}
            <div class="mt-6" x-data="resendTimer()">
                <p class="text-sm text-gray-700 dark:text-white/80 mb-2 font-medium">
                    Tidak menerima kode?
                </p>

                <template x-if="countdown > 0">
                    <p class="text-sm text-gray-600 dark:text-white/60">
                        Kirim ulang dalam <span x-text="countdown" class="font-bold text-primary-600 dark:text-primary-400"></span> detik
                    </p>
                </template>

                <template x-if="countdown <= 0">
                    <form method="POST" action="{{ route('otp.resend') }}">
                        @csrf
                        <button type="submit" class="text-primary-600 dark:text-primary-400 font-bold hover:text-primary-800 dark:hover:text-primary-300 transition text-sm">
                            Kirim Ulang Kode OTP
                        </button>
                    </form>
                </template>
            </div>

            <div class="mt-6 pt-6 border-t border-gray-100 dark:border-night-700">
                <a href="{{ route('login') }}" class="text-gray-600 dark:text-white/60 hover:text-gray-900 dark:hover:text-white text-sm font-medium transition">
                    ← Kembali ke halaman login
                </a>
            </div>
        </div>
    </div>

    <script>
        function otpForm() {
            return {
                otpValue: '',
                handleInput(event, index) {
                    const value = event.target.value;

                    // Only allow numbers
                    if (!/^\d*$/.test(value)) {
                        event.target.value = '';
                        return;
                    }

                    // Move to next input
                    if (value && index < 5) {
                        this.$refs['otp' + (index + 1)].focus();
                    }

                    this.updateOtpValue();
                },
                handleBackspace(event, index) {
                    if (!event.target.value && index > 0) {
                        this.$refs['otp' + (index - 1)].focus();
                    }
                    this.updateOtpValue();
                },
                handlePaste(event) {
                    event.preventDefault();
                    const paste = (event.clipboardData || window.clipboardData).getData('text');
                    const digits = paste.replace(/\D/g, '').slice(0, 6);

                    for (let i = 0; i < 6; i++) {
                        this.$refs['otp' + i].value = digits[i] || '';
                    }

                    if (digits.length > 0) {
                        const focusIndex = Math.min(digits.length, 5);
                        this.$refs['otp' + focusIndex].focus();
                    }

                    this.updateOtpValue();
                },
                updateOtpValue() {
                    let otp = '';
                    for (let i = 0; i < 6; i++) {
                        otp += this.$refs['otp' + i].value || '';
                    }
                    this.otpValue = otp;
                }
            }
        }

        function resendTimer() {
            return {
                countdown: 60,
                init() {
                    this.startTimer();
                },
                startTimer() {
                    const timer = setInterval(() => {
                        this.countdown--;
                        if (this.countdown <= 0) {
                            clearInterval(timer);
                        }
                    }, 1000);
                }
            }
        }
    </script>
@endsection
