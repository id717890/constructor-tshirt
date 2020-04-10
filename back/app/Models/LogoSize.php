<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogoSize extends Model
{
    protected $table = 'logo_sizes';

    protected $fillable = array('name', 'size');

    protected $hidden = array('created_at','updated_at');
}
