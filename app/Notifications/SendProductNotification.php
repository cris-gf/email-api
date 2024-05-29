<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendProductNotification extends Notification
{
    use Queueable;

    public array $details;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array
     */
    public function via(): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @return MailMessage
     */
    public function toMail(): MailMessage
    {
        return (new MailMessage)
            ->subject('Envío Producto')
            ->greeting('Nuevo Envío de Producto')
            ->line('Se ha enviado el producto:')
            ->line('Código: '.$this->details['productCode'])
            ->line('Nombre: '.$this->details['productName'])
            ->line('Cantidad: '.$this->details['quantity'])
            ->line('Precio: '.$this->details['amount'])
            ->salutation('Saludos, DC');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            //
        ];
    }
}
