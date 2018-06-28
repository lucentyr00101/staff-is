<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Employee;
use App\Company;
use App\EmploymentHistory;
use App\EmployeePreferableWork;
use App\EmployeeHealthProblem;
use App\EmployeeEducationHistory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Mail;
use App\SendEmail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function register(Request $request){
        if ($request->user_type == "employee"){

            $message = [
                'contactno.numeric' => 'Must be a valid contact number.',
            ];

            $request->validate([
                'email'                 => 'required|unique:users|email',
                'contactno'             => 'required|numeric',
                'password'              => 'required|string|min:6|confirmed',
                'password_confirmation' => 'required'
            ],$message);

            if ($request->password == $request->password_confirmation){

                $user = new User;
                $user->email = $request->email;
                $user->password = \Hash::make($request->password);
                $user->user_type = $request->user_type;
                $user->contact_number = $request->contactno;
                $user->save();

                if($user){
                    $email_db = SendEmail::where('email_for', 'New Employee')->first();

                    $send = Mail::send('email.employee_welcome', array('email' => $request->email, 'body' => $email_db->body), function($message) use($request, $email_db) {
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

                        return redirect('/login')->with('success', 'Successfully registered. You may now log in.');
                    }else{
                        return "error saving employee, try again";
                    }
                }else{
                    return "user is not saved successfully, try again";
                }
            }else{
                return "password does not match, try again";
            }
        }else if ($request->user_type == "company"){
            
            $message = [
                'contactno.numeric' => 'Must be a valid contact number.',
            ];

            $request->validate([
                'fullname'              => 'required',
                'email'                 => 'required|unique:users|email',
                'contactno'             => 'required|numeric',
                'password'              => 'required|string|min:6|confirmed',
                'password_confirmation' => 'required',
            ], $message);

            if ($request->password == $request->password_confirmation){

                $user = new User;
                $user->email = $request->email;
                $user->password = \Hash::make($request->password);
                $user->contact_number = $request->contactno;
                $user->user_type = $request->user_type;
                $user->save();

                if($user){
                    $email_db = SendEmail::where('email_for', 'New Company')->first();

                    Mail::send('email.employee_welcome', array('email' => $request->email, 'body' => $email_db->body), function($message) use($request, $email_db) {
                        $message->to($request->email, $request->email)->subject($email_db->subject);
                    });

                    Mail::send('email.employee_welcome', array('email' => $request->email, 'body' => $email_db->body), function($message) use($request, $email_db) {
                        $message->to($request->email, $request->email)->subject($email_db->subject);
                    });

                    $company = new Company;
                    $company->user_id = $user->id;
                    $company->fullname = $request->fullname;
                    $company->is_approved = 0;
                    $company->save();

                    if ($company){
                        return redirect('/login')->with('success', "Successfully registered. You may now log in.");
                    }else{
                        return "error saving company, try again";
                    }

                }else{
                    return "user is not saved successfully, try again";
                }
            }else{
                return "password does not match, try again";
            }
        }
    }
}
