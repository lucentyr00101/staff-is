<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workforce extends Model
{
	protected $fillable = ['company_id'];

	public function company(){
		return $this->belongsTo('App\Company');
	}

	public function employees(){
		return $this->belongsToMany('App\Employee', 'taskassignments', 'workforce_id', 'employee_id')
		->withPivot('status');
	}

	public function taskassignments(){
		return $this->hasMany('App\TaskAssignment');
	}

	public function timesheet(){
		return $this->hasMany('App\Timesheets');
	}

	public function task_schedule(){
		return $this->hasMany('App\TaskSchedule');
	}
}
