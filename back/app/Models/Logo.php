<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logo extends Model
{
    protected $table = 'logos';

    protected $fillable = array('name', 'image');

    protected $hidden = array('created_at','updated_at');
}
