<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Employee;
use App\Company;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/tasks';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){

        $user_type = $request->user_type;
        Session::put('user_type', $user_type);

        if ($user_type == "employee"){
            if((Auth::attempt(['email' => $request->email, 'password' => $request->password, 'user_type' => $request->user_type])) || (Auth::attempt(['contact_number' => $request->email, 'password' => $request->password, 'user_type' => $request->user_type]))){

                //on first login, redirect to employee profile page
                $user_id = Auth::id();
                $employee = Employee::where('user_id', $user_id)->first();

                Session::put('name', $employee->fullname);
                //geolocation here (session->put())
                $jsonurl = "http://freegeoip.net/json/";
                $json = file_get_contents($jsonurl);
                $decoded = json_decode($json, true);
                session()->put('country_code', $decoded['country_code']); 

                if($employee->login_count == 1){
                    if($employee->status == 1){
                        session()->put('employee_id', $employee->id);

                        if($employee->profile_image_filepath == null){
                            $profile_picture = null;
                        } else {
                            $profile_picture = decrypt($employee->profile_image_filepath);
                        }
                        session()->put('profile_picture', $profile_picture);
                        if($request->hidden_redirect_url){
                            return redirect('/tasks/' . $request->hidden_id);
                        } else {
                            return redirect('/tasks/employee/' . $employee->id . '/accepted-invitations/');
                        }
                        
                    } else {
                        return redirect('/deactivated');
                    }
                } else {
                    session()->put('employee_id', $employee->id);
                    return redirect('employee/'.$employee->id.'/edit');
                }
            } else {
                //with errors
                Session::flash('message', 'Invalid login credentials!');
                return back();
            }
        } elseif($user_type == 'company'){
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'user_type' => $request->user_type])){
                $user_id = Auth::id();
                $company = Company::where('user_id', $user_id)->first();
                Session::put('name', $company->fullname);

                session()->put('company_id', $company->id);
                if($company->login_count == 1){
                    if($company->is_approved == 0) {
                        \Session::flush();
                        \Auth::logout();
                        session()->flash('message', 'Your account is still under review by the admininistrator.');
                        return redirect('/login');
                    } else {
                        if($company->profile_image_filepath == null){
                            $profile_picture = null;
                        } else {
                            $profile_picture = decrypt($company->profile_image_filepath);
                        }
                        session()->put('profile_picture', $profile_picture);
                        if($request->hidden_redirect_url){
                            return redirect('/tasks/' . $request->hidden_id);
                        } else {
                            return redirect('/tasks');
                        }
                    }
                } else {
                    return redirect('company/'.$company->id.'/edit');
                }

                session()->put('company_id', $company->id);
                return redirect('/tasks');
            }else{
                Session::flash('message', 'Invalid login credentials!');
                return redirect('/login');
            }
        } else {
            //$user_type = 'admin'
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'user_type' => $request->user_type])){
                Session::put('name', 'Administrator');
                if($request->hidden_redirect_url){
                    return redirect('/tasks/' . $request->hidden_id);
                } else {
                    return redirect('/tasks');
                }
            }else{
                Session::flash('message', 'Invalid login credentials!');
                return redirect('/login');
            }
        }
    }
}