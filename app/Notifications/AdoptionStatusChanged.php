<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Adoption;

class AdoptionStatusChanged extends Notification
{
    use Queueable;

    protected $adoption;
    protected $status;

    /**
     * Create a new notification instance.
     */
    public function __construct(Adoption $adoption)
    {
        $this->adoption = $adoption;
        $this->status = $adoption->status;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $message = (new MailMessage)
            ->subject('Update Status Adopsi Kucing ' . $this->adoption->cat->name);

        if ($this->status === 'approved') {
            $message->line('Selamat! Permintaan adopsi Anda untuk kucing ' . $this->adoption->cat->name . ' telah disetujui.')
                ->line('Anda sekarang dapat mengunduh sertifikat adopsi dari dashboard Anda.')
                ->action('Lihat Dashboard', url('/dashboard'));
        } elseif ($this->status === 'rejected') {
            $message->line('Maaf, permintaan adopsi Anda untuk kucing ' . $this->adoption->cat->name . ' tidak disetujui.')
                ->line('Ini mungkin karena beberapa alasan, seperti penilaian kesesuaian atau ada banyak pengadopsi lain yang mengajukan.')
                ->line('Anda dapat mencoba mengadopsi kucing lain yang tersedia di PawTopia.')
                ->action('Lihat Kucing Lainnya', url('/cats'));
        } else {
            $message->line('Status permintaan adopsi Anda untuk kucing ' . $this->adoption->cat->name . ' telah diperbarui.')
                ->line('Status saat ini: ' . ucfirst($this->status))
                ->action('Lihat Detail', url('/dashboard'));
        }

        return $message->line('Terima kasih telah menggunakan PawTopia!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $titles = [
            'approved' => 'Permintaan Adopsi Disetujui!',
            'rejected' => 'Permintaan Adopsi Ditolak',
            'pending' => 'Permintaan Adopsi Sedang Diproses'
        ];

        $messages = [
            'approved' => 'Selamat! Permintaan adopsi Anda untuk kucing ' . $this->adoption->cat->name . ' telah disetujui. Anda dapat mengunduh sertifikat adopsi sekarang.',
            'rejected' => 'Maaf, permintaan adopsi Anda untuk kucing ' . $this->adoption->cat->name . ' tidak disetujui. Silakan coba kucing lain yang tersedia.',
            'pending' => 'Permintaan adopsi Anda untuk kucing ' . $this->adoption->cat->name . ' sedang dalam proses peninjauan.'
        ];

        return [
            'title' => $titles[$this->status] ?? 'Update Status Adopsi',
            'message' => $messages[$this->status] ?? 'Status adopsi Anda telah diperbarui menjadi ' . ucfirst($this->status),
            'adoption_id' => $this->adoption->id,
            'cat_name' => $this->adoption->cat->name,
            'status' => $this->status
        ];
    }
}
