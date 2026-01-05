@extends('layouts.user')

@section('user_content')
    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h2 class="font-serif text-3xl font-bold text-gray-900">Cerita Saya 📚</h2>
            <p class="text-gray-500 text-sm mt-1">Kelola semua pengalaman perjalanan yang sudah Anda tulis.</p>
        </div>
        <a href="{{ route('user.posts.create') }}"
            class="inline-flex items-center justify-center px-6 py-3 bg-teal-600 hover:bg-teal-700 text-white text-sm font-bold rounded-full shadow-lg hover:shadow-teal-500/30 transition-all transform hover:-translate-y-0.5">
            <i class="icon-plus mr-2"></i> Tulis Cerita Baru
        </a>
    </div>

    {{-- Tabel Daftar Cerita --}}
    <div class="bg-white border border-gray-100 rounded-3xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm whitespace-nowrap">
                <thead class="bg-gray-50 text-gray-500 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 font-bold uppercase tracking-wider text-[10px]">Foto & Judul</th>
                        <th class="px-6 py-4 font-bold uppercase tracking-wider text-[10px]">Tanggal Dibuat</th>
                        <th class="px-6 py-4 font-bold uppercase tracking-wider text-[10px]">Lokasi</th>
                        <th class="px-6 py-4 font-bold uppercase tracking-wider text-[10px]">Status</th>
                        <th class="px-6 py-4 font-bold uppercase tracking-wider text-[10px] text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($posts as $post)
                        <tr class="hover:bg-gray-50/50 transition-colors group">
                            {{-- Kolom 1: Foto & Judul --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="h-12 w-16 flex-shrink-0 overflow-hidden rounded-lg bg-gray-100 border border-gray-200 relative">
                                        @if ($post->image)
                                            <img src="{{ asset('storage/' . $post->image) }}"
                                                class="h-full w-full object-cover">
                                        @else
                                            <div class="h-full w-full flex items-center justify-center text-gray-300">
                                                <i class="icon-image"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="font-bold text-gray-900 max-w-xs truncate">{{ $post->title }}</div>
                                        <a href="{{ route('user.posts.show', $post) }}"
                                            class="text-[10px] text-teal-600 hover:underline font-bold">
                                            Lihat Preview ↗
                                        </a>
                                    </div>
                                </div>
                            </td>

                            {{-- Kolom 2: Tanggal --}}
                            <td class="px-6 py-4 text-gray-500 text-xs">
                                <span class="flex items-center gap-2">
                                    <i class="icon-calendar text-gray-400"></i> {{ $post->created_at->format('d M Y') }}
                                </span>
                            </td>

                            {{-- Kolom 3: Lokasi --}}
                            <td class="px-6 py-4 text-gray-500 text-xs">
                                <span class="flex items-center gap-2">
                                    @if ($post->trip)
                                        <i class="icon-map-marker text-gray-400"></i> {{ $post->trip->title }}
                                    @else
                                        <i class="icon-map-marker text-gray-400"></i> Tidak ada lokasi
                                    @endif
                                </span>
                            </td>

                            {{-- Kolom 4: Status --}}
                            <td class="px-6 py-4">
                                @if ($post->status == 'approved')
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold bg-green-100 text-green-700 border border-green-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500 mr-1.5"></span> Published
                                    </span>
                                @elseif($post->status == 'rejected')
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold bg-red-100 text-red-700 border border-red-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-500 mr-1.5"></span> Rejected
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold bg-yellow-100 text-yellow-700 border border-yellow-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-yellow-500 mr-1.5"></span> Pending
                                    </span>
                                @endif
                            </td>

                            {{-- Kolom 5: Aksi --}}
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    {{-- Tombol Edit --}}
                                    <a href="{{ route('user.posts.edit', $post) }}"
                                        class="h-8 w-8 flex items-center justify-center rounded-full border border-gray-200 text-gray-500 hover:text-teal-600 hover:border-teal-200 hover:bg-teal-50 transition-all"
                                        title="Edit">
                                        <i class="icon-pencil text-xs"></i>
                                    </a>

                                    {{-- Tombol Hapus --}}
                                    <form action="{{ route('user.posts.destroy', $post) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus cerita ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="h-8 w-8 flex items-center justify-center rounded-full border border-gray-200 text-gray-500 hover:text-red-600 hover:border-red-200 hover:bg-red-50 transition-all"
                                            title="Hapus">
                                            <i class="icon-trash text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="h-16 w-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                        <i class="icon-pencil text-2xl text-gray-300"></i>
                                    </div>
                                    <h3 class="text-gray-900 font-bold mb-1">Belum ada cerita</h3>
                                    <p class="text-gray-500 text-xs mb-4">Mulai bagikan pengalaman perjalanan Anda sekarang.
                                    </p>
                                    <a href="{{ route('user.posts.create') }}"
                                        class="text-teal-600 hover:text-teal-700 text-xs font-bold underline">
                                        Buat cerita pertama
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
