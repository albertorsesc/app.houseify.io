<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    const ACTION_TRANSLATIONS = [
        'STORE' => 'Registro',
        'UPDATE' => 'Actualizacion',
        'DELETE' => 'Eliminacion',
        'RESTORE' => 'Restaurado',
        'ANNIHILATE' => 'Aniquilado'
    ];
    protected $fillable = ['action', 'model', 'model_id', 'responsible', 'log_type', 'additional_info'];

    public static function getActionTypes() : array
    {
        return ['STORE', 'UPDATE', 'DELETE'];
    }

    /**
     * @param $action
     * @param $model
     * @param $responsible
     * @param null $additionalInfo = null
     * @param string $logType = 'info'
     */
    public static function toLog($action, $model, $responsible, $additionalInfo = null, $logType = 'info')
    {
        self::writeToDatabase($action, $model, $responsible, $additionalInfo, $logType);

        self::writeToLog($action, $model, $responsible, $additionalInfo, $logType);
    }

    protected static function writeToDatabase ($action, $model, $responsible, $additionalInfo = null, $logType = 'info') : void
    {
        Log::create([
            'action' => $action,
            'model' => class_basename($model),
            'model_id' => $model->id,
            'responsible' => optional($responsible)->email . '::' . optional($responsible)->id,
            'log_type' => $logType,
            'additional_info' => $additionalInfo
        ])->save();
    }

    /**
     * @param $action
     * @param $model
     * @param $responsible
     * @param null $additionalInfo
     * @param string $logType
     *
     * @internal param $id
     */
    protected static function writeToLog($action, $model, $responsible, $additionalInfo = null, $logType = 'info'): void
    {
        \Log::$logType('
            #====================#
            Action: ' . $action . '
            Model: ' . class_basename($model) . '
            ID: ' . $model->id . '
            Responsible: ' . optional($responsible)->email . '::' . optional($responsible)->id . '
            Additional Info: ' . $additionalInfo . '
            #====================#
            '
        );
    }

    /** Accesors */

    public function getActionTranslationAttribute()
    {
        return self::ACTION_TRANSLATIONS[$this->action];
    }

    public function getLoggedAtAttribute()
    {
        return Carbon::make($this->created_at)->format('M j Y H:i:s');
    }
}
