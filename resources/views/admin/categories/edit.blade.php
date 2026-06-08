@extends('layouts.admin')

@section('page_title', 'Edit Kategori')

@section('admin_content')
    <div class="max-w-2xl mx-auto">
        {{-- Tombol Kembali --}}
        <a href="{{ route('admin.categories.index') }}"
            class="inline-flex items-center text-sm text-gray-500 dark:text-white/60 hover:text-teal-600 dark:hover:text-accent-400 mb-6 transition">
            <i class="icon-arrow-left mr-2"></i> Kembali ke Daftar
        </a>

        <div class="bg-white dark:bg-night-800 rounded-3xl shadow-sm border border-gray-100 dark:border-night-700/50 overflow-hidden">
            <div class="p-8">
                <h2 class="font-serif text-xl font-bold text-gray-900 dark:text-white mb-6">Edit Kategori</h2>

                <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        {{-- Input Nama --}}
                        <div>
                            <label for="name" class="block text-sm font-bold text-gray-700 dark:text-white/80 mb-2">Nama Kategori</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}"
                                class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-night-900 border-gray-200 dark:border-night-700 focus:border-teal-500 focus:ring-teal-500 focus:bg-white dark:focus:bg-night-800 transition dark:text-white/85 @error('name') border-red-500 bg-red-50 @enderror">
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Tampilan Slug (Readonly) --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-400 dark:text-white/50 uppercase tracking-wider mb-2">Slug
                                (Otomatis)</label>
                            <input type="text" value="{{ $category->slug }}" readonly
                                class="w-full px-4 py-3 rounded-xl bg-gray-100 dark:bg-night-900 border-transparent text-gray-500 dark:text-white/60 cursor-not-allowed">
                        </div>

                        {{-- Tombol Submit --}}
                        <div class="pt-6 border-t border-gray-50 dark:border-night-700/50 flex justify-end">
                            <button type="submit"
                                class="px-8 py-3 bg-teal-600 hover:bg-teal-700 text-white font-bold rounded-xl shadow-lg hover:shadow-teal-500/30 transition-all transform hover:-translate-y-0.5">
                                Perbarui Kategori
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
