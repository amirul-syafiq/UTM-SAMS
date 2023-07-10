<?php

namespace App\Notifications;

use App\Models\EventAdvertisement;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushChannel;
use NotificationChannels\WebPush\WebPushMessage;

class NewEventNotification extends Notification
{
    use Queueable;
    private $eventAdvertisement;
    /**
     * Create a new notification instance.
     */
    public function __construct(EventAdvertisement $eventAdvertisement)
    {
        $this->eventAdvertisement = $eventAdvertisement;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return [WebPushChannel::class];
    }

    // Web push notification
    public function toWebPush($notifiable, $notification)
    {
        return (new WebPushMessage)
            ->title('Upcoming Event!')

            ->body('Register now for ' . $this->eventAdvertisement->event->event_name)
            // redirect to the app
            ->action('View App', url('/'))
            ->options(['targetUrl' => url('/')]);
    }

    /**
     * Get the mail representation of the notification.
     */

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }


}
