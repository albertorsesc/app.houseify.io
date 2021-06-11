<?php

namespace App\Notifications;

use App\Models\JobProfiles\JobProfile;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class NotifyNewJobProfile extends Notification
{
    use Queueable;

    public JobProfile $jobProfile;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(JobProfile $jobProfile)
    {
        $this->jobProfile = $jobProfile;
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

    public function toSlack($notifiable)
    {
        return (new SlackMessage)
            ->from('Houseify::root', ':grey_exclamation:')
            ->to('#logs')
            ->content(
                'Nuevo Tecnico!: ' . PHP_EOL .
                '**' . $this->jobProfile->title . '::' . $this->jobProfile->id . '**' . PHP_EOL .
                ' asegurate de revisarla.'
            );
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
