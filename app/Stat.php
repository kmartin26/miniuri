<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    public $fillable = ['url_id', 'ip', 'user_agent'];
}
