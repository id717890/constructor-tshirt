<?php

namespace App\Models\Relation\BelongsTo;

trait Color
{
    public function Color()
    {
        return $this->belongsTo('App\Models\Color', 'color_id');
    }
}