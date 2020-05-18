<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelSize extends Model
{
    use Relation\BelongsTo\ModelT;

    protected $table = 'model_sizes';

    protected $fillable = array('model_id', 'size', 'is_show');

    protected $hidden = array('created_at','updated_at');
}
