<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['liked_by', 'likeable_id', 'likeable_type', 'liked'];
}
