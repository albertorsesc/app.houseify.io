<?php

namespace App\Notifications;

use App\Models\Suggestion;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;

class NotifyNewSuggestion extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var Suggestion
     */
    private Suggestion $suggestion;

    /**
     * Create a new notification instance.
     *
     * @param Suggestion $suggestion
     */
    public function __construct(Suggestion $suggestion)
    {
        $this->suggestion = $suggestion;
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
    /*public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }*/

    /**
     * Get the Slack representation of the notification.
     *
     * @param  mixed  $notifiable
     *
     * @return SlackMessage
     */
    public function toSlack($notifiable)
    {
        return (new SlackMessage)
            ->from('Houseify::root', ':grey_exclamation:')
            ->to('#logs')
            ->content(
                'Recibimos una nueva sugerencia: ' . PHP_EOL .
                '**' . $this->suggestion->subject . '**' . PHP_EOL .
                ' asegurate de analizarla.'
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
