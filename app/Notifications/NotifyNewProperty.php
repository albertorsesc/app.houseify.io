<?php

namespace App\Notifications;

use App\Models\Properties\Property;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class NotifyNewProperty extends Notification
{
    use Queueable;

    public Property $property;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Property $property)
    {
        $this->property = $property;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        /*return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');*/
    }

    public function toSlack($notifiable)
    {
        return (new SlackMessage)
            ->from('Houseify::root', ':grey_exclamation:')
            ->to('#logs')
            ->content(
                'Nueva Propiedad!: ' . PHP_EOL .
                '**' . $this->property->title . '**' . PHP_EOL .
                ' asegurate de revisarla.'
            );
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
