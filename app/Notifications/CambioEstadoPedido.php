<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Order;

class CambioEstadoPedido extends Notification
{
    use Queueable;

    protected $order;
    protected $estadoAnterior;
    protected $estadoNuevo;

    /**
     * Create a new notification instance.
     */
    public function __construct(Order $order, $estadoAnterior, $estadoNuevo)
    {
        $this->order = $order;
        $this->estadoAnterior = $estadoAnterior;
        $this->estadoNuevo = $estadoNuevo;
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
        $estados = [
            'pending' => 'Pendiente',
            'confirmed' => 'Confirmado',
            'preparing' => 'En preparación',
            'ready' => 'Listo para recoger',
            'delivered' => 'Entregado',
            'cancelled' => 'Cancelado',
            'inactive' => 'Inactivo'
        ];

        $estadoAnteriorText = $estados[$this->estadoAnterior] ?? $this->estadoAnterior;
        $estadoNuevoText = $estados[$this->estadoNuevo] ?? $this->estadoNuevo;

        return (new MailMessage)
            ->subject('Actualización de tu pedido - PediYÁ')
            ->greeting('¡Hola ' . $notifiable->name . '!')
            ->line('Tu pedido ha cambiado de estado.')
            ->line('**Pedido:** ' . $this->order->order_code)
            ->line('**Tienda:** ' . $this->order->store->name)
            ->line('**Estado anterior:** ' . $estadoAnteriorText)
            ->line('**Nuevo estado:** ' . $estadoNuevoText)
            ->line('**Total:** $' . number_format($this->order->total_amount, 0))
            ->action('Ver detalles del pedido', url('/historialPedidos'))
            ->line('Gracias por usar PediYÁ!');
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
            'store_name' => $this->order->store->name,
            'estado_anterior' => $this->estadoAnterior,
            'estado_nuevo' => $this->estadoNuevo,
            'total_amount' => $this->order->total_amount,
            'type' => 'cambio_estado_pedido'
        ];
    }
}
