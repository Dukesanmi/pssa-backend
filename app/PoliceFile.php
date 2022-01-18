<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PoliceFile extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'report_police_files';

    protected $fillable = [
        'report_police_id', 'file','file_type'
    ];
}
