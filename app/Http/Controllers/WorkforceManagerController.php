<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Workforce;
use App\Employee;
use App\TaskAssignment;
use App\TaskSchedule;
use App\Company;
use App\User;
use Mail;

class WorkforceManagerController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(session()->get('user_type') == 'company'){
            $workforces = Workforce::where('company_id', session()->get('company_id'))->latest()->get();
            return view('tasks.index')->with('workforces', $workforces);
        } elseif(session()->get('user_type')  == 'admin'){
            $workforces = Workforce::orderBy('created_at', 'desc')->get();
            return view('tasks.index')
            ->with('workforces', $workforces);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company = Company::find(session()->get('company_id'));
        //schedule conversion start
        if( ($company->company_schedule != null) && (count($company->company_schedule)) ){
            foreach($company->company_schedule as $c){
                $a = json_decode(json_encode($c), true);
                $b[] = $a;
            }

            $new_arr = $b;

            $result = [];
            $count = 1;
            while (count($new_arr) > 0) {
                $ctr = 0;
                $base_sched = $new_arr[0];
                $days_with_same_time = [];
                $elements_to_be_removed = [];
                foreach($new_arr as $single_sched){

                    $base_day = $base_sched['schedule_date'];
                    $base_time_in = $base_sched['schedule_time_in'];
                    $base_time_out = $base_sched['schedule_time_out'];

                    $day = $single_sched['schedule_date'];
                    $time_in = $single_sched['schedule_time_in'];
                    $time_out = $single_sched['schedule_time_out'];

                    if (($base_time_in == $time_in) && ($base_time_out == $time_out)){
                        $days_with_same_time[] = $day;
                        $elements_to_be_removed[] = $ctr;
                    }

                    $ctr++;
                }

                $days_str = implode(', ', $days_with_same_time);
                ${"schedule$count"}[] = array(
                    'days' => $days_str,
                    'time_in' => $base_time_in,
                    'time_out' => $base_time_out,
                );

                $result[] = ${"schedule$count"};

                //remove the elements that are already processed
                foreach($elements_to_be_removed as $ctr_item){
                    unset($new_arr[$ctr_item]);
                }
                array_values($new_arr);
                $new_arr_clone = $new_arr;
                $new_arr = [];
                foreach($new_arr_clone as $new_arr_item){
                    $new_arr[] = $new_arr_item;
                }
                $count++;
            }
            $sched = $result;
        } else {
            $sched = null;
        }
        //schedule conversion end
        return view('tasks.create')->with('sched', $sched);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'work_type' => 'required',
            'work_location' => 'required',
            'extra_requirements' => 'required',
            'employee_required' => 'required',
        ]);
        $workforce = new Workforce;
        $workforce->company_id = session()->get('company_id');
        if($request->work_type == 'other'){
            $workforce->work_type = $request->work_type_other;
        } else {
            $workforce->work_type = $request->work_type;
        }
        $workforce->work_location = $request->work_location;
        $workforce->extra_requirements = $request->extra_requirements;
        $workforce->employee_required = $request->employee_required;
        $workforce->status = 'In Progress';
        $workforce->save();

        //schedule
        $sched = TaskSchedule::where('workforce_id', $workforce->id)->get();
        if(!empty($sched)){
            foreach($sched as $s){
                $s->delete();
            }
        }

        for($i = 1; $i <= count($request->hidden_row); $i++){
            foreach($request->input('schedule_date'.$i) as $r){
                $schedule = new TaskSchedule;
                $schedule->workforce_id = $workforce->id;
                $schedule->schedule_date = $r;
                $schedule->schedule_time_in = $request->input('schedule_time_in'.$i);
                $schedule->schedule_time_out = $request->input('schedule_time_out'.$i);
                $schedule->save();
            }
        }

        $en_t = encrypt('tasks');
        $en_id = encrypt($workforce->id);

        $link = \URL::to('/login?re=1&url='.$en_t.'&id='.$en_id);

        //send email to admin
        $admins = User::where('user_type', 'admin')->get();
        foreach($admins as $admin){
            Mail::send('email.new_task_admin_email', array('email' => $workforce->company->user->email, 'link' => $link), function($message) use($admin) {
                $message->to($admin->email, $admin->email)->subject('New Task Created - Staff.is');
            });
        }

        \Session::flash('message', 'Successfully created');
        return redirect('/tasks');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $workforces = Workforce::find($id);

        //available employees for invitation (Company sees this one)
        $employees = Employee::whereDoesntHave('taskassignments',function($query) use ($id){
            $query->where('taskassignments.workforce_id', '=', $id);
        })->get();

        $accepted = TaskAssignment::where(['status' => 'accepted', 'workforce_id' => $id])->get();

        //remove notif if employee views the task
        if(session()->get('user_type') == 'employee'){
            foreach($workforces->taskassignments as $task){
                $task->is_read = 1;
                $task->save();
            }
        }

        //schedule conversion start
        if(count($workforces->task_schedule)){
            foreach($workforces->task_schedule as $c){
                $a = json_decode(json_encode($c), true);
                $b[] = $a;
            }

            $new_arr = $b;

            $result = [];
            $count = 1;
            while (count($new_arr) > 0) {
                $ctr = 0;
                $base_sched = $new_arr[0];
                $days_with_same_time = [];
                $elements_to_be_removed = [];
                foreach($new_arr as $single_sched){

                    $base_day = $base_sched['schedule_date'];
                    $base_time_in = $base_sched['schedule_time_in'];
                    $base_time_out = $base_sched['schedule_time_out'];

                    $day = $single_sched['schedule_date'];
                    $time_in = $single_sched['schedule_time_in'];
                    $time_out = $single_sched['schedule_time_out'];

                    if (($base_time_in == $time_in) && ($base_time_out == $time_out)){
                        $days_with_same_time[] = $day;
                        $elements_to_be_removed[] = $ctr;
                    }

                    $ctr++;
                }

                $date_str = implode(', ', $days_with_same_time);
                ${"schedule$count"}[] = array(
                    'date' => $date_str,
                    'time_in' => $base_time_in,
                    'time_out' => $base_time_out,
                );

                $result[] = ${"schedule$count"};

                //remove the elements that are already processed
                foreach($elements_to_be_removed as $ctr_item){
                    unset($new_arr[$ctr_item]);
                }
                array_values($new_arr);
                $new_arr_clone = $new_arr;
                $new_arr = [];
                foreach($new_arr_clone as $new_arr_item){
                    $new_arr[] = $new_arr_item;
                }
                $count++;
            }
            $workforces->result = $result;
        } else {
            $workforces->result = null;
        }
        //schedule conversion end

        return view('tasks.show')
        ->with('workforces', $workforces)
        ->with('employees', $employees)
        ->with('accepted', $accepted);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $workforces = Workforce::find($id);
        //schedule conversion start
        if(count($workforces->task_schedule)){
            foreach($workforces->task_schedule as $c){
                $a = json_decode(json_encode($c), true);
                $b[] = $a;
            }
            $new_arr = $b;
            $result = [];
            $count = 1;
            while (count($new_arr) > 0) {
                $ctr = 0;
                $base_sched = $new_arr[0];
                $days_with_same_time = [];
                $elements_to_be_removed = [];
                foreach($new_arr as $single_sched){

                    $base_day = $base_sched['schedule_date'];
                    $base_time_in = $base_sched['schedule_time_in'];
                    $base_time_out = $base_sched['schedule_time_out'];

                    $day = $single_sched['schedule_date'];
                    $time_in = $single_sched['schedule_time_in'];
                    $time_out = $single_sched['schedule_time_out'];

                    if (($base_time_in == $time_in) && ($base_time_out == $time_out)){
                        $days_with_same_time[] = $day;
                        $elements_to_be_removed[] = $ctr;
                    }
                    $ctr++;
                }

                $date = implode(', ', $days_with_same_time);
                ${"schedule$count"}[] = array(
                    'date' => $date,
                    'time_in' => $base_time_in,
                    'time_out' => $base_time_out,
                );

                $result[] = ${"schedule$count"}; 

                        //remove the elements that are already processed
                foreach($elements_to_be_removed as $ctr_item){
                    unset($new_arr[$ctr_item]);
                }
                array_values($new_arr);
                $new_arr_clone = $new_arr;
                $new_arr = [];
                foreach($new_arr_clone as $new_arr_item){
                    $new_arr[] = $new_arr_item;
                }
                $count++;
            }
            $workforces->result = $result;
        }
        //schedule conversion end
        return view('tasks.edit')->with('workforces', $workforces);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $workforces = Workforce::find($id);
        $workforces->work_type = $request->work_type;

        //schedule
        $sched = TaskSchedule::where('workforce_id', $workforces->id)->get();
        if(!empty($sched)){
            foreach($sched as $s){
                $s->delete();
            }
        }

        for($i = 1; $i <= count($request->hidden_row); $i++){
            foreach($request->input('schedule_date'.$i) as $r){
                $schedule = new TaskSchedule;
                $schedule->workforce_id = $workforces->id;
                $schedule->schedule_date = $r;
                $schedule->schedule_time_in = $request->input('schedule_time_in'.$i);
                $schedule->schedule_time_out = $request->input('schedule_time_out'.$i);
                $schedule->save();
            }
        }

        $workforces->work_location = $request->work_location;
        $workforces->extra_requirements = $request->extra_requirements;
        $workforces->employee_required = $request->employee_required;
        $workforces->status = $request->status;
        $workforces->save();

        \Session::flash('message', 'Successfully saved!');
        return redirect('/tasks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $workforces = Workforce::find($id);
        $workforces->delete();

        // redirect
        \Session::flash('message', 'Successfully deleted!');
        return redirect('/tasks');
    }

    public function advanced_search(Request $request){
        $search = Workforce::whereHas('task_schedule', function($q) use($request){

            //FIX
            if($request->search_schedule_date != null){
                $q->where(function($a) use($request){
                    foreach($request->search_schedule_date as $day){
                        $a->orWhere('schedule_date', $day); //use where for more specific results
                    }
                });
            }

            if($request->search_time_in != null){
                $q->where('schedule_time_in', 'like', '%' . $request->search_time_in . '%');
            }
            if($request->search_time_out != null){
                $q->where('schedule_time_out', 'like', '%' . $request->search_time_out . '%');
            }
        })->where(function($query) use($request){
            if($request->search_work_type != null){
                $query->where('work_type','like', '%'. $request->search_work_type .'%');
            }
            if($request->search_work_location != null){
                $query->where('work_location','like', '%'. $request->search_work_location .'%');
            }
            if($request->search_extra_requirements != null){
                $query->where('extra_requirements','like', '%'. $request->search_extra_requirements .'%');
            }
            if($request->search_employee_required != null){
                $query->where('employee_required','like', '%'. $request->search_employee_required .'%');
            }
            if($request->search_status != null){
                $query->where('status','like', '%' . $request->search_status . '%');
            }
        })->get();
        return view('tasks.index')->with('workforces', $search)->render();
    }
}
