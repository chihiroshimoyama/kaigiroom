<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    //
    
    public function getStartDateHour()
    {
        return date('H', strtotime($this->startdate));
    }
    
}
