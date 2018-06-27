<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SendEmail;

class SendEmailController extends Controller
{
    public function customize_notifications(){
        $new_employee = SendEmail::where('email_for', 'New Employee')->first();
        if(!$new_employee){
            $create_new_employee = new SendEmail;
            $create_new_employee->email_for = 'New Employee';
            $create_new_employee->subject = 'Staff.is - Welcome!';
            $create_new_employee->body = 'Thank you for registering at Staff.is.';
            $create_new_employee->save();
        }

        $new_company = SendEmail::where('email_for', 'New Company')->first();
        if(!$new_company){
            $create_new_company = new SendEmail;
            $create_new_company->email_for = 'New Company';
            $create_new_company->subject = 'Staff.is - Welcome';
            $create_new_company->body = 'Thank you for registering at Staff.is.';
            $create_new_company->save();
        }

        $email_employee = SendEmail::where('email_for', 'New Employee')->first();
        $email_company = SendEmail::where('email_for', 'New Company')->first();
        return view('email.edit')->with('email_employee', $email_employee)->with('email_company', $email_company);
    }


    public function update_notifications(Request $request){
        $employee_notif = SendEmail::where('email_for', 'New Employee')->first();
        $employee_notif->subject = $request->emp_email_subject;
        $employee_notif->body = $request->emp_email_body;
        $employee_notif->save();

        $company_notif = SendEmail::where('email_for', 'New Company')->first();
        $company_notif->subject = $request->company_email_subject;
        $company_notif->body = $request->company_email_body;
        $company_notif->save();

        return redirect('/settings/customize-email-notifications')->with('message', 'Successfully saved');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {

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
}
