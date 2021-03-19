<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    public $fillable = ['url', 'method', 'creator_ip'];
}
