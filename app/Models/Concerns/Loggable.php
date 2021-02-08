<?php

namespace App\Models\Concerns;

use App\Models\Log;

trait Loggable
{

    /**
     *  Log Types:
     *
     *  debug
     *  info
     *  notice
     *  warning
     *  error
     *  critical
     *  alert
     *  emergency
     *  log
     *  write
     */

//        public static function bootLoggable()
//        {
//            self::created(function($model) {
//                self::toLog('STORE', $model->id, auth()->user()->username, 'info', null);
//            });
//            self::updated(function($model) {
//                self::toLog('UPDATE', $model->id, auth()->user()->username, 'info', null);
//            });
//            self::deleted(function($model) {
//                self::toLog('DELETE', $model->id, auth()->user()->username, 'info', null);
//            });
//        }

    /**
     * @param $action
     * @param $model
     * @param string $logType = 'info'
     * @param null $additionalInfo = null
     */
    public static function toLog($action, $model, $additionalInfo = null, $logType = 'info')
    {
        self::writeToDatabase($action, $model, $additionalInfo, $logType);

        self::writeToLog($action, $model, $additionalInfo, $logType);
    }

    protected static function writeToDatabase ($action, $model, $additionalInfo = null, $logType = 'info') : void
    {
        Log::create([
            'action' => $action,
            'model' => class_basename($model),
            'model_id' => $model->id,
            'responsible' => auth()->user()->email . '::' . auth()->id(),
            'log_type' => $logType,
            'additional_info' => $additionalInfo
        ])->save();
    }

    /**
     * @param $model
     * @param $action
     * @param $logType
     * @param $additionalInfo
     */
    protected static function writeToLog($action, $model, $additionalInfo = null, $logType = 'info'): void
    {
        \Log::$logType('
        #====================#
        Action: ' . $action . '
        Model: ' . class_basename(self::class) . '
        ID: ' . $model->id . '
        USR: ' . auth()->user()->email . '::' . auth()->id() . '
        Additional Info: ' . $additionalInfo . '
        #====================#
        '
        );
    }

}
