<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
        protected $fillable = ['username','action','ipAddress'];
}
