<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use SoftDeletes;

    /**
     * Undocumented variable
     *
     * @var array
     */
    protected $fillable = [
        "title", "message", "situation", "department_id", "category_id", "priority_id"
    ];

    /**
     * Undocumented function
     *
     * @return void
     */
    public function users()
    {
        return $this->belongsToMany(\App\User::class);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function department()
    {
        return $this->belongsTo(\App\Department::class);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function category()
    {
        return $this->belongsTo(\App\Category::class);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function priority()
    {
        return $this->belongsTo(\App\Priority::class);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }
}
