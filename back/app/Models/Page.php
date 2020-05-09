<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'pages';

    protected $fillable = array('name', 'title', 'content');

    protected $hidden = array('created_at','updated_at');
}
