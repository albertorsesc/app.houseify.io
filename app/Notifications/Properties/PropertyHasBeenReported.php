<?php

namespace App\Notifications\Properties;

use App\Models\Report;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\{MailMessage, SlackMessage};

class PropertyHasBeenReported extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var Report
     */
    public Report $report;

    /**
     * Create a new notification instance.
     *
     * @param Report $report
     */
    public function __construct(Report $report)
    {
        $this->report = $report;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'slack'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     *
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)->markdown(
            'emails.properties.reports.report-submitted',
            ['report' => $this->report]
        )->subject('[Houseify.io] Una de tus Propiedades ha sido reportada!');
    }

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
            ->content('Nuevo Reporte de ' . $this->report->reportable_type)
            ->content('# ID: ' . $this->report->reportable->id)
            ->content('# Causa del Reporte: ' . $this->report->reporting_cause);
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
