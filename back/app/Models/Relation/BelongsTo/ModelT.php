<?php

namespace App\Models\Relation\BelongsTo;

trait ModelT
{
    public function model()
    {
        return $this->belongsTo('App\Models\ModelT', 'model_id');
    }
}