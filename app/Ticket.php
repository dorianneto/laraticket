<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = ['title'];

    public function users()
    {
        return $this->belongsToMany(\App\User::class);
    }
}
