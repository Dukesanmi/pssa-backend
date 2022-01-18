<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestFile extends Model
{
      protected $primaryKey = 'id';
    protected $table = 'test_files';

    protected $fillable = [
        'test_id', 'file'
    ];
}
