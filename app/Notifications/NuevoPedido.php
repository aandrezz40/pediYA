<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Order;

class NuevoPedido extends Notification
{
    use Queueable;

    protected $order;

    /**
     * Create a new notification instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('¡Nuevo pedido recibido! - PediYÁ')
            ->greeting('¡Hola ' . $notifiable->name . '!')
            ->line('Has recibido un nuevo pedido en tu tienda.')
            ->line('**Código del pedido:** ' . $this->order->order_code)
            ->line('**Cliente:** ' . $this->order->user->name)
            ->line('**Total:** $' . number_format($this->order->total_amount, 0))
            ->line('**Cantidad de productos:** ' . $this->order->orderItems->count())
            ->action('Ver detalles del pedido', url('/tendero/pedidos'))
            ->line('¡No olvides confirmar el pedido lo antes posible!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'order_id' => $this->order->id,
            'order_code' => $this->order->order_code,
            'customer_name' => $this->order->user->name,
            'total_amount' => $this->order->total_amount,
            'items_count' => $this->order->orderItems->count(),
            'type' => 'nuevo_pedido'
        ];
    }
}
