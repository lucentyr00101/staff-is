<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskAssignment extends Model
{
    public $table = 'taskassignments';

    public function workforce(){
    	return $this->belongsTo('App\Workforce');
    }

    public function employee(){
    	return $this->belongsTo('App\Employee');
    }
}