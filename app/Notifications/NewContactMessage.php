<?php

namespace App\Notifications;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewContactMessage extends Notification
{
    use Queueable;

    protected $contact;

    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Pesan Baru dari Pengunjung Pawtopia')
            ->greeting('Halo Admin!')
            ->line('Anda menerima pesan baru dari situs Pawtopia.')
            ->line('Dari: ' . $this->contact->name)
            ->line('Email: ' . $this->contact->email)
            ->line('Subjek: ' . $this->contact->subject)
            ->line('Pesan: ' . $this->contact->message)
            ->action('Lihat Pesan', url('/admin/contacts/' . $this->contact->id))
            ->line('Terima kasih telah menggunakan aplikasi Pawtopia!');
    }

    public function toDatabase($notifiable)
    {
        return [
            'id' => $this->contact->id,
            'title' => 'Pesan Baru dari ' . $this->contact->name,
            'message' => 'Subjek: ' . $this->contact->subject,
            'time' => now()->format('d M Y H:i'),
            'url' => '/admin/contacts/' . $this->contact->id
        ];
    }
}
