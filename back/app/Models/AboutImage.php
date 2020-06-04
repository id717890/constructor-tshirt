<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutImage extends Model
{
    protected $table = 'about_images';

    protected $fillable = array('name', 'image');

    protected $hidden = array('updated_at');
}
