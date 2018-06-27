<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Workforce;
use App\Http\Resources\WorkforceResource;
use App\Http\Resources\WorkforcesResource;

class WorkforceAPIController extends Controller
{
    public function index(){
    	$tasks = Workforce::orderBy('created_at', 'desc')->get();
    	return new WorkforcesResource($tasks);
    }

    public function show($id){
    	$task = Workforce::find($id);
    	return new WorkforceResource($task);
    }
}
