<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmploymentHistory extends Model
{
	protected $fillable = ['employee_id', 'job_title', 'job_description', 'job_duration', 'company', 'salary'];

	public function employee(){
		return $this->belongsTo('App\Employee');
	}
}
