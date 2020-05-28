<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    protected $table = 'catalogs';

    protected $fillable = array('name', 'image', 'file', 'ext');

    protected $hidden = array('created_at','updated_at');
}
