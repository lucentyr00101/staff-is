<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskSchedule extends Model
{
    public function task(){
    	return $this->belongsTo('App\Workforce');
    }
}
