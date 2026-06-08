@extends('layouts.app')

@section('title', $post->title . ' - Cerita Perjalanan VisitBatu')

@section('content')
    {{-- 1. HERO SECTION (Konsisten dengan Trip & Contact Page) --}}
    <div class="relative bg-primary-900 dark:bg-night-950 pt-32 pb-32 overflow-hidden transition-colors duration-300">
        {{-- Background Blobs --}}
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-white opacity-5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-64 h-64 bg-accent-500 opacity-10 rounded-full blur-3xl"></div>

        <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            {{-- Breadcrumb / Meta --}}
            <div class="flex items-center justify-center gap-3 text-primary-100 text-sm mb-6 font-medium tracking-wide">
                <a href="{{ route('blog-page.index') }}" class="hover:text-white transition">Blog</a>
                <span class="opacity-50">/</span>
                <span class="text-accent-400">{{ $post->created_at->format('d M Y') }}</span>
            </div>

            <h1 class="font-serif text-3xl md:text-5xl lg:text-6xl font-bold text-white mb-8 leading-tight">
                {{ $post->title }}
            </h1>

            {{-- Author Info (Centered in Hero) --}}
            <div class="flex items-center justify-center gap-4">
                <div class="w-12 h-12 rounded-full bg-white/10 p-1">
                    {{-- Avatar Placeholder / Initials --}}
                    <div
                        class="w-full h-full rounded-full bg-accent-400 flex items-center justify-center text-primary-900 font-bold text-lg">
                        {{ substr($post->user->name, 0, 1) }}
                    </div>
                </div>
                <div class="text-left">
                    <p class="text-white font-bold text-sm">Ditulis oleh {{ $post->user->name }}</p>
                    <p class="text-primary-500 text-xs">Wisatawan VisitBatu</p>
                </div>
            </div>
        </div>
    </div>

    {{-- 2. MAIN CONTENT --}}
    <div class="bg-gray-50 dark:bg-night-900 min-h-screen relative mt-16 pb-20 z-20 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

                {{-- KOLOM KIRI: Konten Artikel --}}
                <div class="lg:col-span-2 space-y-8">

                    {{-- Featured Image --}}
                    @if ($post->image)
                        <div class="bg-white dark:bg-night-800 p-2 rounded-[2rem] shadow-xl transition-colors duration-300">
                            <div class="relative aspect-video rounded-[1.5rem] overflow-hidden">
                                <img src="{{ Str::startsWith($post->image, 'http') ? $post->image : asset('storage/' . $post->image) }}"
                                    alt="{{ $post->title }}" class="w-full h-full object-cover">
                            </div>
                        </div>
                    @endif

                    {{-- Article Text --}}
                    <div class="bg-white dark:bg-night-800 rounded-3xl p-8 md:p-12 shadow-sm border border-gray-100 dark:border-night-700/50 transition-colors duration-300">
                        <div class="prose prose-lg prose-teal max-w-none text-gray-600 dark:text-white/70 dark:prose-invert leading-loose font-sans">
                            {!! nl2br(e($post->content)) !!}
                        </div>

                        {{-- Tags / Footer Artikel --}}
                        <div class="mt-10 pt-6 border-t border-gray-100 dark:border-night-700/50 flex items-center justify-between">
                            <span class="text-sm text-gray-400 dark:text-white/50">Bagikan cerita ini:</span>
                            <div class="flex gap-3">
                                <button
                                    class="w-8 h-8 rounded-full bg-gray-100 dark:bg-night-700 flex items-center justify-center text-gray-500 dark:text-white/50 hover:bg-blue-500 hover:text-white dark:hover:text-white transition"><i
                                        class="icon-facebook"></i></button>
                                <button
                                    class="w-8 h-8 rounded-full bg-gray-100 dark:bg-night-700 flex items-center justify-center text-gray-500 dark:text-white/50 hover:bg-sky-500 hover:text-white dark:hover:text-white transition"><i
                                        class="icon-twitter"></i></button>
                                <button
                                    class="w-8 h-8 rounded-full bg-gray-100 dark:bg-night-700 flex items-center justify-center text-gray-500 dark:text-white/50 hover:bg-green-500 hover:text-white dark:hover:text-white transition"><i
                                        class="icon-whatsapp"></i></button>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- KOLOM KANAN: Sidebar Sticky --}}
                <div class="lg:col-span-1">
                    <div class="sticky top-28 space-y-8">

                        {{-- Widget 1: Terkait Destinasi (Jika user me-mention trip) --}}
                        @if ($post->trip)
                            <div class="bg-white dark:bg-night-800 rounded-3xl p-6 shadow-lg border border-teal-100 dark:border-teal-900/50 relative overflow-hidden transition-colors duration-300">
                                <div class="absolute top-0 right-0 w-16 h-16 bg-teal-50 dark:bg-teal-900/20 rounded-bl-full -mr-4 -mt-4"></div>

                                <h4 class="font-bold text-gray-900 dark:text-white mb-4 relative z-10">Destinasi Terkait</h4>

                                <div class="flex gap-4 items-start">
                                    <img src="{{ Str::startsWith($post->trip->thumbnail, 'http') ? $post->trip->thumbnail : asset('storage/' . $post->trip->thumbnail) }}"
                                        class="w-20 h-20 rounded-xl object-cover shrink-0">
                                    <div>
                                        <h5 class="font-bold text-sm text-gray-800 dark:text-white/80 line-clamp-2 mb-1">
                                            {{ $post->trip->title }}</h5>
                                        <p class="text-xs text-teal-600 dark:text-teal-400 font-bold mb-2">IDR
                                            {{ number_format($post->trip->price, 0, ',', '.') }}</p>
                                        <a href="{{ route('trips-page.show', $post->trip->slug) }}"
                                            class="text-xs text-gray-500 dark:text-white/50 hover:text-teal-600 dark:hover:text-teal-400 underline">Lihat Detail →</a>
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- Widget 2: Cerita Terbaru --}}
                        <div class="bg-white dark:bg-night-800 rounded-3xl p-8 shadow-sm border border-gray-100 dark:border-night-700/50 transition-colors duration-300">
                            <h4 class="font-serif text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-2">
                                <span class="w-1 h-6 bg-accent-400 rounded-full block"></span>
                                Baca Juga
                            </h4>

                            <div class="space-y-6">
                                @forelse($recentPosts as $recent)
                                    <a href="{{ route('blog.show', $recent->slug) }}" class="group block">
                                        <div class="flex gap-4">
                                            <div class="w-16 h-16 rounded-xl overflow-hidden shrink-0 bg-gray-100 dark:bg-night-700">
                                                @if ($recent->image)
                                                    <img src="{{ Str::startsWith($recent->image, 'http') ? $recent->image : asset('storage/' . $recent->image) }}"
                                                        class="w-full h-full object-cover group-hover:scale-110 transition">
                                                @endif
                                            </div>
                                            <div>
                                                <h5
                                                    class="font-bold text-sm text-gray-800 dark:text-white/80 group-hover:text-teal-600 dark:group-hover:text-teal-400 transition line-clamp-2 mb-1">
                                                    {{ $recent->title }}
                                                </h5>
                                                <p class="text-xs text-gray-400 dark:text-white/50">{{ $recent->created_at->diffForHumans() }}
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                @empty
                                    <p class="text-sm text-gray-400">Belum ada cerita lainnya.</p>
                                @endforelse
                            </div>
                        </div>

                        {{-- Widget 3: CTA Write Story --}}
                        <div class="bg-primary-900 dark:bg-night-950 rounded-3xl p-8 text-center text-white relative overflow-hidden transition-colors duration-300">
                            <div class="absolute inset-0 bg-pattern opacity-10"></div>
                            <i class="icon-pencil text-4xl text-accent-400 mb-4 block relative z-10"></i>
                            <h4 class="font-serif text-xl font-bold mb-2 relative z-10">Punya Cerita Seru?</h4>
                            <p class="text-primary-100 text-sm mb-6 relative z-10">Bagikan pengalaman liburanmu di Batu
                                kepada ribuan pembaca lainnya.</p>
                            <a href="{{ route('user.posts.create') }}"
                                class="inline-block px-6 py-3 bg-white text-primary-900 font-bold rounded-full text-sm hover:bg-accent-400 hover:text-white transition relative z-10 shadow-lg">
                                Tulis Cerita
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
