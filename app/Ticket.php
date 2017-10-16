<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public function users()
    {
        return $this->belongsToMany(\App\User::class);
    }
}
