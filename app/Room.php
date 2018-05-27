<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = ['roomname', 'number'];

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('number','kaiginame','startdate','enddate')->withTimestamps();
    }

}
