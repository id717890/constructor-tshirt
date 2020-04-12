<?php

namespace App\Models\Relation\HasMany;

trait Size
{
    public function sizes()
    {
        return $this->HasMany('App\Models\Size', 'color_id');
    }
}