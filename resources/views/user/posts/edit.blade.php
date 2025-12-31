@extends('layouts.user')

@section('user_content')
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h2 class="font-serif text-3xl font-bold text-gray-900">Edit Cerita ✏️</h2>
            <p class="text-gray-500 text-sm mt-1">Perbarui tulisan "<span
                    class="font-bold text-teal-600">{{ $post->title }}</span>"</p>
        </div>
        <a href="{{ route('user.dashboard') }}"
            class="inline-flex items-center justify-center px-5 py-2.5 bg-white border border-gray-200 text-gray-600 text-sm font-bold rounded-full hover:bg-gray-50 hover:text-gray-900 transition-all shadow-sm">
            <i class="icon-arrow-left mr-2"></i> Batal
        </a>
    </div>

    @if ($errors->any())
        <div class="mb-6 p-4 rounded-2xl bg-red-50 border border-red-100 text-red-800">
            <ul class="list-disc list-inside text-sm space-y-1 ml-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white border border-gray-100 rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] overflow-hidden p-6 md:p-10">
        {{-- Perhatikan route name: user.posts.update --}}
        <form action="{{ route('user.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="space-y-8">
                {{-- Judul --}}
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Judul Cerita</label>
                    <input type="text" name="title"
                        class="w-full px-5 py-4 rounded-2xl bg-gray-50 border-transparent focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 outline-none transition-all font-serif text-lg font-bold text-gray-900"
                        value="{{ old('title', $post->title) }}" required>
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
                                {{ $trip->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Image Section (Grid Layout) --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    {{-- Foto Lama --}}
                    @if ($post->image)
                        <div class="md:col-span-1">
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Foto Saat
                                Ini</label>
                            <div class="relative rounded-3xl overflow-hidden aspect-[4/3] shadow-md group">
                                <img src="{{ asset('storage/' . $post->image) }}" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-black/10 group-hover:bg-black/0 transition-all"></div>
                            </div>
                        </div>
                    @endif

                    {{-- Upload Foto Baru --}}
                    <div class="{{ $post->image ? 'md:col-span-2' : 'md:col-span-3' }}">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Ganti Foto
                            (Opsional)</label>
                        <label for="edit-image"
                            class="flex flex-col items-center justify-center w-full h-full min-h-[200px] border-2 border-gray-300 border-dashed rounded-3xl cursor-pointer bg-gray-50 hover:bg-teal-50 hover:border-teal-300 transition-all">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <i class="icon-cloud-upload text-3xl text-gray-400 mb-2"></i>
                                <p class="text-sm text-gray-500 font-bold">Klik untuk ganti</p>
                            </div>
                            <input id="edit-image" name="image" type="file" class="hidden" accept="image/*" />
                        </label>
                    </div>
                </div>

                {{-- Konten --}}
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Isi Cerita</label>
                    <textarea name="content" rows="12"
                        class="w-full px-5 py-4 rounded-2xl bg-gray-50 border-transparent focus:bg-white focus:border-teal-500 focus:ring-4 focus:ring-teal-500/10 outline-none transition-all text-gray-700 leading-relaxed resize-y"
                        required>{{ old('content', $post->content) }}</textarea>
                </div>
            </div>

            <div class="pt-8 mt-8 border-t border-gray-100 flex items-center justify-end gap-3">
                <button type="submit"
                    class="px-8 py-3 bg-teal-600 hover:bg-teal-700 text-white text-sm font-bold rounded-full shadow-lg hover:shadow-teal-500/30 transition-all transform hover:-translate-y-1">
                    <i class="icon-save mr-2"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
@endsection
