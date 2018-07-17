<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Datacenter extends Model
{
    protected $fillable = [
        'name','location',
    ];
}
