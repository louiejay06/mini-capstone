<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MotorPurchasedNotification extends Notification
{
    use Queueable;

    protected $motor;
    protected $purchase;

    /**
     * Create a new notification instance.
     */
    public function __construct($motor, $purchase)
    {
        $this->motor = $motor;
        $this->purchase = $purchase;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param object $notifiable
     * @return array<int, string>
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param object $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
        $motorName = $this->motor->name; // Replace with the actual attribute name for the motor's name

        return (new MailMessage)
            ->line('Congratulations! You have successfully purchased a ' . $motorName)
            ->action('View Purchase', url('/motors/'.$this->motor->id.'/purchases/'.$this->purchase->id))
            ->line('Thank you for choosing our application.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param object $notifiable
     * @return array<string, mixed>
     */
    public function toArray($notifiable): array
    {
        return [
            'motor_id' => $this->motor->id,
            'purchase_id' => $this->purchase->id,
            'message' => 'The motor has been purchased successfully. Thank you!',
        ];
    }
}
