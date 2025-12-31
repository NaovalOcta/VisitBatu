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
                                <div class="flex items-center justify-end gap-2">
                                    {{-- TOMBOL PREVIEW (BARU) --}}
                                    {{-- Kita simpan konten di atribut data agar bisa diambil JS --}}
                                    <button onclick="openPreviewModal(this)" data-title="{{ $post->title }}"
                                        data-author="{{ $post->user->name ?? 'User' }}"
                                        data-date="{{ $post->created_at->format('d M Y') }}"
                                        data-image="{{ Str::startsWith($post->image, 'http') ? $post->image : asset('storage/' . $post->image) }}"
                                        {{-- Kita gunakan trik hidden div untuk konten agar HTML tag tetap aman --}} data-content-id="post-content-{{ $post->id }}"
                                        class="inline-flex items-center justify-center px-3 py-2 bg-blue-50 text-blue-600 rounded-lg border border-blue-200 hover:bg-blue-100 transition-all shadow-sm"
                                        title="Lihat Preview">
                                        <i class="icon-eye"></i>
                                    </button>

                                    {{-- Hidden Content Storage (Untuk dibaca JavaScript) --}}
                                    <div id="post-content-{{ $post->id }}" class="hidden">
                                        {!! $post->content !!}
                                    </div>

                                    {{-- Logic Tombol Approve/Reject yang sudah ada --}}
                                    @if ($post->status == 'pending')
                                        <form action="{{ route('admin.posts.approve', $post->slug) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            <button type="submit"
                                                class="inline-flex items-center justify-center px-3 py-2 bg-teal-50 text-teal-600 rounded-lg border border-teal-200 hover:bg-teal-100 hover:border-teal-300 transition-all shadow-sm mx-1"
                                                title="Setujui">
                                                <i class="icon-check"></i>
                                            </button>
                                        </form>

                                        <form action="{{ route('admin.posts.reject', $post->slug) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            <button type="submit"
                                                class="inline-flex items-center justify-center px-3 py-2 bg-white text-gray-500 rounded-lg border border-gray-200 hover:bg-red-50 hover:text-red-600 hover:border-red-200 transition-all shadow-sm"
                                                title="Tolak">
                                                <i class="icon-close"></i>
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-xs font-medium text-gray-400 italic ml-2">
                                            {{ ucfirst($post->status) }}
                                        </span>
                                    @endif
                                </div>
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

{{-- MODAL PREVIEW (Dengan Animasi) --}}
{{-- Container utama tetap hidden di awal --}}
<div id="previewModal" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true">

    {{--
      BACKDROP
      - opacity-0: Awalnya transparan
      - transition-opacity duration-300: Animasi fading halus
    --}}
    <div id="modalBackdrop"
        class="fixed inset-0 bg-gray-900/30 backdrop-blur-sm transition-opacity duration-300 opacity-0"
        onclick="closePreviewModal()">
    </div>

    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">

            {{--
              PANEL MODAL
              - opacity-0 scale-95: Awalnya transparan & agak kecil (zoom out)
              - transition-all duration-300 ease-out: Animasi zoom in yang mulus
            --}}
            <div id="modalPanel"
                class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all duration-300 ease-out opacity-0 scale-95 sm:my-8 sm:w-full sm:max-w-3xl">

                {{-- Header --}}
                <div class="bg-gray-50 px-4 py-3 sm:px-6 flex justify-between items-center border-b border-gray-100">
                    <h3 class="text-lg font-bold leading-6 text-gray-900" id="modalTitle">Judul Postingan</h3>
                    <button type="button" onclick="closePreviewModal()"
                        class="text-gray-400 hover:text-gray-500 hover:bg-gray-100 rounded-full p-1 transition-colors">
                        <i class="icon-close text-xl"></i>
                    </button>
                </div>

                {{-- Body (Sama seperti sebelumnya) --}}
                <div class="px-4 py-5 sm:p-6 max-h-[70vh] overflow-y-auto custom-scrollbar">
                    <div class="flex items-center gap-2 text-xs text-gray-500 mb-4">
                        <span id="modalAuthor" class="font-bold text-teal-600">Author</span>
                        <span>•</span>
                        <span id="modalDate">Date</span>
                    </div>

                    <div class="mb-6 rounded-xl overflow-hidden bg-gray-100 w-full h-64 relative group">
                        <img id="modalImage" src=""
                            class="w-full h-full object-cover transition-transform duration-700 hover:scale-105">
                        <div id="noImagePlaceholder"
                            class="hidden absolute inset-0 flex items-center justify-center text-gray-400">
                            <span class="text-sm">Tidak ada gambar</span>
                        </div>
                    </div>

                    <div id="modalContent" class="prose max-w-none text-gray-700 leading-relaxed font-light"></div>
                </div>

                {{-- Footer --}}
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <button type="button" onclick="closePreviewModal()"
                        class="mt-3 inline-flex w-full justify-center rounded-full bg-white px-5 py-2 text-sm font-bold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 hover:text-teal-600 transition-colors sm:mt-0 sm:w-auto">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const modal = document.getElementById('previewModal');
    const backdrop = document.getElementById('modalBackdrop');
    const panel = document.getElementById('modalPanel');

    function openPreviewModal(button) {
        // 1. Isi Data (Sama seperti sebelumnya)
        const title = button.getAttribute('data-title');
        const author = button.getAttribute('data-author');
        const date = button.getAttribute('data-date');
        const imageSrc = button.getAttribute('data-image');
        const contentId = button.getAttribute('data-content-id');
        const contentHtml = document.getElementById(contentId).innerHTML;

        document.getElementById('modalTitle').innerText = title;
        document.getElementById('modalAuthor').innerText = author;
        document.getElementById('modalDate').innerText = date;
        document.getElementById('modalContent').innerHTML = contentHtml;

        const imgElement = document.getElementById('modalImage');
        const placeholder = document.getElementById('noImagePlaceholder');

        if (imageSrc && imageSrc !== 'null' && !imageSrc.endsWith('/')) {
            imgElement.src = imageSrc;
            imgElement.classList.remove('hidden');
            placeholder.classList.add('hidden');
        } else {
            imgElement.classList.add('hidden');
            placeholder.classList.remove('hidden');
        }

        // 2. TAMPILKAN MODAL (ANIMASI MASUK)
        // Hapus class hidden dulu agar elemen ada di DOM
        modal.classList.remove('hidden');

        // Gunakan timeout kecil agar transisi CSS terdeteksi perubahannya
        setTimeout(() => {
            // Backdrop: Fade In
            backdrop.classList.remove('opacity-0');

            // Panel: Zoom In ke ukuran asli (scale-100) & Fade In
            panel.classList.remove('opacity-0', 'scale-95');
            panel.classList.add('opacity-100', 'scale-100');
        }, 10);

        document.body.style.overflow = 'hidden';
    }

    function closePreviewModal() {
        // 3. SEMBUNYIKAN MODAL (ANIMASI KELUAR)

        // Backdrop: Fade Out
        backdrop.classList.add('opacity-0');

        // Panel: Zoom Out sedikit (scale-95) & Fade Out
        panel.classList.remove('opacity-100', 'scale-100');
        panel.classList.add('opacity-0', 'scale-95');

        // Tunggu animasi selesai (300ms sesuai duration-300 di CSS), baru kasih hidden
        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }, 300);
    }
</script>
