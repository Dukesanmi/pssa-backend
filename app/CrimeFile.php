<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CrimeFile extends Model
{
     protected $primaryKey = 'id';
    protected $table = 'report_crime_files';

    protected $fillable = [
        'report_crime_id', 'file','file_type'
    ];
}
