@extends('layouts.admin')

@section('page_title', 'Tambah Wisata')

@section('admin_content')
    {{-- Header Section --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h2 class="font-serif text-2xl font-bold text-gray-800">Tambah Destinasi Baru</h2>
            <p class="text-gray-500 text-sm">Masukkan informasi lengkap mengenai tempat wisata baru.</p>
        </div>
        <a href="{{ route('admin.trips.index') }}"
            class="inline-flex items-center justify-center px-5 py-2.5 bg-white border border-gray-200 text-gray-600 text-sm font-bold rounded-full hover:bg-gray-50 hover:text-gray-900 transition-all shadow-sm">
            <i class="icon-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    {{-- Error Alert (Tailwind Style) --}}
    @if ($errors->any())
        <div class="mb-6 p-4 rounded-2xl bg-red-50 border border-red-100 text-red-800">
            <div class="flex items-center gap-2 mb-2 font-bold">
                <i class="icon-warning"></i>
                <span>Terjadi Kesalahan Input</span>
            </div>
            <ul class="list-disc list-inside text-sm space-y-1 text-red-600 ml-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form Container --}}
    <div class="bg-white border border-gray-100 rounded-3xl shadow-sm overflow-hidden p-6 md:p-8">
        <form action="{{ route('admin.trips.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                {{-- Judul Wisata --}}
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Nama Destinasi
                        Wisata</label>
                    <input type="text" name="title"
                        class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-teal-500 focus:ring-2 focus:ring-teal-200 outline-none transition-all font-serif font-bold text-gray-800 placeholder-gray-400"
                        value="{{ old('title') }}" placeholder="Contoh: Jatim Park 1" required>
                </div>

                {{-- Lokasi --}}
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Lokasi /
                        Alamat</label>
                    <div class="relative">
                        <span class="absolute left-4 top-3.5 text-gray-400"><i class="icon-map-marker"></i></span>
                        <input type="text" name="location"
                            class="w-full pl-10 pr-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-teal-500 focus:ring-2 focus:ring-teal-200 outline-none transition-all"
                            value="{{ old('location') }}" placeholder="Alamat lengkap lokasi" required>
                    </div>
                </div>

                {{-- Durasi --}}
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Estimasi Durasi / Jam
                        Buka</label>
                    <div class="relative">
                        <span class="absolute left-4 top-3.5 text-gray-400"><i class="icon-clock-o"></i></span>
                        <input type="text" name="duration"
                            class="w-full pl-10 pr-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-teal-500 focus:ring-2 focus:ring-teal-200 outline-none transition-all"
                            placeholder="Contoh: 08.00 - 17.00 WIB" value="{{ old('duration') }}" required>
                    </div>
                </div>

                {{-- Harga --}}
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Harga Tiket Masuk
                        (IDR)</label>
                    <div class="relative">
                        <span class="absolute left-4 top-3.5 text-gray-500 font-bold">Rp</span>
                        <input type="number" name="price"
                            class="w-full pl-12 pr-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-teal-500 focus:ring-2 focus:ring-teal-200 outline-none transition-all font-medium"
                            value="{{ old('price') }}" placeholder="0" required>
                        <p class="text-xs text-gray-400 mt-2">Masukkan angka saja, tanpa titik atau koma.</p>
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Deskripsi
                        Lengkap</label>
                    <textarea name="description" rows="5"
                        class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-teal-500 focus:ring-2 focus:ring-teal-200 outline-none transition-all"
                        placeholder="Jelaskan keunikan dan daya tarik tempat wisata ini..." required>{{ old('description') }}</textarea>
                </div>

                {{-- Upload Thumbnail --}}
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Foto Utama
                        (Thumbnail)</label>
                    <div class="flex items-center justify-center w-full">
                        <label for="dropzone-file"
                            class="flex flex-col items-center justify-center w-full h-40 border-2 border-gray-300 border-dashed rounded-2xl cursor-pointer bg-gray-50 hover:bg-gray-100 transition-all">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <i class="icon-cloud-upload text-3xl text-gray-400 mb-3"></i>
                                <p class="mb-2 text-sm text-gray-500"><span class="font-bold text-teal-600">Klik untuk
                                        upload</span> atau drag and drop</p>
                                <p class="text-xs text-gray-500">JPG, PNG, JPEG (MAX. 2MB)</p>
                            </div>
                            <input id="dropzone-file" name="thumbnail" type="file" class="hidden" accept="image/*"
                                required />
                        </label>
                    </div>
                    {{-- Script sederhana untuk menampilkan nama file setelah dipilih (Opsional) --}}
                    <script>
                        document.getElementById('dropzone-file').addEventListener('change', function(e) {
                            if (e.target.files[0]) {
                                alert('File terpilih: ' + e.target.files[0].name);
                            }
                        });
                    </script>
                </div>
            </div>

            {{-- Submit Button --}}
            <div class="pt-6 border-t border-gray-100 flex justify-end">
                <button type="submit"
                    class="px-8 py-3 bg-teal-600 hover:bg-teal-700 text-white font-bold rounded-full shadow-lg hover:shadow-teal-500/30 transition-all transform hover:-translate-y-1">
                    <i class="icon-save mr-2"></i> Simpan Destinasi
                </button>
            </div>
        </form>
    </div>
@endsection
