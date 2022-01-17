<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Warranty;

class StatusWarranties extends Notification
{
    use Queueable;
    private $warranty;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Warranty $warranty)
    {
        $this->warranty = $warranty;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject ("Nova Atualização do Seu Produto : {$this->warranty->product->name}")
                    ->greeting("Olá, {$this->warranty->client->name}")
                    ->line($this->warranty->status->name)
                    ->line(  $this->warranty->status->description )
                    ->action('Notification Action', url('/'))
                    ->line('Aguarde para nova Atualização do Status do Seu Pedido !');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
