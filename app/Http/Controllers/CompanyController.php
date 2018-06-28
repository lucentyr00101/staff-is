<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\User;
use Carbon\Carbon;
use Mail;
use App\SendEmail;
use App\Employee;
use DateTime;
use File;

class CompanyController extends Controller
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
        if(session()->get('user_type') == 'employee'){
            $employee = Employee::find(session()->get('employee_id'));
            return view('company.index')
            ->with('employee', $employee);
        } elseif(session()->get('user_type') == 'admin') {
            $pending = Company::where('is_approved', 0)->orderBy('id', 'desc')->get();
            $companies = Company::where('is_approved', 1)->orderBy('id', 'desc')->get();
            return view('company.index')
            ->with('companies', $companies)
            ->with('pendings', $pending);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create');
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
            'fullname' => 'required',
            'email' => 'required|email',
            'contactno' => 'required',
            'password' => 'min:6|required',
        ]);

        $user = new User;
        $user->email = $request->email;
        $user->password = \Hash::make($request->password);
        $user->user_type = 'company';
        $user->contact_number = $request->contactno;
        $user->save();

        if($user){
            $email_db = SendEmail::where('email_for', 'New Company')->first();

            Mail::send('email.employee_welcome', array('email' => $request->email, 'body' => $email_db->body), function($message) use($request, $email_db) {
                $message->to($request->email, $request->email)->subject($email_db->subject);
            });

            $company = new Company;
            $company->user_id = $user->id;
            $company->fullname = $request->fullname;
            $company->save();
        }

        \Session::flash('message', 'Company successfully created');
        return redirect('/company/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::find($id);

        //remove notif if admin views the company profile for the first time
        if(session()->get('user_type') == 'admin'){
            $company->is_read_by_admin = 1;
            $company->save();
        }

        //schedule conversion start
        if(($company->company_schedule != null) && (count($company->company_schedule))){
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

                    $base_day = $base_sched['schedule_day'];
                    $base_time_in = $base_sched['schedule_time_in'];
                    $base_time_out = $base_sched['schedule_time_out'];

                    $day = $single_sched['schedule_day'];
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
            $company->result = $result;
        } else {
            $company->result = null;
        }
        //schedule conversion end


        if($company){
            return view('company.show')
            ->with('company', $company);
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
        $company = Company::find($id);
        $user_type = session()->get('user_type');

        //schedule conversion start
        if(($company->company_schedule != null) && (count($company->company_schedule))){
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

                    $base_day = $base_sched['schedule_day'];
                    $base_time_in = $base_sched['schedule_time_in'];
                    $base_time_out = $base_sched['schedule_time_out'];

                    $day = $single_sched['schedule_day'];
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
            $company->result = $result;
        }
        //schedule conversion end

        if($company){
            if($user_type == 'admin'){
                return view('company.edit')
                ->with('company', $company);
            } elseif($user_type == 'company' && $company->login_count == 0){
                return view('profile.createcompany')
                ->with('company', $company);
            } elseif($user_type == 'company' && $company->login_count != 0){
                return view('company.edit')
                ->with('company', $company);
            }
        } else {
            abort(404);
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
        if($request->password){
            $request->validate([
                'password' => 'confirmed'
            ]);
            $user = User::find($request->user()->id);
            if(\Hash::check($request->old_password, $user->password)){
                $company = Company::find($id);
                $company->fullname = $request->fullname;
                $company->save();
                $user->password = \Hash::make($request->password);
                $user->save();
                
                \Session::flash('message', 'Successfully saved and Password changed!');
            }else{
                \Session::flash('error_message', 'Old password does not match our records');
                return redirect('/company/'.$id.'/edit');
            }
        } else {

            $request->validate([
                'company_address' => 'required',
                'company_country' => 'required',
                'company_state' => 'required',
                'company_zip_code' => 'required',
                'branch_address' => 'required',
                'branch_country' => 'required',
                'branch_state' => 'required',
                'branch_zip_code' => 'required',
            ]);

            $company = Company::find($id);
            $company->fullname = $request->fullname;
            $company->contact_person = $request->contact_person;
            $company->department = $request->department;
            $company->id_number = $request->id_p2;
            $company->company_address = $request->company_address;
            $company->company_state = $request->company_state;
            $company->company_country = $request->company_country;
            $company->company_zip_code = $request->company_zip_code;
            $company->branch_address = $request->branch_address;
            $company->branch_state = $request->branch_state;
            $company->branch_country = $request->branch_country;
            $company->branch_zip_code = $request->branch_zip_code;
            $company->working_location = $request->working_location_state;

            $company->telephone_number = $request->telephone;

            //send email to admin after FIRST TIME of updating profile
            if($company->login_count = 0){
                $admins = User::where('user_type', 'admin')->get();
                foreach($admins as $admin){
                    Mail::send('email.new_company_registered', array('email' => $admin->email, 'company_profile_link' => url('/companies/'.$company->id)), function($message) {
                        $message->to($admin->email, $admin->email)->subject('New Company Registration');
                    });
                }
            }

            $company->login_count = 1;

            //COMPANY LOGO
            if (!file_exists(storage_path('app/public/profile_pictures/'))) {
                mkdir(storage_path('app/public/profile_pictures/'), 0777, true);
            }

            if($request->hasFile('profile_image')){
                if($company->profile_image_filepath != null){
                    $dp_get_filepath = decrypt($company->profile_image_filepath);
                    $filename = basename($dp_get_filepath);
                    File::delete(storage_path('app/public/profile_pictures/' . $filename)); //delete file from local storage
                    $company->profile_image_filepath = null;
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
                $company->profile_image_filepath = $encrypted_filepath;

                session()->put('profile_picture', $filepath);
            }

            $company->save();

            //save email and contact_number to users table
            $email = User::where('id', $company->user_id)->first();
            $email->contact_number = $request->contact_number;
            $email->email = $request->email;
            $email->save();



            if($company->is_approved == 1){
                \Session::flash('message', 'Successfully saved!');
                return redirect('company/' . $id);
            } else {
                \Session::flush();
                \Auth::logout();
                session()->flash("success", "Profile saved. Please wait for admin's approval.");
                return redirect('/login');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::find($id);
        $company->user->delete();

        // redirect
        \Session::flash('message', 'Successfully deleted!');
        return redirect('/company');
    }

    public function approve($company_id){
        $approve = Company::where('id', $company_id)->first();
        $approve->is_approved = 1;

        
        Mail::send('email.company_approved', array('email' => $approve->user->email), function($message) use($approve) {
            $message->to($approve->user->email, $approve->user->email)->subject('Staff.is Profile Review');
        });
        
        $approve->save();


        return redirect('/company')
        ->with('message', 'Company approved.');
    }

    public function change_profile_picture(Request $request, $id){
        $dp_query = Company::where('id', $id)->first();
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

        return redirect('/company/' . $id . '/edit/')
        ->with('message', 'Profile picture updated.');
    }
}
