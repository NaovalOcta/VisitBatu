<x-mail::message>
    <p class="greeting">Halo {{ $post->user->name }},</p>

    @if ($status === 'approved')
        ## Selamat! Cerita Anda Telah Terbit 🎉

        Kami senang memberi tahu Anda bahwa cerita petualangan Anda yang berjudul **"{{ $post->title }}"** telah
        disetujui dan kini tayang di **VisitBatu**.

        <x-mail::button :url="route('blog-page.show', $post->slug)">
            Lihat Cerita Anda
        </x-mail::button>
    @else
        ## Cerita Anda Memerlukan Perbaikan 📝

        Terima kasih telah berbagi cerita di **VisitBatu**. Tim kami telah meninjau cerita Anda yang berjudul
        **"{{ $post->title }}"**.

        Sayangnya, cerita Anda memerlukan beberapa perbaikan sebelum dapat dipublikasikan. Silakan periksa kembali
        dashboard Anda untuk melakukan pembaruan.

        <x-mail::button :url="route('user.dashboard')">
            Ke Dashboard
        </x-mail::button>
    @endif

    <div class="signature">
        <p>Salam hangat,</p>
        <p><strong>Tim VisitBatu</strong></p>
    </div>
</x-mail::message>
