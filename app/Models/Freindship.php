<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Freindship extends Model
{
    protected $fillable = ['requester','user_requested','status'];
}
