<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $table = 'partners';

    protected $fillable = array('image', 'url');

    protected $hidden = array('created_at','updated_at');
}
