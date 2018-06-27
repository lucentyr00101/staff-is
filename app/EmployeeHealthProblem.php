<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeHealthProblem extends Model
{
	protected $fillable = ['id', 'employee_id', 'health_problem', 'status'];

	public function employee(){
		return $this->belongsTo('App\Employee');
	}
}
