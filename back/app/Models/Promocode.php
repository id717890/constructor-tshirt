<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promocode extends Model
{
    protected $table = 'promocodes';

    protected $fillable = array('name', 'code', 'discount');

    protected $hidden = array('created_at','updated_at');
}
