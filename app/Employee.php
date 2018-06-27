<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{

	public function employeelanguage(){
		return $this->hasMany('App\EmployeeLanguage');
	}

	public function user(){
		return $this->belongsTo('App\User');
	}

	public function employment_history(){
		return $this->hasMany('App\EmploymentHistory');
	}

	public function preferable_work(){
		return $this->hasMany('App\EmployeePreferableWork');
	}

	public function education_history(){
		return $this->hasMany('App\EmployeeEducationHistory');
	}

	public function cv(){
		return $this->hasMany('App\EmployeeCv');
	}

	public function health_problem(){
		return $this->hasOne('App\EmployeeHealthProblem');
	}

	public function tasks(){
		return $this->belongsToMany('App\Workforce', 'taskassignments', 'employee_id', 'workforce_id')
		->withPivot('status');
	}

	public function taskassignments(){
		return $this->hasMany('App\TaskAssignment');
	}

	public function timesheet(){
		return $this->hasMany('App\Timesheet');
	}
}
