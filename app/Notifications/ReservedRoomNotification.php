<?php

namespace App\Notifications;

use App\Models\ReserveRoom;
use App\Models\Room;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReservedRoomNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        private ReserveRoom $reserveRoom
    ) {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'id' => $this->reserveRoom->id,
            'name' => $this->reserveRoom->name,
            'email' => $this->reserveRoom->email,
            'phone' => $this->reserveRoom->phone,
            'check_in' => $this->reserveRoom->check_in,
            'check_out' => $this->reserveRoom->check_out,
            'adults' => $this->reserveRoom->adults,
            'children' => $this->reserveRoom->children,
            'tent_spots' => $this->reserveRoom->tent_spots,
            'caravan_spots' => $this->reserveRoom->caravan_spots,
            'deleted_at' => $this->reserveRoom->deleted_at,
        ];
    }
}
