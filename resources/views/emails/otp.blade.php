<x-mail::message>
    <p class="greeting">Halo {{ $userName }},</p>

    Anda menerima email ini karena ada permintaan untuk masuk ke akun **VisitBatu** Anda. Silakan gunakan kode
    verifikasi di bawah ini untuk melanjutkan:

    <div class="otp-container">
        <p class="otp-label">Kode Verifikasi Anda</p>
        <p class="otp-code">{{ $otp }}</p>
    </div>

    <div class="info-box">
        <p>⏱️ Kode ini berlaku selama <strong>5 menit</strong>. Jangan berikan kode ini kepada siapapun.</p>
    </div>

    <div class="security-note">
        <p>🔒 Jika Anda tidak merasa melakukan permintaan ini, silakan abaikan email ini. Akun Anda tetap aman.</p>
    </div>

    <div class="signature">
        <p>Salam hangat,</p>
        <p><strong>Tim VisitBatu</strong></p>
    </div>
</x-mail::message>
