@extends('layouts.admin')

@section('page_title', 'Overview')

@section('admin_content')

    {{-- 1. Hero Section (Compact & Modern) --}}
    <div class="relative w-full h-48 md:h-56 rounded-3xl overflow-hidden shadow-lg shadow-teal-900/10 mb-8 group">
        {{-- Background Image --}}
        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105"
            style="background-image: url('{{ asset('images/hero_1.jpg') }}');">
        </div>
        {{-- Overlay Gradient --}}
        <div class="absolute inset-0 bg-gradient-to-r from-slate-900/90 via-slate-900/60 to-transparent"></div>

        <div class="relative h-full flex flex-col justify-center px-8 md:px-12">
            <h2 class="font-serif text-3xl md:text-4xl font-bold text-white mb-2">Halo,
                {{ explode(' ', Auth::user()->name)[0] }}! 👋</h2>
            <p class="text-slate-300 text-sm md:text-base max-w-lg mb-6">Kelola destinasi wisata dan cerita perjalanan Kota
                Batu dalam satu tempat.</p>

            <div class="flex flex-wrap gap-3">
                <a href="{{ route('admin.trips.create') }}"
                    class="inline-flex items-center px-5 py-2.5 bg-white dark:bg-transparent border border-transparent dark:border-white text-teal-700 dark:text-white text-sm font-bold rounded-full shadow-sm hover:bg-teal-50 dark:hover:bg-white dark:hover:text-teal-700 hover:scale-105 transition-all duration-200">
                    <i class="icon-plus mr-2"></i> Tambah Wisata
                </a>
                <button type="button" disabled title="Fitur ini masih dalam tahap pengembangan dan belum dapat digunakan"
                    class="inline-flex items-center px-5 py-2.5 bg-white/5 backdrop-blur-sm border border-white/10 text-white/40 text-sm font-bold rounded-full cursor-not-allowed transition-all duration-200">
                    <i class="icon-pencil mr-2"></i> Tulis Blog
                </button>
            </div>
        </div>
    </div>

    {{-- 2. Statistics Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        {{-- Card 1 --}}
        <div
            class="bg-white dark:bg-night-800 p-6 rounded-2xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] hover:-translate-y-1 transition-all duration-300 border border-gray-100 dark:border-night-700/50">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-teal-50 dark:bg-night-900 text-teal-600 dark:text-teal-400 rounded-xl">
                    <i class="icon-map text-2xl"></i>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-400 dark:text-white/50 uppercase tracking-wider">Destinasi</p>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalTrips ?? 0 }}</h3>
                </div>
            </div>
        </div>

        {{-- Card 2 --}}
        <div
            class="bg-white dark:bg-night-800 p-6 rounded-2xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] hover:-translate-y-1 transition-all duration-300 border border-gray-100 dark:border-night-700/50">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-orange-50 dark:bg-orange-950/20 text-orange-600 dark:text-orange-400 rounded-xl">
                    <i class="icon-book text-2xl"></i>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-400 dark:text-white/50 uppercase tracking-wider">Artikel Blog</p>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ \App\Models\Post::count() }}</h3>
                </div>
            </div>
        </div>

        {{-- Card 3 --}}
        <div
            class="bg-white dark:bg-night-800 p-6 rounded-2xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] hover:-translate-y-1 transition-all duration-300 border border-gray-100 dark:border-night-700/50">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-indigo-50 dark:bg-indigo-950/20 text-indigo-600 dark:text-indigo-400 rounded-xl">
                    <i class="icon-users text-2xl"></i>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-400 dark:text-white/50 uppercase tracking-wider">Pengguna</p>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ \App\Models\User::count() }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- 3. Moderation Queue Table --}}
    <div class="bg-white dark:bg-night-800 border border-gray-100 dark:border-night-700/50 rounded-3xl shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-50 dark:border-night-700/50 flex justify-between items-center bg-gray-50/50 dark:bg-night-900/30">
            <h3 class="font-serif font-bold text-gray-800 dark:text-white text-lg">Antrian Moderasi</h3>
            <a href="{{ route('admin.posts.index') }}"
                class="text-sm font-medium text-teal-600 dark:text-teal-400 hover:text-teal-700 dark:hover:text-teal-300 flex items-center">
                Lihat Semua <i class="icon-arrow-right ml-1"></i>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full whitespace-nowrap text-left text-sm">
                <thead class="bg-gray-50 dark:bg-night-900 text-gray-500 dark:text-white/50">
                    <tr>
                        <th class="px-6 py-4 font-semibold">Judul Cerita</th>
                        <th class="px-6 py-4 font-semibold">Penulis</th>
                        <th class="px-6 py-4 font-semibold">Tanggal</th>
                        <th class="px-6 py-4 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 dark:divide-night-700/50">
                    @forelse($moderationQueue as $post)
                        <tr class="hover:bg-gray-50/50 dark:hover:bg-night-900/50 transition-colors">
                            <td class="px-6 py-4">
                                <p class="font-bold text-gray-900 dark:text-white max-w-xs truncate">{{ $post->title }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="h-8 w-8 rounded-full bg-teal-100 dark:bg-green-950/40 text-teal-600 dark:text-white/80 flex items-center justify-center text-xs font-bold">
                                        {{ substr($post->user->name, 0, 1) }}
                                    </div>
                                    <span class="font-medium text-gray-700 dark:text-white/80">{{ $post->user->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-500 dark:text-white/60">
                                {{ $post->created_at->format('d M, Y') }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.posts.index') }}"
                                    class="inline-flex items-center justify-center h-8 px-4 border border-gray-200 dark:border-night-700 rounded-full text-xs font-bold text-gray-600 dark:text-white/60 hover:border-teal-500 dark:hover:border-night-600 hover:text-teal-600 dark:hover:text-accent-400 hover:bg-teal-50 dark:hover:bg-night-900 transition-all">
                                    Review
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-400 dark:text-white/50 bg-gray-50/30 dark:bg-night-900/30">
                                <div class="flex flex-col items-center justify-center">
                                    <i class="icon-check_circle text-4xl mb-3 text-gray-300 dark:text-white/30"></i>
                                    <p>Tidak ada postingan menunggu moderasi.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
