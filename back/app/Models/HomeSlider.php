<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeSlider extends Model
{
    protected $table = 'home_slides';

    protected $fillable = array('image', 'url');

    protected $hidden = array('updated_at');
}
