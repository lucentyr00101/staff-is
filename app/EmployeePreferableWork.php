<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeePreferableWork extends Model
{
	public function employee(){
		return $this->belongsTo('App\Employee');
	}
}
