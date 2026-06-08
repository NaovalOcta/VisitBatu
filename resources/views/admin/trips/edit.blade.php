@extends('layouts.admin')

@section('page_title', 'Edit Wisata')

@section('admin_content')
    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h2 class="font-serif text-2xl font-bold text-gray-800 dark:text-white">Edit Informasi Wisata</h2>
            <p class="text-gray-500 dark:text-white/60 text-sm">Perbarui data destinasi <span
                    class="font-bold text-teal-600 dark:text-accent-400">{{ $trip->title }}</span>.</p>
        </div>
        <a href="{{ route('admin.trips.index') }}"
            class="inline-flex items-center justify-center px-5 py-2.5 bg-white dark:bg-transparent border border-gray-200 dark:border-night-700 text-gray-600 dark:text-white/60 text-sm font-bold rounded-full hover:bg-gray-50 dark:hover:bg-night-700 hover:text-gray-900 dark:hover:text-white transition-all shadow-sm">
            <i class="icon-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    {{-- Error Alert --}}
    @if ($errors->any())
        <div class="mb-6 p-4 rounded-2xl bg-red-50 dark:bg-red-950/20 border border-red-100 dark:border-red-900/40 text-red-800 dark:text-red-350">
            <ul class="list-disc list-inside text-sm space-y-1 text-red-600 dark:text-red-400 ml-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white dark:bg-night-800 border border-gray-100 dark:border-night-700/50 rounded-3xl shadow-sm overflow-hidden p-6 md:p-8">
        <form action="{{ route('admin.trips.update', $trip) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                {{-- Judul --}}
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-gray-500 dark:text-white/50 uppercase tracking-wider mb-2">Nama
                        Destinasi</label>
                    <input type="text" name="title"
                        class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-night-900 border-transparent focus:bg-white dark:focus:bg-night-800 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 outline-none transition-all font-serif font-bold text-gray-800 dark:text-white"
                        value="{{ old('title', $trip->title) }}" required>
                </div>

                {{-- Lokasi / Alamat dengan Autocomplete --}}
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-gray-500 dark:text-white/50 uppercase tracking-wider mb-2">Lokasi / Alamat
                        Lengkap</label>
                    <div class="relative" id="autocomplete-container">
                        <span class="absolute left-4 top-3.5 text-gray-400 dark:text-white/40"><i class="icon-map-marker"></i></span>
                        <input type="text" name="location" id="location-input"
                            class="w-full pl-10 pr-4 py-3 rounded-xl bg-gray-50 dark:bg-night-900 border-transparent focus:bg-white dark:focus:bg-night-800 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 outline-none transition-all dark:text-white/80 placeholder-gray-400 dark:placeholder-white/20"
                            value="{{ old('location', $trip->location) }}" placeholder="Ketik nama tempat atau alamat..."
                            autocomplete="off" required>

                        {{-- Dropdown Hasil Pencarian --}}
                        <div id="autocomplete-results"
                            class="absolute z-50 w-full mt-1 bg-white dark:bg-night-800 border border-gray-100 dark:border-night-700 rounded-xl shadow-xl hidden overflow-hidden">
                            {{-- Results will be injected here --}}
                        </div>
                    </div>
                </div>

                {{-- Interactive Map dengan Leaflet --}}
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-gray-500 dark:text-white/50 uppercase tracking-wider mb-2">Pilih Lokasi di
                        Peta</label>
                    <div id="map"
                        class="w-full h-96 rounded-2xl border-2 border-gray-100 dark:border-night-700 shadow-inner z-10 antialiased"></div>
                    <p class="text-xs text-gray-400 dark:text-white/40 mt-2">Gunakan kotak pencarian di atas atau geser penanda (marker) untuk
                        akurasi maksimal.</p>
                </div>

                {{-- Hidden Coordinates --}}
                <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude', $trip->latitude) }}">
                <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude', $trip->longitude) }}">

                {{-- Durasi --}}
                <div>
                    <label class="block text-xs font-bold text-gray-500 dark:text-white/50 uppercase tracking-wider mb-2">Estimasi Durasi / Jam
                        Buka</label>
                    <div class="relative">
                        <span class="absolute left-4 top-3.5 text-gray-400 dark:text-white/40"><i class="icon-clock-o"></i></span>
                        <input type="text" name="duration"
                            class="w-full pl-10 pr-4 py-3 rounded-xl bg-gray-50 dark:bg-night-900 border-transparent focus:bg-white dark:focus:bg-night-800 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 outline-none transition-all dark:text-white/80 placeholder-gray-400 dark:placeholder-white/20"
                            value="{{ old('duration', $trip->duration) }}" required>
                    </div>
                </div>

                <div>
                    <label class="block text-gray-700 dark:text-white/80 text-sm font-bold mb-2">Kategori Wisata</label>
                    <select name="category_id" class="w-full bg-gray-50 dark:bg-night-900 border-transparent focus:bg-white dark:focus:bg-night-800 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 border rounded-xl p-3 outline-none transition-all dark:text-white/85" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $trip->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Harga --}}
                <div>
                    <label class="block text-xs font-bold text-gray-500 dark:text-white/50 uppercase tracking-wider mb-2">Harga Tiket Masuk
                        (IDR)</label>
                    <div class="relative">
                        <span class="absolute left-4 top-3.5 text-gray-500 dark:text-white/40 font-bold">Rp</span>
                        <input type="number" name="price"
                            class="w-full pl-12 pr-4 py-3 rounded-xl bg-gray-50 dark:bg-night-900 border-transparent focus:bg-white dark:focus:bg-night-800 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 outline-none transition-all font-medium dark:text-white/85"
                            value="{{ old('price', $trip->price) }}" required>
                    </div>
                </div>

                {{-- WhatsApp Number --}}
                <div>
                    <label class="block text-xs font-bold text-gray-500 dark:text-white/50 uppercase tracking-wider mb-2">Nomor WhatsApp
                        Inquiry</label>
                    <div class="relative">
                        <span class="absolute left-4 top-3.5 text-gray-400 dark:text-white/40"><i class="icon-whatsapp"></i></span>
                        <input type="text" name="whatsapp_number"
                            class="w-full pl-10 pr-4 py-3 rounded-xl bg-gray-50 dark:bg-night-900 border-transparent focus:bg-white dark:focus:bg-night-800 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 outline-none transition-all font-medium dark:text-white/80"
                            value="{{ old('whatsapp_number', $trip->whatsapp_number) }}" placeholder="Contoh: 628123456789">
                        <p class="text-[10px] text-gray-400 dark:text-white/40 mt-2">Gunakan format internasional (62...) tanpa tanda + atau spasi.</p>
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-gray-500 dark:text-white/50 uppercase tracking-wider mb-2">Deskripsi
                        Lengkap</label>
                    <textarea name="description" rows="10"
                        class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-night-900 border-transparent focus:bg-white dark:focus:bg-night-800 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 outline-none transition-all dark:text-white/80 placeholder-gray-400 dark:placeholder-white/20"
                        placeholder="Jelaskan keunikan dan daya tarik tempat wisata ini..." required>{{ old('description', $trip->description) }}</textarea>
                </div>

                @push('styles')
                    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
                        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
                    <style>
                        .autocomplete-item {
                            padding: 12px 16px;
                            cursor: pointer;
                            transition: background-color 0.2s;
                        }

                        .autocomplete-item:hover {
                            background-color: #f3f4f6;
                        }
                        
                        .dark .autocomplete-item:hover {
                            background-color: #131820;
                        }
                    </style>
                @endpush

                @push('scripts')
                    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
                        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const apiKey = "{{ config('services.locationiq.key') }}";
                            const existingLat = {{ $trip->latitude ?? -7.871181 }};
                            const existingLng = {{ $trip->longitude ?? 112.526848 }};

                            // Initialize Map
                            const map = L.map('map').setView([existingLat, existingLng], 15);
                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                            }).addTo(map);

                            const marker = L.marker([existingLat, existingLng], {
                                draggable: true
                            }).addTo(map);

                            function updateInputs(lat, lng) {
                                document.getElementById('latitude').value = lat.toFixed(8);
                                document.getElementById('longitude').value = lng.toFixed(8);
                            }

                            // Marker events
                            marker.on('dragend', function() {
                                const pos = marker.getLatLng();
                                updateInputs(pos.lat, pos.lng);
                            });

                            map.on('click', function(e) {
                                marker.setLatLng(e.latlng);
                                updateInputs(e.latlng.lat, e.latlng.lng);
                            });

                            // Autocomplete Logic
                            const input = document.getElementById('location-input');
                            const resultsContainer = document.getElementById('autocomplete-results');
                            let timeout = null;

                            input.addEventListener('input', function() {
                                clearTimeout(timeout);
                                const query = this.value;

                                if (query.length < 3) {
                                    resultsContainer.classList.add('hidden');
                                    return;
                                }

                                timeout = setTimeout(() => {
                                    fetch(
                                            `https://api.locationiq.com/v1/autocomplete.php?key=${apiKey}&q=${encodeURIComponent(query)}&limit=5&format=json`)
                                        .then(res => res.json())
                                        .then(data => {
                                            if (data && data.length > 0) {
                                                resultsContainer.innerHTML = '';
                                                data.forEach(item => {
                                                    const div = document.createElement('div');
                                                    div.className =
                                                        'autocomplete-item border-b border-gray-50 dark:border-night-700 last:border-0';
                                                    div.innerHTML = `
                                                    <div class="font-bold text-sm text-gray-800 dark:text-white truncate">${item.display_name.split(',')[0]}</div>
                                                    <div class="text-[10px] text-gray-500 dark:text-white/50 truncate mt-0.5">${item.display_name}</div>
                                                `;
                                                    div.onclick = () => {
                                                        const lat = parseFloat(item.lat);
                                                        const lon = parseFloat(item.lon);

                                                        input.value = item.display_name;
                                                        resultsContainer.classList.add('hidden');

                                                        map.setView([lat, lon], 16);
                                                        marker.setLatLng([lat, lon]);
                                                        updateInputs(lat, lon);
                                                    };
                                                    resultsContainer.appendChild(div);
                                                });
                                                resultsContainer.classList.remove('hidden');
                                            } else {
                                                resultsContainer.classList.add('hidden');
                                            }
                                        })
                                        .catch(err => console.error('LocationIQ Error:', err));
                                }, 400);
                            });

                            document.addEventListener('click', function(e) {
                                if (!document.getElementById('autocomplete-container').contains(e.target)) {
                                    resultsContainer.classList.add('hidden');
                                }
                            });
                        });
                    </script>
                @endpush

                {{-- Foto Section --}}
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-gray-500 dark:text-white/50 uppercase tracking-wider mb-3">Foto
                        Destinasi</label>

                    <div class="flex flex-col md:flex-row gap-6 items-start">
                        {{-- Preview Foto Lama --}}
                        @if ($trip->thumbnail)
                            <div class="relative group w-full md:w-1/3">
                                <div
                                    class="rounded-2xl overflow-hidden border border-gray-200 dark:border-night-700 shadow-sm aspect-video bg-gray-100 dark:bg-night-900">
                                    <img src="{{ asset('storage/' . $trip->thumbnail) }}"
                                        class="w-full h-full object-cover">
                                </div>
                                <p class="text-xs text-center text-gray-400 dark:text-white/40 mt-2">Foto saat ini</p>
                            </div>
                        @endif

                        {{-- Input Foto Baru --}}
                        <div class="flex-1 w-full">
                            <label for="dropzone-file"
                                class="relative flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 dark:border-night-600 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:bg-night-900 hover:bg-gray-100 dark:hover:bg-night-850 transition-all overflow-hidden group">
                                <div id="upload-prompt"
                                    class="flex flex-col items-center justify-center pt-5 pb-6 transition-opacity duration-300">
                                    <i
                                        class="icon-cloud-upload text-3xl text-gray-400 dark:text-white/40 mb-3 group-hover:scale-110 transition-transform duration-300"></i>
                                    <p class="mb-2 text-sm text-gray-500 dark:text-white/60">
                                        <span class="font-bold text-teal-600 dark:text-accent-400">Klik untuk upload</span> atau drag and
                                        drop
                                    </p>
                                    <p class="text-xs text-gray-500 dark:text-white/40">JPG, PNG, JPEG, WEBP (MAX. 2MB)</p>
                                </div>

                                <div id="image-preview" class="hidden absolute inset-0 w-full h-full bg-cover bg-center">
                                    <div
                                        class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                        <p class="text-white font-bold text-sm tracking-wider">
                                            <i class="icon-refresh mr-1"></i> Ganti Gambar
                                        </p>
                                    </div>
                                </div>

                                <input id="dropzone-file" name="thumbnail" type="file" class="hidden"
                                    accept="image/*" onchange="previewImage(event)" />
                            </label>
                        </div>

                        <script>
                            function previewImage(event) {
                                const file = event.target.files[0];
                                const prompt = document.getElementById('upload-prompt');
                                const preview = document.getElementById('image-preview');

                                if (file) {
                                    const reader = new FileReader();

                                    reader.onload = function(e) {
                                        // Set gambar background pada div preview
                                        preview.style.backgroundImage = `url('${e.target.result}')`;

                                        // Tampilkan preview, sembunyikan prompt teks
                                        preview.classList.remove('hidden');
                                        prompt.classList.add('hidden');
                                    }

                                    reader.readAsDataURL(file);
                                } else {
                                    // Jika user membatalkan pilih file (cancel), kembalikan ke awal
                                    preview.style.backgroundImage = 'none';
                                    preview.classList.add('hidden');
                                    prompt.classList.remove('hidden');
                                }
                            }
                        </script>
                    </div>
                </div>
            </div>

            <div class="pt-6 border-t border-gray-100 dark:border-night-700 flex justify-end">
                <button type="submit"
                    class="px-8 py-3 bg-teal-600 hover:bg-teal-700 text-white font-bold rounded-full shadow-lg hover:shadow-teal-500/30 transition-all transform hover:-translate-y-1">
                    <i class="icon-save mr-2"></i> Perbarui Data
                </button>
            </div>
        </form>
    </div>
@endsection
