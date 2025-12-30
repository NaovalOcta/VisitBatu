@extends('layouts.user')

@section('user_content')
    {{-- Top Bar --}}
    <div class="flex items-center justify-between mb-8">
        {{-- Tombol Kembali --}}
        {{-- Pastikan ini mengarah ke user.posts.index, BUKAN user.dashboard_user agar UX lebih logis --}}
        <a href="{{ route('user.posts.index') }}"
            class="group flex items-center text-sm font-bold text-gray-500 hover:text-teal-600 transition-colors">
            <span
                class="h-8 w-8 rounded-full bg-white border border-gray-200 flex items-center justify-center mr-3 group-hover:border-teal-400 transition-colors">
                <i class="icon-arrow-left"></i>
            </span>
            Kembali ke Daftar
        </a>

        {{-- Tombol Edit --}}
        <div class="flex gap-2">
            {{-- FIX: Gunakan $post->id, bukan $posts->id --}}
            <a href="{{ route('user.posts.edit', $post->id) }}"
                class="px-4 py-2 bg-white border border-gray-200 text-gray-700 text-sm font-bold rounded-full hover:bg-gray-50 hover:text-teal-600 transition-all shadow-sm">
                <i class="icon-pencil mr-2"></i> Edit
            </a>
        </div>
    </div>

    {{-- Content Container --}}
    <div
        class="bg-white rounded-[2.5rem] shadow-xl shadow-gray-100 overflow-hidden border border-gray-100 max-w-4xl mx-auto relative">

        {{-- Hero Image --}}
        <div class="h-64 md:h-96 w-full relative">
            {{-- FIX: Gunakan $post->image --}}
            @if ($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full bg-gradient-to-br from-teal-400 to-emerald-600 flex items-center justify-center">
                    <i class="icon-image text-white text-6xl opacity-50"></i>
                </div>
            @endif

            {{-- Status Badge Overlay --}}
            <div class="absolute top-6 right-6">
                {{-- FIX: Gunakan $post->status --}}
                @if ($post->status == 'approved')
                    <span
                        class="px-4 py-2 rounded-full bg-green-500 text-white text-xs font-bold shadow-lg flex items-center gap-2">
                        <i class="icon-check-circle"></i> Published
                    </span>
                @elseif($post->status == 'rejected')
                    <span
                        class="px-4 py-2 rounded-full bg-red-500 text-white text-xs font-bold shadow-lg flex items-center gap-2">
                        <i class="icon-times-circle"></i> Rejected
                    </span>
                @else
                    <span
                        class="px-4 py-2 rounded-full bg-yellow-400 text-yellow-900 text-xs font-bold shadow-lg flex items-center gap-2">
                        <i class="icon-clock-o"></i> Pending Review
                    </span>
                @endif
            </div>
        </div>

        {{-- Article Body --}}
        <div class="px-8 py-10 md:px-16 md:py-14">
            {{-- Meta Data --}}
            <div class="flex items-center gap-4 text-sm text-gray-400 mb-6 font-medium">
                <span class="flex items-center gap-2">
                    {{-- FIX: Gunakan $post->created_at --}}
                    <i class="icon-calendar text-teal-500"></i> {{ $post->created_at->format('d F Y') }}
                </span>
                <span class="h-1 w-1 rounded-full bg-gray-300"></span>
                <span class="flex items-center gap-2">
                    {{-- FIX: Gunakan $post->user --}}
                    <i class="icon-user text-teal-500"></i> {{ $post->user->name }}
                </span>
            </div>

            <h1 class="font-serif text-3xl md:text-5xl font-bold text-gray-900 mb-8 leading-tight">
                {{-- FIX: Gunakan $post->title --}}
                {{ $post->title }}
            </h1>

            <div class="prose prose-lg prose-teal max-w-none text-gray-600 leading-loose">
                {{-- FIX: Gunakan $post->content --}}
                {!! nl2br(e($post->content)) !!}
            </div>
        </div>

        <div class="bg-gray-50 px-8 py-6 border-t border-gray-100 text-center">
            <p class="text-xs text-gray-400">Preview Tampilan Artikel</p>
        </div>
    </div>
@endsection
