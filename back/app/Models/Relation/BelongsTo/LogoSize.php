<?php

namespace App\Models\Relation\BelongsTo;

trait LogoSize
{
    public function logo_size()
    {
        return $this->belongsTo('App\Models\LogoSize', 'logo_size_id');
    }
}