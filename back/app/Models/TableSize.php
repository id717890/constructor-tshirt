<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TableSize extends Model
{
    protected $table = 'table_sizes';

    protected $fillable = array(
        'size',
        'name1', 'age1', 'rf1', 'height1', 'chest1', 'waist1',
        'name2', 'age2', 'rf2', 'height2', 'chest2', 'waist2',
        'name3', 'age3', 'rf3', 'height3', 'chest3', 'waist3',
        'name4', 'age4', 'rf4', 'height4', 'chest4', 'waist4'
    );

    protected $hidden = array('created_at', 'updated_at');
}
