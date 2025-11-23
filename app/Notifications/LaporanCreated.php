<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Laporan;

class LaporanCreated extends Notification
{
    use Queueable;

    public function __construct(public Laporan $laporan) {}

    public function via($notifiable): array
    {
        return ['database','mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Laporan Baru Diterima')
            ->line('Sebuah laporan baru telah dibuat oleh: '.$this->laporan->nama_pelapor)
            ->line('Lokasi: '.$this->laporan->lokasi)
            ->action('Lihat Laporan', url('/laporan/'.$this->laporan->id));
    }

    public function toDatabase($notifiable): array
    {
        return [
            'laporan_id' => $this->laporan->id,
            'message' => 'Laporan baru dari '.$this->laporan->nama_pelapor,
            'lokasi' => $this->laporan->lokasi,
        ];
    }
}