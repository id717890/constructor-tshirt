<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NumberSize extends Model
{
    protected $table = 'number_sizes';

    protected $fillable = array('name', 'size', 'price');

    protected $hidden = array('created_at','updated_at');
}
