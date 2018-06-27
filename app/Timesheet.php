<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
    public function task(){
    	return $this->belongsTo('App\Workforce');
    }

    public function employee(){
    	return $this->belongsTo('App\Employee');
    }
}
