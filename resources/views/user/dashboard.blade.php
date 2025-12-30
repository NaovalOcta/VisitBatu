@extends('layouts.user')

@section('user_content')
    {{-- 1. Hero Welcome Section --}}
    <div class="relative w-full h-48 md:h-64 rounded-3xl overflow-hidden shadow-xl shadow-teal-900/10 mb-8 group">
        {{-- Background Image --}}
        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-1000 group-hover:scale-105"
            style="background-image: url('{{ asset('images/hero_1.jpg') }}');">
        </div>
        {{-- Overlay Gradient (Teal-ish) --}}
        <div class="absolute inset-0 bg-gradient-to-r from-teal-900/90 via-teal-800/60 to-transparent"></div>

        <div class="relative h-full flex flex-col justify-center px-8 md:px-12 text-white">
            <span
                class="inline-block py-1 px-3 rounded-full bg-white/20 backdrop-blur-md border border-white/30 text-xs font-bold uppercase tracking-wider w-fit mb-3">
                User Dashboard
            </span>
            <h1 class="font-serif text-3xl md:text-4xl font-bold mb-2">Selamat Datang,
                {{ explode(' ', Auth::user()->name)[0] }}! 🌿</h1>
            <p class="text-teal-50 text-sm md:text-base max-w-xl mb-6 font-light">
                Bagikan pengalaman seru liburanmu di Batu kepada ribuan wisatawan lainnya.
            </p>

            <div class="flex gap-3">
                <a href="{{ route('user.posts.create') }}"
                    class="inline-flex items-center px-6 py-2.5 bg-white text-teal-700 text-sm font-bold rounded-full shadow-lg hover:bg-teal-50 hover:scale-105 transition-all duration-300">
                    <i class="icon-pencil mr-2"></i> Mulai Menulis
                </a>
            </div>
        </div>
    </div>

    {{-- 2. Stats & Quick Info --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        {{-- Card 1: Total Posts --}}
        <div
            class="bg-white p-6 rounded-3xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] transition-all">
            <div class="flex items-center gap-4">
                <div class="h-14 w-14 rounded-2xl bg-orange-50 flex items-center justify-center text-orange-500 text-2xl">
                    <i class="icon-book"></i>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Cerita Saya</p>
                    <h3 class="text-3xl font-bold text-gray-900 mt-1">{{ Auth::user()->posts()->count() }}</h3>
                </div>
            </div>
        </div>

        {{-- Card 2: Status Akun --}}
        <div
            class="bg-white p-6 rounded-3xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] transition-all">
            <div class="flex items-center gap-4">
                <div class="h-14 w-14 rounded-2xl bg-teal-50 flex items-center justify-center text-teal-600 text-2xl">
                    <i class="icon-check_circle"></i>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Status Akun</p>
                    <span
                        class="inline-flex items-center mt-1 px-2.5 py-0.5 rounded-full text-sm font-bold bg-green-100 text-green-700">
                        Aktif
                    </span>
                </div>
            </div>
        </div>

        {{-- Card 3: Tips --}}
        <div
            class="bg-gradient-to-br from-indigo-500 to-purple-600 p-6 rounded-3xl shadow-lg text-white relative overflow-hidden group">
            <div
                class="absolute -right-6 -top-6 h-24 w-24 rounded-full bg-white/20 transition-transform group-hover:scale-150 duration-700">
            </div>
            <div class="relative z-10">
                <h4 class="font-bold text-lg mb-1 font-serif">Tips Menulis ✨</h4>
                <p class="text-white/80 text-xs leading-relaxed mb-3">
                    Gunakan foto yang jernih dan judul yang menarik agar ceritamu disukai banyak pembaca!
                </p>
                <a href="#"
                    class="text-xs font-bold underline decoration-white/50 hover:decoration-white transition">Pelajari
                    Selengkapnya</a>
            </div>
        </div>
    </div>

    {{-- 3. Recent Posts Table --}}
    <div class="bg-white border border-gray-100 rounded-3xl shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-50 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h3 class="font-serif font-bold text-gray-800 text-xl">Riwayat Tulisan</h3>
                <p class="text-gray-500 text-xs mt-1">Daftar cerita perjalanan yang telah Anda buat.</p>
            </div>
            <a href="{{ route('user.posts.index') }}"
                class="text-sm font-bold text-teal-600 hover:text-teal-700 flex items-center group">
                Lihat Semua <i class="icon-arrow-right ml-1 transform group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm whitespace-nowrap">
                <thead class="bg-gray-50 text-gray-500 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 font-bold uppercase tracking-wider text-[10px]">Judul Cerita</th>
                        <th class="px-6 py-4 font-bold uppercase tracking-wider text-[10px]">Tanggal</th>
                        <th class="px-6 py-4 font-bold uppercase tracking-wider text-[10px]">Status</th>
                        <th class="px-6 py-4 font-bold uppercase tracking-wider text-[10px] text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse(Auth::user()->posts()->latest()->take(5)->get() as $post)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="font-bold text-gray-900 max-w-xs truncate">{{ $post->title }}</div>
                            </td>
                            <td class="px-6 py-4 text-gray-500 text-xs">
                                <i class="icon-calendar mr-1"></i> {{ $post->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4">
                                @if ($post->status == 'approved')
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-green-100 text-green-700">
                                        Published
                                    </span>
                                @elseif($post->status == 'rejected')
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-red-100 text-red-700">
                                        Rejected
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-yellow-100 text-yellow-700">
                                        Pending
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('user.posts.edit', $post->id) }}"
                                    class="text-gray-400 hover:text-teal-600 font-bold text-xs transition-colors">
                                    Edit
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-400">
                                    <div class="h-12 w-12 bg-gray-50 rounded-full flex items-center justify-center mb-3">
                                        <i class="icon-pencil text-xl text-gray-300"></i>
                                    </div>
                                    <p class="font-medium text-gray-500 text-sm">Belum ada cerita yang dibuat.</p>
                                    <a href="{{ route('user.posts.create') }}"
                                        class="text-teal-600 hover:underline text-xs mt-1">Buat cerita pertamamu!</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
