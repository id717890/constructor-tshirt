<?php

namespace App\Models\Relation\HasMany;

trait Image
{
    public function images()
    {
        return $this->HasMany('App\Models\Image', 'album_id');
    }
}