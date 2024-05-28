<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FormNotification extends Notification
{
    use Queueable;

    public $details;

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
            ->subject('Solicitud Producto')
            ->greeting('Nueva Solicitud Producto')
            ->line('Se ha recibido una solicitud de producto:')
            ->line('Nombre: '.$this->details['name'])
            ->line('Teléfono: '.$this->details['phone'])
            ->line('Email: '.$this->details['email'])
            ->line('Código del Producto: '.$this->details['productCode'])
            ->line('Nombre del Producto: '.$this->details['productName'])
            ->line('Cantidad del Producto: '.$this->details['quantity'])
            ->line('Precio del Producto: '.$this->details['amount'])
            //->action('Cancelar Cotización', $url)
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
