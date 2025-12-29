@extends('layouts.app')

@section('title', 'Travel Stories - VisitBatu')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-32 pb-16">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h1 class="font-serif text-6xl font-bold text-gray-900 mb-4">The Journal</h1>
            <p class="text-xl text-gray-500 font-light">Cerita, tips, dan panduan perjalanan untuk memaksimalkan liburan Anda
                di Kota Batu.</p>
        </div>

        <div class="relative rounded-3xl overflow-hidden shadow-2xl mb-16 group cursor-pointer h-[500px]">
            <img src="https://images.unsplash.com/photo-1596401057633-565652f56878?q=80&w=2070&auto=format&fit=crop"
                class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition duration-1000">
            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-transparent"></div>
            <div class="absolute bottom-0 p-8 md:p-12 max-w-4xl">
                <span
                    class="bg-accent-500 text-white px-3 py-1 rounded text-xs font-bold uppercase tracking-wider mb-4 inline-block">Must
                    Read</span>
                <h2 class="font-serif text-4xl md:text-5xl font-bold text-white mb-4 leading-tight">Panduan Lengkap Wisata
                    Kuliner Legendaris di Kota Batu 2024</h2>
                <div class="flex items-center gap-4 text-gray-300 text-sm">
                    <span class="flex items-center gap-2">
                        <div class="w-6 h-6 rounded-full bg-white/20"></div> Admin
                    </span>
                    <span>&bull;</span>
                    <span>10 Min Read</span>
                </div>
            </div>
            <a href="#" class="absolute inset-0 z-10"></a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-12">
            @forelse($posts ?? [] as $post)
                <article class="flex flex-col group h-full">
                    <div class="rounded-2xl overflow-hidden h-64 mb-6 shadow-md relative">
                        <img src="{{ $post->image }}"
                            class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                        <div
                            class="absolute top-4 left-4 bg-white px-3 py-1 rounded-full text-xs font-bold text-gray-900 shadow-sm">
                            Tips
                        </div>
                    </div>
                    <div class="flex-1 flex flex-col">
                        <div class="flex items-center gap-2 text-xs text-gray-500 mb-3 uppercase tracking-wide font-bold">
                            <span>{{ $post->created_at->format('M d, Y') }}</span>
                            <span class="text-accent-500">&mdash;</span>
                            <span>{{ $post->user->name }}</span>
                        </div>
                        <h3
                            class="font-serif text-2xl font-bold text-gray-900 mb-3 leading-snug group-hover:text-primary-700 transition">
                            <a href="#">{{ $post->title }}</a>
                        </h3>
                        <p class="text-gray-600 line-clamp-3 mb-4 font-light">{{ Str::limit($post->content, 150) }}</p>
                        <a href="#"
                            class="mt-auto text-primary-800 font-bold text-sm hover:text-accent-600 transition flex items-center gap-1">
                            Read Article <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>
                </article>
            @empty
                @for ($i = 0; $i < 6; $i++)
                    <article class="flex flex-col group">
                        <div class="rounded-2xl overflow-hidden h-64 mb-6 shadow-md bg-gray-200">
                            <img src="https://source.unsplash.com/random/800x600?nature,mountain&sig={{ $i }}"
                                class="w-full h-full object-cover opacity-80">
                        </div>
                        <div>
                            <span class="text-xs font-bold text-accent-600 uppercase">Travel Story</span>
                            <h3 class="font-serif text-2xl font-bold text-gray-900 mt-2 mb-3">Menjelajahi Keindahan Coban
                                Rondo di Pagi Hari</h3>
                            <p class="text-gray-500 font-light">Air terjun yang memukau dengan suasana hutan pinus yang
                                menenangkan...</p>
                        </div>
                    </article>
                @endfor
            @endforelse
        </div>
    </div>
@endsection
