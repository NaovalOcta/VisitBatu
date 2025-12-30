@extends('layouts.admin')

@section('page_title', 'Moderasi Blog')

@section('admin_content')
    <div class="mb-8">
        <h2 class="font-serif text-2xl font-bold text-gray-800">Cerita Pengguna</h2>
        <p class="text-gray-500 text-sm">Tinjau dan setujui cerita perjalanan yang dikirim oleh pengguna.</p>
    </div>

    <div class="bg-white border border-gray-100 rounded-3xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm whitespace-nowrap">
                <thead class="bg-gray-50 text-gray-500 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 font-bold uppercase tracking-wider text-xs w-1/3">Konten Postingan</th>
                        <th class="px-6 py-4 font-bold uppercase tracking-wider text-xs">Penulis</th>
                        <th class="px-6 py-4 font-bold uppercase tracking-wider text-xs">Status</th>
                        <th class="px-6 py-4 font-bold uppercase tracking-wider text-xs text-right">Aksi Moderasi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($posts as $post)
                        <tr class="hover:bg-gray-50/60 transition-colors">
                            <td class="px-6 py-4 whitespace-normal">
                                <div>
                                    <h3 class="font-bold text-gray-900 text-base mb-1 line-clamp-1">{{ $post->title }}</h3>
                                    <p class="text-gray-500 text-xs leading-relaxed line-clamp-2 mb-2">
                                        {{ Str::limit(strip_tags($post->content), 100) }}
                                    </p>
                                    <div class="flex items-center gap-2 text-[10px] text-gray-400">
                                        <i class="icon-clock-o"></i>
                                        {{ $post->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="h-8 w-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold text-xs border border-indigo-200">
                                        {{ substr($post->user->name, 0, 1) }}
                                    </div>
                                    <span class="font-medium text-gray-700">{{ $post->user->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if ($post->status == 'pending')
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-700 border border-yellow-200">
                                        <span class="w-2 h-2 rounded-full bg-yellow-500 mr-2"></span> Pending
                                    </span>
                                @elseif($post->status == 'approved')
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 border border-green-200">
                                        <span class="w-2 h-2 rounded-full bg-green-500 mr-2"></span> Approved
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700 border border-red-200">
                                        <span class="w-2 h-2 rounded-full bg-red-500 mr-2"></span> Rejected
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                @if ($post->status == 'pending')
                                    <div class="flex items-center justify-end gap-2">
                                        {{-- Approve Button --}}
                                        <form action="{{ route('admin.posts.approve', $post->id) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <button type="submit"
                                                class="flex items-center gap-1 px-3 py-1.5 bg-teal-50 text-teal-700 text-xs font-bold rounded-lg border border-teal-200 hover:bg-teal-100 hover:border-teal-300 transition-all shadow-sm"
                                                title="Setujui">
                                                <i class="icon-check"></i> Setuju
                                            </button>
                                        </form>

                                        {{-- Reject Button --}}
                                        <form action="{{ route('admin.posts.reject', $post->id) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <button type="submit"
                                                class="flex items-center gap-1 px-3 py-1.5 bg-white text-gray-500 text-xs font-bold rounded-lg border border-gray-200 hover:bg-red-50 hover:text-red-600 hover:border-red-200 transition-all shadow-sm"
                                                title="Tolak">
                                                <i class="icon-close"></i> Tolak
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <span class="text-xs font-medium text-gray-400 italic">
                                        Sudah diproses
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-400">
                                <div class="flex flex-col items-center">
                                    <i class="icon-folder-open-o text-3xl mb-2 opacity-50"></i>
                                    <p>Tidak ada data ditemukan.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
