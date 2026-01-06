<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TransactionNotification extends Notification
{
    use Queueable;

    public $transaction;

    public function __construct($transaction)
    {
        $this->transaction = $transaction;
    }

    public function via($notifiable)
    {
        return ['mail']; // Menggunakan channel mail
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Notifikasi Transaksi Baru - #' . $this->transaction->reference)
            ->greeting('Halo, ' . $notifiable->name)
            ->line('Ada transaksi baru yang masuk.')
            ->line('Total: Rp ' . number_format($this->transaction->total_price, 0, ',', '.'))
            ->action('Lihat Detail Transaksi', url('/admin/transactions'))
            ->line('Terima kasih telah menggunakan layanan kami!');
    }
}