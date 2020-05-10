<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';

    protected $fillable = array('title', 'image', 'album_id');

    protected $hidden = array('updated_at');
}
