<?php

namespace App\Events\Logs;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class LogActions
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $action;

    public Model $model;

    public $additionalInfo;

    public string $logType;

    public $responsible;

    /**
     * Create a new event instance.
     *
     * @param $action
     * @param $model
     * @param $responsible
     * @param null $additionalInfo
     * @param string $logType
     */
    public function __construct($action, $model, $responsible, $additionalInfo = null, $logType = 'info')
    {
        $this->action = $action;
        $this->model = $model;
        $this->responsible = $responsible;
        $this->additionalInfo = $additionalInfo;
        $this->logType = $logType;
    }
}
