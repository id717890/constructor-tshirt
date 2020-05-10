<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use Relation\HasMany\Image;

    protected $table = 'albums';

    protected $fillable = array('name');

    protected $hidden = array('created_at', 'updated_at');
}
