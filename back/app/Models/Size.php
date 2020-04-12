<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use Relation\BelongsTo\Color;

    protected $table = 'sizes';

    protected $fillable = array('color_id', 'size', 'price', 'count');

    protected $hidden = array('created_at','updated_at');
}
