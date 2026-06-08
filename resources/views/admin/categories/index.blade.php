@extends('layouts.admin')

@section('page_title', 'Kategori Wisata')

@section('admin_content')
    {{-- Header & Action --}}
    {{-- Header & Action --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h2 class="font-serif text-2xl font-bold text-gray-800 dark:text-white">Kategori Wisata</h2>
            <p class="text-gray-500 dark:text-white/60 text-sm">Kelola kategori untuk mengelompokkan paket wisata.</p>
        </div>
        <a href="{{ route('admin.categories.create') }}"
            class="inline-flex items-center justify-center px-6 py-3 bg-teal-600 hover:bg-teal-700 text-white text-sm font-bold rounded-full shadow-lg hover:shadow-teal-500/30 transition-all transform hover:-translate-y-0.5">
            <i class="icon-plus mr-2"></i> Tambah Kategori
        </a>
    </div>

    {{-- Flash Message --}}
    @if (session('success'))
        <div class="mb-6 p-4 rounded-2xl bg-teal-50 dark:bg-green-950/20 border border-teal-100 dark:border-green-900/45 text-teal-800 dark:text-white/80 flex items-center gap-3">
            <div class="bg-teal-100 dark:bg-green-900/40 rounded-full p-1">
                <i class="icon-check text-sm"></i>
            </div>
            <span class="font-medium text-sm">{{ session('success') }}</span>
        </div>
    @endif

    {{-- Table Container --}}
    <div class="bg-white dark:bg-night-800 border border-gray-100 dark:border-night-700/50 rounded-3xl shadow-sm overflow-hidden max-w-4xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm whitespace-nowrap">
                <thead class="bg-gray-50 dark:bg-night-900 text-gray-500 dark:text-white/50 border-b border-gray-100 dark:border-night-700/50">
                    <tr>
                        <th class="px-6 py-4 font-bold uppercase tracking-wider text-xs w-16">No</th>
                        <th class="px-6 py-4 font-bold uppercase tracking-wider text-xs">Nama Kategori</th>
                        <th class="px-6 py-4 font-bold uppercase tracking-wider text-xs">Slug</th>
                        <th class="px-6 py-4 font-bold uppercase tracking-wider text-xs text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 dark:divide-night-700/50">
                    @forelse($categories as $index => $category)
                        <tr class="hover:bg-gray-50/60 dark:hover:bg-night-900/50 transition-colors group">
                            <td class="px-6 py-4 text-gray-400 dark:text-white/50">
                                {{ $categories->firstItem() + $index }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-bold text-gray-900 dark:text-white text-base">{{ $category->name }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-block px-2 py-1 bg-gray-100 dark:bg-night-900 rounded text-xs text-gray-500 dark:text-white/60 font-mono">
                                    {{ $category->slug }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.categories.edit', $category->id) }}"
                                        class="p-2 text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-950/20 rounded-lg transition-colors border border-transparent hover:border-blue-100 dark:hover:border-blue-900/40"
                                        title="Edit">
                                        <i class="icon-pencil"></i>
                                    </a>

                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini? Data wisata terkait mungkin akan kehilangan kategorinya.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="p-2 text-red-500 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-950/20 rounded-lg transition-colors border border-transparent hover:border-red-100 dark:hover:border-red-900/40"
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
                                <div class="flex flex-col items-center justify-center text-gray-400 dark:text-white/50">
                                    <div class="h-16 w-16 bg-gray-50 dark:bg-night-900 rounded-full flex items-center justify-center mb-3">
                                        <i class="icon-folder-open text-2xl text-gray-300 dark:text-white/50"></i>
                                    </div>
                                    <p class="font-medium text-gray-500 dark:text-white/60">Belum ada kategori.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if ($categories->hasPages())
            <div class="px-6 py-4 border-t border-gray-100 dark:border-night-700 bg-gray-50/50 dark:bg-night-900/30">
                {{ $categories->links() }}
            </div>
        @endif
    </div>
@endsection
