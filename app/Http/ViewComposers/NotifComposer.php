<?php
namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\TaskAssignment;
use App\Company;

class NotifComposer
{
    public function compose(View $view)
    {
        $new_task = TaskAssignment::where('employee_id', session()->get('employee_id'))
        ->where(['status' => 'invited', 'is_read' => 0])
        ->count('status'); //notif for employee

        $new_company = Company::where('is_read_by_admin', 0)
        ->count('is_read_by_admin'); //notif for admin


        $view
        ->with('new_task', $new_task)
        ->with('new_company', $new_company);
    }
}
?>