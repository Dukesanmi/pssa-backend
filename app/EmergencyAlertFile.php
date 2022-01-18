<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmergencyAlertFile extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'emergency_alert_files';

    protected $fillable = [
        'em_alert_id', 'file'
    ];
}
