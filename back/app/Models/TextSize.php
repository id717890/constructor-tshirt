<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TextSize extends Model
{
    protected $table = 'text_sizes';

    protected $fillable = array('name', 'size', 'price');

    protected $hidden = array('created_at','updated_at');
}
