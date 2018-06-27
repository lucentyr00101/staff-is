<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\EmployeeLanguage;
use App\User;
use App\EmployeeHealthProblem;
use App\EmployeePreferableWork;
use App\EmploymentHistory;
use App\EmployeeEducationHistory;
use App\EmployeeCv;
use App\TaskAssignment;
use File;
use Crypt;
use App\Workforce;
use App\SendEmail;
use Mail;
use App\SelectionOption;
use App\Company;

class EmployeeController extends Controller
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
        if(session()->get('user_type') == 'admin'){
            $employees = Employee::all();
            return view('employee.index')->with('employees', $employees);
        } elseif (session()->get('user_type') == 'company') {
            $company = Company::find(session()->get('company_id'));

            if($company->workforce->isEmpty()){
                return view('employee.index');
            } else {
                foreach($company->workforce as $workforce){
                }
                return view('employee.index')->with('workforce', $workforce);
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employee.create');
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
            'email' => 'required|email',
            'password' => 'min:6|required',
            'contact_number' => 'required|numeric',
        ]);

        $user = new User;
        $user->email = $request->email;
        $user->password = \Hash::make($request->password);
        $user->user_type = 'employee';
        $user->contact_number = $request->contact_number;
        $user->save();

        if($user){
            $email_db = SendEmail::where('email_for', 'New Employee')->first();
            Mail::send('email.employee_welcome', array('email' => $request->email, 'body' => $email_db->body), function($message) use($request, $email_db) {
                $message->to($request->email, $request->email)->subject($email_db->subject);
            });

            $employee = new Employee;
            $employee->user_id = $user->id;
            $employee->save();

            $history = new EmploymentHistory;
            $history->employee_id = $employee->id;
            $history->save();

            $pref = new EmployeePreferableWork;
            $pref->employee_id = $employee->id;
            $pref->save();

            $health = new EmployeeHealthProblem;
            $health->employee_id = $employee->id;
            $health->save();

            $educ = new EmployeeEducationHistory;
            $educ->employee_id = $employee->id;
            $educ->save();

            if ($employee){
                return redirect('/employee/create')->with('message', 'Successfully created new user.');
            } else {
                return "error saving employee, try again";
            }
        } else {
            return "user is not saved successfully, try again";
        }
        \Session::flash('message', 'Employee successfully created!');
        return redirect('/employee');

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::find($id);
        if($employee){
            return view('employee.show')
            ->with('employee', $employee);
        } else {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_type = \Session::get('user_type');
        $employee = Employee::find($id);
        $degree = SelectionOption::where('options_for', 'Degree')->get();

        $select = [];
        foreach($degree as $deg){
            $select[$deg->value] = $deg->value;
        }

        if($employee->profile_image_filepath == null){
            $employee->dp = null;
        } else {
            $employee->dp = decrypt($employee->profile_image_filepath);
        }

        if($user_type == 'admin'){
            return view('employee.edit')
            ->with('employee', $employee)
            ->with('degree', $select);
        } elseif($user_type == 'employee' && $employee->login_count == 0){
            return view('profile.createprofile')
            ->with('employee', $employee)
            ->with('degree', $select);
        } elseif($user_type == 'employee' && $employee->login_count != 0) {
            return view('employee.edit')
            ->with('employee', $employee)
            ->with('degree', $select);
        }
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

        $request->validate([
            'email' => 'required|email|confirmed',
            'password' => 'confirmed',
            ''
        ]);

        if (!file_exists(storage_path('app/public/profile_pictures/'))) {
            mkdir(storage_path('app/public/profile_pictures/'), 0777, true);
        }

        $employee = Employee::find($id);
        $employee->fullname = $request->fullname;
        $employee->age = $request->age;
        $employee->gender = $request->gender;
        $employee->civil_status = $request->civil_status;
        $employee->number_of_children = $request->number_of_children;
        $employee->nationality = $request->nationality;
        $employee->clean_criminal_record = $request->criminal_record;
        $employee->smoking = $request->smoking;


        //ID Number
        if($employee->login_count == 0){
            if($request->has_id == '1'){

                $employee->id_number = $request->is_resident_id_number . '-' . $request->is_resident_id_ext;

                // Get the value from the form
                $input['id_number'] = $employee->id_number;

                // Must not already exist in the `id_number` column of `employees` table
                $rules = array('id_number' => 'unique:employees,id_number');

                $validator = \Validator::make($input, $rules);

                if ($validator->fails()) {
                    return back()->with('error', 'ID Number is already taken!');
                }

            } else {
                $employee->id_number = $request->non_is_id . '-' . $employee->id;
            }
        }


        $employee->birthday = $request->birthday;
        $employee->telephone = $request->telephone;
        $employee->country = $request->country;
        $employee->state = $request->state;
        $employee->zip_code = $request->zip_code;

        $employee->schedule_of_work = $request->schedule_of_work;
        $employee->shift = $request->shift;

        //bankinginformation
        $employee->account_number = $request->account_number;

        if($request->language) {
            $employee_language = EmployeeLanguage::where('employee_id' ,$employee->id)->get();
            if($employee_language){
                foreach ($employee_language as $lang) {
                    $lang->delete();
                }
            }
            foreach (array_combine($request->language, $request->lang_proficiency) as $lang => $proficiency) {
                $language = new EmployeeLanguage;
                $language->employee_id = $employee->id;
                $language->language = $lang;
                $language->proficiency = $proficiency;
                $language->save();
            }
        }

        //employment history
        if($request->job_title){
            $employments = EmploymentHistory::where('employee_id' ,$employee->id)->get();
            if($employments){
                foreach ($employments as $employment) {
                    $employment->delete();
                }
            }

            for($i = 0; $i < count($request->job_title); $i++){
                $employment = new EmploymentHistory;
                $employment->employee_id = $employee->id;
                $employment->job_title = $request->job_title[$i];
                $employment->job_description = $request->job_description[$i];
                $employment->job_duration = $request->jdn[$i] . ' ' .$request->jdmmyy[$i];
                $employment->company = $request->company[$i];
                $employment->salary = $request->salary[$i];
                $employment->save();
            }
        }

        //education history
        if($request->school_name){

            $educations = EmployeeEducationHistory::where('employee_id' ,$employee->id)->get();
            if($educations){
                foreach ($educations as $education) {
                    $education->delete();
                }
            }

            for($i = 0; $i < count($request->school_name); $i++){
                $new_education = new EmployeeEducationHistory;
                $new_education->employee_id = $employee->id;
                $new_education->degree = $request->degree[$i];
                $new_education->school_name = $request->school_name[$i];
                $new_education->highest_degree_attained = $request->highest_degree_attained[$i];
                $new_education->year_graduated = $request->year_graduated[$i];
                $new_education->save();
            }
        }

        //preferred work location
        if($request->location){
            $locations = EmployeePreferableWork::where('employee_id' ,$employee->id)->get();
            if($locations){
                foreach ($locations as $location) {
                    $location->delete();
                }
            }

            for($i = 0; $i < count($request->location); $i++){
                $location = new EmployeePreferableWork;
                $location->employee_id = $employee->id;
                $location->location = $request->location[$i];
                $location->save();
            }
        }
        
        $employee->hasDriverLicense = $request->license;
        $employee->hasCar = $request->car;

        if($request->type_of_license != null){
            $license = implode(',', $request->type_of_license);
        } else {
            $license = null;
        }
        $employee->type_of_license = $license;

        $employee->email_confirmation = $request->email;
        $employee->address = $request->home_address;
        $employee->emergency_contact_name = $request->emergency_contact_name;
        $employee->emergency_contact_number = $request->emergency_contact_number;

        $employee->summary = $request->summary;

        $employee->login_count = 1;

        if($request->health_problem){
            $all_emp_id = EmployeeHealthProblem::where('employee_id', $employee->id);
            if($all_emp_id){
                $all_emp_id->delete();
            }

            foreach($request->health_problem as $health_problem){
                $problem = new EmployeeHealthProblem;
                $problem->employee_id = $employee->id;
                $problem->health_problem = $health_problem;
                $problem->save();
            }
        }

        if (!file_exists(storage_path('app/cv_certs'))) {
            mkdir(storage_path('app/cv_certs'), 0777, true);
        }

        //resume / cv
        if($request->hasFile('cv')){
            $cv_id = EmployeeCv::where('employee_id', $employee->id)->get();

            if($cv_id){
                foreach($cv_id as $cv){
                    $o_fp = decrypt($cv->file_name);
                    $filename = basename($o_fp);
                    File::delete(storage_path('app/cv_certs/' . $filename)); //delete actual file
                    $cv->delete(); //delete record from db
                }
            }

            for($i = 0; $i < count($request->cv); $i++){
                $cv = new EmployeeCv;
                $cv->employee_id = $employee->id;
                $cv->file_type = $request->cv_type[$i];

                //main file
                $file = $request->cv[$i];
                $filename = $file->getClientOriginalName();
                $filecontents = file_get_contents($file);

                //filepath
                $filepath = storage_path('app/cv_certs/') . $filename;
                $encrypted_filepath = encrypt($filepath);

                if(File::exists(storage_path('/app/cv_certs/') . $filename)){
                    $actual_name = pathinfo($filepath,PATHINFO_FILENAME);
                    $extension = pathinfo($filepath, PATHINFO_EXTENSION);
                    $i = 1;
                    do {
                        $actual_name = (string)$actual_name.'('.$i.')';
                        $name = $actual_name.".".$extension;
                        $i++;
                    } while(File::exists(storage_path('app/cv_certs/' . $name)));
                    $cv->file_name = encrypt(pathinfo($filepath, PATHINFO_DIRNAME) . DIRECTORY_SEPARATOR . $name);
                    $path = pathinfo($filepath, PATHINFO_DIRNAME) . DIRECTORY_SEPARATOR . $name;
                    File::put($path, $filecontents);
                    $cv->save();
                } else {
                    //save the file $filepath directory
                    File::put($filepath, $filecontents);
                    $cv->file_name = $encrypted_filepath;
                    $cv->save();
                }
            }
        }

        //profile picture
        if($request->hasFile('profile_image')){
            $dp_query = Employee::where('id', $employee->id)->first();
            if($dp_query->profile_image_filepath != null){
                $dp_get_filepath = decrypt($dp_query->profile_image_filepath);
                File::delete($dp_get_filepath); //delete file from local storage
                $dp_query->profile_image_filepath = null;
            }
            $file = $request->profile_image;
            $filename = str_random(100) . '-' . $file->getClientOriginalName();
            $filecontents = file_get_contents($file);

            //filepath
            $filepath = storage_path('app/public/profile_pictures/') . $filename;
            $encrypted_filepath = encrypt($filepath);

            //save the file to app/public folder
            File::put($filepath, $filecontents);

            //update db record with profile image filepath
            $dp_query->profile_image_filepath = $encrypted_filepath;
            $dp_query->save();

            session()->put('profile_picture', $filepath);
        }

        if($request->password){
            $user = User::find($employee->user_id);
            if(\Hash::check($request->old_password, $user->password)){
                $user->password = \Hash::make($request->password);
                $user->save();
            }else{
                \Session::flash('error_message', 'Old password does not match our records');
                return redirect('/employee/'.$id.'/edit');
            }
        }
        $employee->save();

        //users table
        $user = User::where('id', $employee->user_id)->first();
        $user->email = $request->email;
        $user->contact_number = $request->contact_number;


        \Session::flash('message', 'Successfully saved!');
        \Session::put('name', $employee->fullname);

        return redirect('/employee/' . $employee->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        $employee->user->delete();

        // redirect
        \Session::flash('message', 'Successfully deleted!');
        return redirect('/employee');
    }

    public function getLogout(){
        \Session::flush();
        \Auth::logout();
        return \Redirect::to('/');
    }

    public function show_task_requests($employee_id){
        $employee = Employee::where('id', '=', $employee_id)->first();
        $invited_tasks = TaskAssignment::where(['employee_id' => $employee_id, 'status' => 'invited'])->latest()->get();
        return view('employee.requests.show')
        ->with('invited_tasks', $invited_tasks)
        ->with('employee', $employee);
    }

    public function show_accepted_requests($employee_id){
        $employee = Employee::where('id', '=', $employee_id)->first();
        $accepted_tasks = TaskAssignment::where(['employee_id' => $employee_id, 'status' => 'accepted'])->get();

        return view('employee.requests.accepted')
        ->with('accepted_tasks', $accepted_tasks)
        ->with('employee', $employee);
    }

    public function deactivate_account(){
        $employee = Employee::where('id', session()->get('employee_id'))->first();
        $employee->status = 0;
        $employee->save();
        \Session::flush();
        \Auth::logout();
        session()->flash('success', 'Account has been deactivated.');
        return redirect('/login');
    }

    public function show_reactivate_account_page(){
        return view('employee.deactivated');
    }
    public function reactivate_no(){
        return redirect('/logout');
    }

    public function reactivate_yes(){
        $employee = Employee::where('user_id', \Auth::id())->first();
        $employee->status = 1;
        $employee->save();
        session()->put('employee_id', $employee->id);
        if($employee->profile_image_filepath == null){
            $profile_picture = null;
        } else {
            $profile_picture = decrypt($employee->profile_image_filepath);
        }
        session()->put('profile_picture', $profile_picture);
        return redirect('/tasks/employee/' . $employee->id . '/accepted-invitations/')->with('message', 'Successfully reactivated');
    }

    public function change_profile_picture(Request $request, $id){
        $dp_query = Employee::where('id', $id)->first();
        if($dp_query->profile_image_filepath != null){
            $dp_get_filepath = decrypt($dp_query->profile_image_filepath);
            File::delete($dp_get_filepath); 
            $dp_query->profile_image_filepath = null;
        }
        $file = $request->new_profile_picture;
        $filename = str_random(100) . '-' . $file->getClientOriginalName();
        $filecontents = file_get_contents($file);

        $filepath = storage_path('app/public/profile_pictures/') . $filename;
        $encrypted_filepath = encrypt($filepath);

        File::put($filepath, $filecontents);

        $dp_query->profile_image_filepath = $encrypted_filepath;
        $dp_query->save();

        //replace session picture with new picture
        session()->forget('profile_picture');
        session()->put('profile_picture', $filepath);

        return redirect('/employee/' . $id . '/edit/')
        ->with('message', 'Profile picture updated.');
    }

    public function download($file_path){

        $headers = ['Content-Type: application/pdf'];

        return response()->download(decrypt($file_path), null, $headers);
    }

    public function advanced_search(Request $request){

        $search = Employee::where(function($query) use($request){
            if($request->search_type_of_license != null){
                foreach($request->search_type_of_license as $license){
                    $query->where('type_of_license', 'like', '%'. $license .'%');
                }
            }
            if($request->search_age != null){
                $query->where('age', '=', $request->search_age);
            }
            if($request->search_fullname != null){
                $query->where('fullname', 'like', '%'.$request->search_fullname.'%');
            }
            if($request->search_gender != null){
                $query->where('gender', '=', $request->search_gender);
            }
            if($request->search_civil_status != null){
                $query->where('civil_status', 'like', '%'.$request->search_civil_status.'%');
            }
            if($request->search_country != null){
                $query->where('country', 'like', '%'.$request->search_country.'%');
            }
            if($request->search_state != null){
                $query->where('state', 'like', '%'.$request->search_state.'%');
            }
            if($request->search_nationality != null) {
                $query->where('nationality','like','%'.$request->search_nationality.'%');
            }
            if($request->search_has_license != null){
                $query->where('hasDriverLicense', 'like', '%'.$request->search_has_license.'%');
            }
            if($request->search_has_car != null){
                $query->where('hasCar', 'like', '%'.$request->search_has_car.'%');
            }
        })->get();

        return view('employee.index')->with('employees', $search)->render();
    }

    public function task_advanced_search_invitations(Request $request){
        $employee = Employee::where('id', \Auth::user()->employee->id)->first();

        $invited_tasks = TaskAssignment::whereHas('workforce.company', function($q) use($request){
            if($request->search_company_name != null){
                $q->where('fullname', 'like', '%' . $request->search_company_name . '%');
            }
            if($request->search_contact_person != null){
                $q->where('contact_person', 'like', '%' . $request->search_contact_person . '%');
            }
            if($request->search_department != null){
                $q->where('department', 'like', '%' . $request->search_department . '%');
            }
            if($request->search_id_number != null){
                $q->where('id_number', 'like', '%' . $request->search_id_number . '%');
            }
            if($request->search_company_address != null){
                $q->where('company_address', 'like', '%' . $request->search_company_address . '%');
            }
            if($request->search_company_country != null){
                $q->where('company_country', 'like', '%' . $request->search_company_country . '%');
            }
            if($request->search_company_state != null){
                $q->where('company_state', 'like', '%' . $request->search_company_state . '%');
            }
            if($request->search_company_zip_code != null){
                $q->where('zip_code', 'like', '%' . $request->search_company_zip_code . '%');
            }
            if($request->search_branch_address != null){
                $q->where('branch_address', 'like', '%' . $request->search_branch_address . '%');
            }
            if($request->search_branch_country != null){
                $q->where('branch_country', 'like', '%' . $request->search_branch_country . '%');
            }
            if($request->search_branch_zip_code != null){
                $q->where('zip_code', 'like', '%' . $request->search_branch_zip_code . '%');
            }
            if($request->search_work_location != null){
                $q->where('working_location', 'like', '%' . $request->search_work_location . '%');
            }
            if($request->search_telephone_number != null){
                $q->where('telephone_number', 'like', '%' . $request->search_telephone_number . '%');
            }
        })->whereHas('workforce', function($a) use($request){
            if($request->search_work_type != null){
                $a->where('work_type','like', '%'. $request->search_work_type .'%');
            }
            if($request->search_work_location != null){
                $a->where('work_location','like', '%'. $request->search_work_location .'%');
            }
            if($request->search_extra_requirements != null){
                $a->where('extra_requirements','like', '%'. $request->search_extra_requirements .'%');
            }
            if($request->search_employee_required != null){
                $a->where('employee_required','like', '%'. $request->search_employee_required .'%');
            }
            if($request->search_status != null){
                $a->where('status','like', '%' . $request->search_status . '%');
            }
        })->where(function($query) use($request){
            $query->where('employee_id', '=', \Auth::user()->employee->id);
            $query->where('status','=', 'invited');
        })->get();

        return view('employee.requests.show')
        ->with('invited_tasks', $invited_tasks)
        ->with('employee', $employee);
    }

    public function task_advanced_search_accepted(Request $request){
        $employee = Employee::where('id', \Auth::user()->employee->id)->first();

        $accepted_tasks = TaskAssignment::whereHas('workforce.company', function($q) use($request){
            if($request->search_company_name != null){
                $q->where('fullname', 'like', '%' . $request->search_company_name . '%');
            }
            if($request->search_contact_person != null){
                $q->where('contact_person', 'like', '%' . $request->search_contact_person . '%');
            }
            if($request->search_department != null){
                $q->where('department', 'like', '%' . $request->search_department . '%');
            }
            if($request->search_id_number != null){
                $q->where('id_number', 'like', '%' . $request->search_id_number . '%');
            }
            if($request->search_company_address != null){
                $q->where('company_address', 'like', '%' . $request->search_company_address . '%');
            }
            if($request->search_company_country != null){
                $q->where('company_country', 'like', '%' . $request->search_company_country . '%');
            }
            if($request->search_company_state != null){
                $q->where('company_state', 'like', '%' . $request->search_company_state . '%');
            }
            if($request->search_company_zip_code != null){
                $q->where('zip_code', 'like', '%' . $request->search_company_zip_code . '%');
            }
            if($request->search_branch_address != null){
                $q->where('branch_address', 'like', '%' . $request->search_branch_address . '%');
            }
            if($request->search_branch_country != null){
                $q->where('branch_country', 'like', '%' . $request->search_branch_country . '%');
            }
            if($request->search_branch_zip_code != null){
                $q->where('zip_code', 'like', '%' . $request->search_branch_zip_code . '%');
            }
            if($request->search_work_location != null){
                $q->where('working_location', 'like', '%' . $request->search_work_location . '%');
            }
            if($request->search_telephone_number != null){
                $q->where('telephone_number', 'like', '%' . $request->search_telephone_number . '%');
            }
        })->whereHas('workforce', function($a) use($request){
            if($request->search_work_type != null){
                $a->where('work_type','like', '%'. $request->search_work_type .'%');
            }
            if($request->search_work_location != null){
                $a->where('work_location','like', '%'. $request->search_work_location .'%');
            }
            if($request->search_extra_requirements != null){
                $a->where('extra_requirements','like', '%'. $request->search_extra_requirements .'%');
            }
            if($request->search_employee_required != null){
                $a->where('employee_required','like', '%'. $request->search_employee_required .'%');
            }
            if($request->search_status != null){
                $a->where('status','like', '%' . $request->search_status . '%');
            }
        })->where(function($query) use($request){
            $query->where('employee_id', '=', \Auth::user()->employee->id);
            $query->where('status','=', 'accepted');
        })->get();

        return view('employee.requests.accepted')
        ->with('accepted_tasks', $accepted_tasks)
        ->with('employee', $employee);
    }
}
