<?php

namespace App\Models\Relation\HasMany;

trait ModelSize
{
    public function model_sizes()
    {
        return $this->HasMany('App\Models\ModelSize', 'model_id');
    }
}