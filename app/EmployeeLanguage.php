<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeLanguage extends Model
{
	protected $fillable = ['employee_id', 'language', 'proficiency'];

    public function employee(){
    	return $this->belongsTo('App\Employee');
    }
}