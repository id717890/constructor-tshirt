<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogoType extends Model
{
    use Relation\BelongsTo\LogoSize;

    protected $table = 'logo_types';

    protected $fillable = array('logo_size_id', 'name', 'price', 'description');

    protected $hidden = array('created_at','updated_at');
}
