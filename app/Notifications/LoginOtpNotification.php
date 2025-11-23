<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class LoginOtpNotification extends Notification
{
    use Queueable;

    public function __construct(public string $code)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Kode OTP Login')
            ->line('Gunakan kode berikut untuk menyelesaikan proses login:')
            ->line('')
            ->line('Kode OTP: **' . $this->code . '**')
            ->line('Kode berlaku 5 menit.')
            ->line('Jika Anda tidak mencoba login, abaikan email ini.');
    }
}
