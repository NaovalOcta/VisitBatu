@extends('layouts.admin')

@section('page_title', 'Paket Wisata')

@section('admin_content')
    {{-- Header & Action --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h2 class="font-serif text-2xl font-bold text-gray-800">Daftar Wisata</h2>
            <p class="text-gray-500 text-sm">Kelola semua destinasi wisata yang ditampilkan di website.</p>
        </div>
        <a href="{{ route('admin.trips.create') }}"
            class="inline-flex items-center justify-center px-6 py-3 bg-teal-600 hover:bg-teal-700 text-white text-sm font-bold rounded-full shadow-lg hover:shadow-teal-500/30 transition-all transform hover:-translate-y-0.5">
            <i class="icon-plus mr-2"></i> Tambah Wisata
        </a>
    </div>

    {{-- Flash Message --}}
    @if (session('success'))
        <div class="mb-6 p-4 rounded-2xl bg-teal-50 border border-teal-100 text-teal-800 flex items-center gap-3">
            <div class="bg-teal-100 rounded-full p-1">
                <i class="icon-check text-sm"></i>
            </div>
            <span class="font-medium text-sm">{{ session('success') }}</span>
        </div>
    @endif

    {{-- Table Container --}}
    <div class="bg-white border border-gray-100 rounded-3xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm whitespace-nowrap">
                <thead class="bg-gray-50 text-gray-500 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 font-bold uppercase tracking-wider text-xs">Informasi Wisata</th>
                        <th class="px-6 py-4 font-bold uppercase tracking-wider text-xs">Lokasi</th>
                        <th class="px-6 py-4 font-bold uppercase tracking-wider text-xs">Harga Tiket</th>
                        <th class="px-6 py-4 font-bold uppercase tracking-wider text-xs text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($trips as $trip)
                        <tr class="hover:bg-gray-50/60 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    {{-- Thumbnail Image --}}
                                    <div
                                        class="h-16 w-24 flex-shrink-0 overflow-hidden rounded-xl border border-gray-100 shadow-sm">
                                        <img src="{{ asset('storage/' . $trip->thumbnail) }}" alt="{{ $trip->title }}"
                                            class="h-full w-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-gray-900 text-base mb-1">{{ $trip->title }}</h3>
                                        <div class="flex items-center gap-2">
                                            <span
                                                class="inline-block px-2 py-0.5 bg-gray-100 rounded text-[10px] font-bold text-gray-500 uppercase">Slug</span>
                                            <span
                                                class="text-gray-400 text-xs truncate max-w-[150px]">{{ $trip->slug }}</span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center text-gray-600">
                                    <i class="icon-map-marker text-red-400 mr-2"></i>
                                    {{ Str::limit($trip->location, 30) }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="font-bold text-teal-600 bg-teal-50 px-3 py-1 rounded-full border border-teal-100">
                                    Rp {{ number_format($trip->price, 0, ',', '.') }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.trips.edit', $trip->id) }}"
                                        class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors border border-transparent hover:border-blue-100"
                                        title="Edit">
                                        <i class="icon-pencil"></i>
                                    </a>

                                    <form action="{{ route('admin.trips.destroy', $trip->id) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors border border-transparent hover:border-red-100"
                                            title="Hapus">
                                            <i class="icon-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-400">
                                    <div class="h-16 w-16 bg-gray-50 rounded-full flex items-center justify-center mb-3">
                                        <i class="icon-image text-2xl text-gray-300"></i>
                                    </div>
                                    <p class="font-medium text-gray-500">Belum ada paket wisata.</p>
                                    <p class="text-xs mt-1">Silakan tambahkan data baru.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if ($trips->hasPages())
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
                {{ $trips->links() }}
                {{-- Catatan: Pastikan Anda sudah mempublish pagination vendor Laravel agar style Tailwind default-nya aktif,
                     atau biarkan default tapi dibungkus container ini agar rapi --}}
            </div>
        @endif
    </div>
@endsection
