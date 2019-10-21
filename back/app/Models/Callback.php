<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Callback extends Model
{
    protected $table = 'callbacks';

    protected $fillable = array('contact', 'result');

    protected $hidden = array('created_at','updated_at');
}
