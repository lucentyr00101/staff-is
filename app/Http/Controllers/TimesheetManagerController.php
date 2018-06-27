<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Timesheet;
use Carbon\Carbon;
use App\Employee;
use App\Workforce;
use App\Company;

class TimesheetManagerController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $timesheets = Timesheet::all();

        return view('timesheets.index')->with('timesheets', $timesheets);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $employee_id)
    {
        return view('timesheets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $timesheet = Timesheet::find($id);
        return view('timesheets.show')->with('timesheet', $timesheet);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function edit_timesheet($employee_id, $task_id){
        $task = Workforce::where('id', $task_id)->first();
        $timesheet = Timesheet::where(['employee_id' => $employee_id, 'workforce_id' => $task_id])->get();
        $employee = Employee::where('id', $employee_id)->first();
        return view('timesheets.timesheet')
        ->with('timesheet', $timesheet)
        ->with('task', $task)
        ->with('employee', $employee);
    }

    public function save_timesheet(Request $request, $employee_id, $task_id){
        $old = Timesheet::where(['employee_id' => $employee_id, 'workforce_id' => $task_id])->get();
        if($old){
            foreach($old as $o){
                $o->delete();
            }
        }
        for($i = 0; $i < count($request->date); $i++){
            $timesheet = new Timesheet;
            $timesheet->employee_id = $employee_id;
            $timesheet->workforce_id = $task_id;
            $timesheet->date = $request->date[$i];
            $timesheet->code = $request->code[$i];
            $timesheet->job_description = $request->jd[$i];
            $timesheet->time_in = $request->time_in[$i];
            $timesheet->time_out = $request->time_out[$i];
            $timesheet->reg_time = $request->reg_time[$i];
            $timesheet->overtime = $request->overtime[$i];
            $timesheet->remarks_from_emp =  $request->remarks_emp[$i];
            $timesheet->remarks_from_company = $request->remarks_company[$i];
            $timesheet->date = $request->date[$i];
            $timesheet->save();
        }
        return redirect('/timesheets/edit/employee_id=' . $employee_id . '&task_id=' . $task_id)->with('message', 'Successfully saved!');
    }
}