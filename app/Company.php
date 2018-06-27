<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
	public function user(){
		return $this->belongsTo('App\User');
	}

	public function workforce(){
		return $this->hasMany('App\Workforce');
	}

	public function taskassignments(){
		return $this->hasMany('App\TaskAssignments');
	}
}
