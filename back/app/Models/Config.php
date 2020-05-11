<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $table = 'configs';

    protected $fillable = array('key', 'value');

    protected $hidden = array('created_at','updated_at');
}
