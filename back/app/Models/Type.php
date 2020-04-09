<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'types';

    protected $fillable = array('name');

    protected $hidden = array('created_at','updated_at');
}
