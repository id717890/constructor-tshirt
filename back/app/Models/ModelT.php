<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelT extends Model
{
    use Relation\BelongsTo\Type;
    use Relation\HasMany\ModelSize;

    protected $table = 'models';

    protected $fillable = array('type_id', 'name', 'description', 'image', 'order', 'discount');

    protected $hidden = array('created_at','updated_at');

}
