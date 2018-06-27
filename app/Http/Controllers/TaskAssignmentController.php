<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TaskAssignment;
use App\Workforce;
use Mail;
use App\Employee;
use App\Company;
use App\User;

class TaskAssignmentController extends Controller
{
	
	public function send_invite($task_id, $employee_id){

		$new_task = new TaskAssignment;
		$new_task->workforce_id = $task_id;
		$new_task->employee_id = $employee_id;
		$new_task->status = 'invited';
		$new_task->save();

		$employee = Employee::find($employee_id);

		$en_t = encrypt('tasks');
		$en_id = encrypt($task_id);

		$link = \URL::to('/login?re=1&url='.$en_t.'&id='.$en_id);

		Mail::send('email.job_invitation', array('email' => $employee->user->email, 'link' => $link), function($message) use($employee) {
			$message->to($employee->user->email, $employee->user->email)->subject('New Task Invitation - Staff.is');
		});

		return redirect('/tasks/' . $task_id)
		->with('message', 'Successfully invited!');
	}

	public function accept_invite($task_id, $employee_id){
		$accept_invite = TaskAssignment::where(['workforce_id' => $task_id, 'employee_id' => $employee_id])->first();
		$accept_invite->status = 'accepted';
		$accept_invite->save();

		$en_t = encrypt('tasks');
		$en_id = encrypt($task_id);
		$link = \URL::to('/login?re=1&url='.$en_t.'&id='.$en_id);

		//Send email to company when an employee accepts a task
		Mail::send('email.accepted_task_company_email', array('email' => $accept_invite->workforce->company->user->email, 'link' => $link), function($message) use($accept_invite) {
			$message->to($accept_invite->workforce->company->user->email, $accept_invite->workforce->company->user->email)->subject('Accepted Task Invitation - Staff.is');
		});

		//Send email to ALL Admins when an employee accepts a task
		$admins = User::where('user_type', 'admin')->get();
		foreach($admins as $admin){
			Mail::send('email.accepted_task_company_email', array('email' => $accept_invite->workforce->company->user->email, 'link' => $link), function($message) use($accept_invite, $admin) {
				$message->to($admin->email, $admin->email)->subject('Accepted Task Invitation - Staff.is');
			});
		}

		return redirect('tasks/employee/' . $employee_id . '/accepted-invitations/')
		->with('message', 'Successfully accepted the invitation');
	}

	public function reject_invite($task_id, $employee_id){
		$accept_invite = TaskAssignment::where(['workforce_id' => $task_id, 'employee_id' => $employee_id])->first();
		$accept_invite->status = 'rejected';
		$accept_invite->save();

		return redirect('tasks/employee/' . $employee_id . '/accepted-invitations/')
		->with('message', 'Successfully rejected the invitation');
	}

	public function admin_approve($task_id, $employee_id){
		$taskassignment = TaskAssignment::where(['workforce_id' => $task_id, 'employee_id' => $employee_id])->get();

		foreach($taskassignment as $t){
			$t->is_approved_by_admin = 1;
			$t->save();	
		}
		
		return redirect('/tasks/'.$task_id);
	}
}
