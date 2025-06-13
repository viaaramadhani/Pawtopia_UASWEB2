<?php

namespace App\Notifications;

use App\Models\Adoption;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewAdoptionRequest extends Notification implements ShouldQueue
{
    use Queueable;

    protected $adoption;

    public function __construct(Adoption $adoption)
    {
        $this->adoption = $adoption;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Permintaan Adopsi Baru - ' . $this->adoption->cat->name)
            ->greeting('Halo Admin!')
            ->line('Ada permintaan adopsi baru yang memerlukan persetujuan Anda.')
            ->line('Kucing: ' . $this->adoption->cat->name)
            ->line('Pengadopsi: ' . $this->adoption->adopter_name)
            ->action('Tinjau Permintaan', url('/adoptions'))
            ->line('Terima kasih telah menggunakan Pawtopia!');
    }

    public function toDatabase($notifiable)
    {
        return [
            'id' => $this->adoption->id,
            'title' => 'Permintaan Adopsi Baru',
            'message' => 'Pengadopsi ' . $this->adoption->adopter_name . ' ingin mengadopsi kucing ' . $this->adoption->cat->name,
            'cat_id' => $this->adoption->cat_id,
            'time' => now()->format('d M Y H:i')
        ];
    }
}
