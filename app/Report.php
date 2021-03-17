<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    public $fillable = ['name', 'email', 'message'];
}
