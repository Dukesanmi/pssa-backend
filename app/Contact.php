<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{

    protected $primaryKey = 'id';
    protected $table = 'contacts';

    protected $fillable = [
        'user_id','name','email','mobile_number','message','status',
    ];
}
