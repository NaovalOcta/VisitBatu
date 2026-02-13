@extends('layouts.user')

@section('user_content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Header Section --}}
        <div class="mb-8">
            <h1 class="font-serif text-3xl font-bold text-gray-900">Pengaturan Profil</h1>
            <p class="text-gray-500 mt-2">Kelola informasi akun dan kata sandi Anda.</p>
        </div>

        @if (session('success'))
            <div class="mb-6 p-4 rounded-2xl bg-green-50 border border-green-100 text-green-800 flex items-center gap-3">
                <i class="icon-check_circle text-xl"></i>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 p-4 rounded-2xl bg-red-50 border border-red-100 text-red-800">
                <div class="flex items-center gap-2 mb-2 font-bold">
                    <i class="icon-warning"></i>
                    <span>Harap perbaiki kesalahan berikut:</span>
                </div>
                <ul class="list-disc list-inside text-sm space-y-1 text-red-600 ml-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Profile Information Card --}}
        <div class="bg-white border border-gray-100 rounded-3xl shadow-sm overflow-hidden mb-8">
            <div class="px-6 py-5 border-b border-gray-50">
                <h3 class="font-serif font-bold text-gray-800 text-xl">Informasi Profil</h3>
            </div>
            <div class="p-6 md:p-8">
                <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data"
                    x-data="{ isLoading: false }" @submit="isLoading = true">
                    @csrf
                    @method('PATCH')

                    <div class="flex flex-col md:flex-row gap-8 items-start mb-8">
                        {{-- Avatar Section --}}
                        <div class="relative group">
                            <div
                                class="w-32 h-32 rounded-full overflow-hidden border-4 border-teal-50 shadow-md bg-gray-100">
                                <img id="avatar-preview"
                                    src="{{ $user->avatar ? (Str::startsWith($user->avatar, 'http') ? $user->avatar : asset('storage/' . $user->avatar)) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}"
                                    class="w-full h-full object-cover">
                            </div>
                            <label for="avatar-input"
                                class="absolute bottom-0 right-0 w-10 h-10 bg-teal-600 rounded-full flex items-center justify-center text-white cursor-pointer hover:bg-teal-700 transition shadow-lg border-2 border-white">
                                <i class="icon-camera"></i>
                                <input type="file" name="avatar" id="avatar-input" class="hidden" accept="image/*"
                                    onchange="previewAvatar(event)">
                            </label>
                        </div>

                        {{-- Name & Email Section --}}
                        <div class="flex-1 w-full space-y-6">
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Nama
                                    Lengkap</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                    class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-teal-500 focus:ring-2 focus:ring-teal-200 outline-none transition-all font-medium text-gray-800"
                                    required>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Alamat
                                    Email</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                    class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-teal-500 focus:ring-2 focus:ring-teal-200 outline-none transition-all font-medium text-gray-800"
                                    required>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" :disabled="isLoading"
                            class="px-8 py-3 bg-teal-600 hover:bg-teal-700 text-white font-bold rounded-full shadow-lg hover:shadow-teal-500/30 transition-all transform hover:-translate-y-1 disabled:opacity-50 disabled:cursor-not-allowed">
                            <span x-show="!isLoading">Simpan Perubahan</span>
                            <span x-show="isLoading" class="flex items-center gap-2">
                                <svg class="animate-spin h-5 w-5 text-white" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                Menyimpan...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Password Update Card --}}
        <div class="bg-white border border-gray-100 rounded-3xl shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-50">
                <h3 class="font-serif font-bold text-gray-800 text-xl">
                    {{ $user->password ? 'Ubah Kata Sandi' : 'Pasang Kata Sandi' }}
                </h3>
            </div>
            <div class="p-6 md:p-8">
                <form action="{{ route('user.profile.password.update') }}" method="POST" x-data="{ isLoading: false }"
                    @submit="isLoading = true">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        @if ($user->password)
                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Kata
                                    Sandi Saat Ini</label>
                                <input type="password" name="current_password"
                                    class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-teal-500 focus:ring-2 focus:ring-teal-200 outline-none transition-all"
                                    required>
                            </div>
                        @else
                            <div
                                class="md:col-span-2 p-4 rounded-2xl bg-teal-50 border border-teal-100 text-teal-800 text-sm">
                                <i class="icon-info mr-2"></i>
                                Anda belum memiliki kata sandi karena login via Google. Silakan pasang kata sandi untuk
                                dapat login menggunakan email dikemudian hari.
                            </div>
                        @endif

                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Kata
                                Sandi Baru</label>
                            <input type="password" name="password"
                                class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-teal-500 focus:ring-2 focus:ring-teal-200 outline-none transition-all"
                                required>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Konfirmasi
                                Kata Sandi Baru</label>
                            <input type="password" name="password_confirmation"
                                class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-teal-500 focus:ring-2 focus:ring-teal-200 outline-none transition-all"
                                required>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" :disabled="isLoading"
                            class="px-8 py-3 bg-gray-900 hover:bg-teal-700 text-white font-bold rounded-full shadow-lg transition-all transform hover:-translate-y-1 disabled:opacity-50 disabled:cursor-not-allowed">
                            <span
                                x-show="!isLoading">{{ $user->password ? 'Perbarui Kata Sandi' : 'Pasang Kata Sandi' }}</span>
                            <span x-show="isLoading" class="flex items-center gap-2">
                                <svg class="animate-spin h-5 w-5 text-white" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                Memproses...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewAvatar(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('avatar-preview');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
