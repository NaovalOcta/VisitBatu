<x-mail::message>
    <p class="greeting">Halo Admin,</p>

    Ada pesan baru yang masuk melalui formulir kontak di website **VisitBatu**.

    <x-mail::panel>
        ### Informasi Pengirim
        **Nama:** {{ $data['name'] }}
        <br>**Email:** {{ $data['email'] }}
        <br>**Subjek:** {{ $data['subject'] }}

        ### Isi Pesan
        {{ $data['message'] }}
    </x-mail::panel>

    Anda dapat membalas pesan ini langsung dengan membalas email ini.

    <div class="signature">
        <p>Salam,</p>
        <p><strong>Sistem VisitBatu</strong></p>
    </div>
</x-mail::message>
