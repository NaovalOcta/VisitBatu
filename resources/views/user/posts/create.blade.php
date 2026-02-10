@extends('layouts.user')

@section('user_content')
    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h2 class="font-serif text-3xl font-bold text-gray-900">Tulis Cerita Baru ✍️</h2>
            <p class="text-gray-500 text-sm mt-1">Bagikan pengalaman perjalananmu yang menginspirasi.</p>
        </div>
        <a href="{{ route('user.dashboard') }}"
            class="inline-flex items-center justify-center px-5 py-2.5 bg-white border border-gray-200 text-gray-600 text-sm font-bold rounded-full hover:bg-gray-50 hover:text-gray-900 transition-all shadow-sm">
            <i class="icon-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    {{-- Alert Error --}}
    @if ($errors->any())
        <div class="mb-6 p-4 rounded-2xl bg-red-50 border border-red-100 text-red-800 flex gap-3 items-start">
            <i class="icon-warning text-lg mt-0.5"></i>
            <ul class="list-disc list-inside text-sm space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form Container --}}
    <div x-data="{ isLoading: false }"
        class="bg-white border border-gray-100 rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] overflow-hidden p-6 md:p-10">
        <form action="{{ route('user.posts.store') }}" method="POST" enctype="multipart/form-data"
            @submit="isLoading = true">
            @csrf

            <div class="space-y-8">
                {{-- Judul --}}
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Judul Cerita</label>
                    <input type="text" name="title"
                        class="w-full px-5 py-4 rounded-2xl bg-gray-50 border-transparent focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 outline-none transition-all font-serif text-lg font-bold text-gray-900 placeholder-gray-400"
                        placeholder="Contoh: Petualangan Seru di Museum Angkut..." value="{{ old('title') }}" required>
                </div>

                {{-- Lokasi --}}
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Lokasi</label>
                    <select name="trip_id"
                        class="w-full px-5 py-4 rounded-2xl bg-gray-50 border-transparent focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 outline-none transition-all font-serif text-lg font-bold text-gray-900 placeholder-gray-400"
                        required>
                        <option value="">Pilih Lokasi</option>
                        @foreach ($trips as $trip)
                            <option value="{{ $trip->id }}" {{ old('trip_id') == $trip->id ? 'selected' : '' }}>
                                {{ $trip->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Upload Gambar --}}
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Foto Sampul</label>
                    <label for="image-upload"
                        class="relative flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-3xl cursor-pointer bg-gray-50 hover:bg-teal-50 hover:border-teal-300 transition-all group overflow-hidden">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6 relative z-10">
                            <div
                                class="h-16 w-16 bg-white rounded-full shadow-sm flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                                <i class="icon-image text-3xl text-teal-500"></i>
                            </div>
                            <p class="mb-2 text-sm text-gray-500 group-hover:text-teal-700 font-medium">Klik untuk upload
                                foto</p>
                            <p class="text-xs text-gray-400">JPG, PNG, JPEG (Max. 2MB)</p>
                        </div>
                        <input id="image-upload" name="image" type="file" class="hidden" accept="image/*" />
                    </label>
                </div>

                {{-- Konten --}}
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Isi Cerita</label>
                    <textarea name="content" rows="12"
                        class="w-full px-5 py-4 rounded-2xl bg-gray-50 border-transparent focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 outline-none transition-all text-gray-700 leading-relaxed resize-y"
                        placeholder="Ceritakan pengalamanmu secara detail di sini..." required>{{ old('content') }}</textarea>
                </div>
            </div>

            {{-- Actions --}}
            <div class="pt-8 mt-8 border-t border-gray-100 flex items-center justify-end gap-3">
                <a href="{{ route('user.dashboard') }}"
                    class="px-6 py-3 rounded-full text-sm font-bold text-gray-500 hover:bg-gray-100 transition-all">
                    Batal
                </a>
                <button type="submit" :disabled="isLoading"
                    class="px-8 py-3 bg-teal-600 hover:bg-teal-700 text-white text-sm font-bold rounded-full shadow-lg hover:shadow-teal-500/30 transition-all transform hover:-translate-y-1 disabled:opacity-50 disabled:cursor-not-allowed">
                    <span x-show="!isLoading" class="flex items-center">
                        <i class="icon-paper-plane mr-2"></i> Publikasikan
                    </span>
                    <span x-show="isLoading" class="flex items-center gap-2">
                        <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                        Processing...
                    </span>
                </button>
            </div>
        </form>
    </div>

    {{-- Script Preview Gambar Sederhana --}}
    <script>
        document.getElementById('image-upload').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Ganti background label dengan gambar
                    const label = document.querySelector('label[for="image-upload"]');
                    label.style.backgroundImage = `url('${e.target.result}')`;
                    label.style.backgroundSize = 'cover';
                    label.style.backgroundPosition = 'center';
                    // Sembunyikan konten teks agar bersih
                    label.firstElementChild.style.opacity = '0';
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
