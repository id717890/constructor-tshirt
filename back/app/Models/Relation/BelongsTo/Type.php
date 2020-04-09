<?php

namespace App\Models\Relation\BelongsTo;

trait Type
{
    public function type()
    {
        return $this->belongsTo('App\Models\Type', 'type_id');
    }
}