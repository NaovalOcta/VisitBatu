<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OtpNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected string $otp;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $otp)
    {
        $this->otp = $otp;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Kode Verifikasi VisitBatu - ' . $this->otp)
            ->greeting('Halo ' . $notifiable->name . '!')
            ->line('Anda menerima email ini karena ada permintaan login ke akun VisitBatu Anda.')
            ->line('Berikut adalah kode verifikasi Anda:')
            ->line('**' . $this->otp . '**')
            ->line('Kode ini berlaku selama 5 menit.')
            ->line('Jika Anda tidak merasa melakukan login, abaikan email ini.')
            ->salutation('Salam hangat, Tim VisitBatu');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'otp' => $this->otp,
        ];
    }
}
