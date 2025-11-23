<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
use App\Models\Laporan;

class LaporanStatusChanged extends Notification
{
    use Queueable;

    public Laporan $laporan;
    public string $oldStatus;
    public string $newStatus;

    public function __construct(Laporan $laporan, string $oldStatus, string $newStatus)
    {
        $this->laporan = $laporan;
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Perubahan Status Laporan')
                    ->greeting('Halo ' . ($notifiable->name ?? ''))
                    ->line("Laporan dengan ID: {$this->laporan->id} telah berubah status.")
                    ->line("Status lama: {$this->oldStatus}")
                    ->line("Status baru: {$this->newStatus}")
                    ->action('Lihat Laporan', url('/laporan/' . $this->laporan->id))
                    ->line('Terima kasih telah menggunakan HijauIN.');
    }

    public function toDatabase($notifiable)
    {
        return [
            'laporan_id' => $this->laporan->id,
            'old_status' => $this->oldStatus,
            'new_status' => $this->newStatus,
            'message' => "Status laporan berubah dari {$this->oldStatus} ke {$this->newStatus}",
        ];
    }
}
