<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use Relation\BelongsTo\ModelT;
    use Relation\HasMany\Size;

    protected $table = 'colors';

    protected $fillable = array('model_id', 'name', 'article', 'image_front', 'image_back');

    protected $hidden = array('created_at','updated_at');
}
