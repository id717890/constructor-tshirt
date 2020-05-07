<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedbacks';

    protected $fillable = array('text', 'rating', 'show');

    protected $hidden = array('updated_at');
}
