<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    public $fillable = ['url_id', 'ip', 'user_agent'];
}
