<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SelectionOption;
use Auth;

class AdminController extends Controller
{
	public function show_selection_manager(){
		$degree = SelectionOption::where('options_for', 'Degree')->get();
		return view('admin.selection_manager')
		->with('degree', $degree);
	}

	public function update_selection_manager(Request $request){
		$query3 = SelectionOption::where('options_for', 'Degree')->get();

		if(count($query3) > 0){
			foreach($query3 as $results){
				$results->delete();
			}
		}

		foreach($request->degree as $degree){
			$options = new SelectionOption;
			$options->options_for = $request->degree_hidden;
			$options->value = $degree;
			$options->save();
		}
		return redirect('/settings/selection-option-manager')->with('message', 'Successfully saved.');
	}

	public function testAPI(){
		return view('testapi');
	}

	public function singleAPI($id){
		return view('singleapi');
	}

	public function resetPasswordLogout(){
		\Session::flush();
		\Auth::logout();
		\Session::flash('success', 'Password successfully changed.');
		return redirect('/');
	}
}
