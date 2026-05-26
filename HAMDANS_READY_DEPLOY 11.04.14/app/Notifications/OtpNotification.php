<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OtpNotification extends Notification
{
    use Queueable;

    public function __construct(
        protected string $otpCode
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('🔐 Kode Verifikasi Login HAMDANS')
            ->greeting('Halo, ' . $notifiable->name . '!')
            ->line('Anda baru saja mencoba login ke sistem **HAMDANS (HAM Daily News)**.')
            ->line('Berikut adalah kode verifikasi Anda:')
            ->line('**' . $this->otpCode . '**')
            ->line('Kode ini berlaku selama **5 menit**. Jangan bagikan kode ini kepada siapapun.')
            ->line('Jika Anda tidak merasa melakukan login, abaikan email ini dan segera hubungi administrator.')
            ->salutation('Salam, Tim HAMDANS');
    }
}
