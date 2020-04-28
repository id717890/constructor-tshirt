<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $table = 'discounts';

//    protected $fillable = array('title', 'subtitle1', 'subtitle2', 'color1', 'color2', 'text', 'image');
    protected $fillable = array('title', 'text', 'image');

    protected $hidden = array('updated_at');
}
