@extends('layouts.guest')

@section('content')
    <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl overflow-hidden p-8 md:p-12 m-4">
        <div class="text-center">
            {{-- Icon --}}
            <div class="mx-auto w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>

            <h1 class="font-serif text-2xl md:text-3xl font-bold text-gray-900 mb-4">Verifikasi OTP</h1>

            <p class="text-gray-600 mb-2 leading-relaxed">
                Masukkan kode 6 digit yang telah dikirim ke:
            </p>

            <p class="text-primary-700 font-bold mb-6">{{ $email ?? session('otp_email') }}</p>

            @if (session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6 text-sm">
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
                            class="w-12 h-14 text-center text-xl font-bold border-2 border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition">
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
                <p class="text-sm text-gray-500 mb-2">
                    Tidak menerima kode?
                </p>

                <template x-if="countdown > 0">
                    <p class="text-sm text-gray-400">
                        Kirim ulang dalam <span x-text="countdown" class="font-bold text-primary-600"></span> detik
                    </p>
                </template>

                <template x-if="countdown <= 0">
                    <form method="POST" action="{{ route('otp.resend') }}">
                        @csrf
                        <button type="submit" class="text-primary-600 font-bold hover:text-primary-800 transition text-sm">
                            Kirim Ulang Kode OTP
                        </button>
                    </form>
                </template>
            </div>

            <div class="mt-6 pt-6 border-t border-gray-100">
                <a href="{{ route('login') }}" class="text-gray-500 hover:text-gray-700 text-sm transition">
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
