<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
     protected $primaryKey = 'id';
    protected $table = 'tests';

    protected $fillable = [
        'user_id', 'recording','unique_code','network_provider','network_strength', 'latitude','longitude',  'battery_label','types_of_problem','status','person_count'
    ];
}
