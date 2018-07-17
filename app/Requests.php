<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Requests extends Model
{
    use SoftDeletes;
    protected $table = 'requests';
    protected $dates = ['deleted_at'];
}
