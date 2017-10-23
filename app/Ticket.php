<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        "title", "message", "situation", "department_id", "category_id", "priority_id"
    ];

    public function users()
    {
        return $this->belongsToMany(\App\User::class);
    }
}
