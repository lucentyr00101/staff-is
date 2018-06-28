<?php

$user_type = Session::get('user_type');
$name = Session::get('name');
if(session()->has('employee_id')){
    $id = session()->get('employee_id');
} elseif(session()->has('company_id')) {
    $id = session()->get('company_id');
} else {

}
?>

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Staff.is') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/menu.js') }}"></script>
    
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
</head>
<body>
    <div class="body-header">
        <div class="sidebar-logo">
            <img src="{{asset('img/logo.png')}}" alt="">
        </div>
        <div class="account-container">
            <div class="account-header">
                <?php
                if(session()->get('profile_picture') != null){
                    $dp = basename(session()->get('profile_picture'));
                } else {
                    $dp = null;
                }
                ?>
                @if(session()->get('user_type') == 'employee' || session()->get('user_type') == 'company')
                @if(session()->has('profile_picture'))
                <div class="col-md-3 col-lg-3 navbar-pic" align="center"> <img alt="User Pic" src="<?php echo asset("storage/profile_pictures") . '/' . $dp; ?>" class="img-circle img-responsive">
                </div>
                @else
                <a href=""><img src="{{asset('img/act-df-img.png')}}" alt=""></a>
                @endif
                @else
                <a href=""><img src="{{asset('img/act-df-img.png')}}" alt=""></a>
                @endif
                <div class="account-name">
                    <div class="acct-name">
                        @if(Session::has('name'))
                        <a href=""><span>{{$name}}</span></a>
                        @else
                        <a href=""><span>Unnamed</span></a>
                        @endif
                    </div>
                </div>
                <div class="account-burger-container" onclick='brg(this)'>
                    <div class="account-burger">
                        <div class="bar1"></div>
                        <div class="bar2"></div>
                        <div class="bar3"></div>
                    </div>
                </div>
            </div>
            <div class="account-click">
                <ul>
                    <div class="account-click-item-wrapper">
                        @if($user_type == 'admin')
                        <!-- show --><a style='display:block;' href=""><img src="{{asset('img/acct.png')}}" alt=""><li>My Account</li></a>
                        @elseif($user_type == 'company')
                        <!-- show --><a style='display:block;' href="{{ URL::to('company/' . $id) }}"><img src="{{asset('img/acct.png')}}" alt=""><li>My Account</li></a>
                        @else
                        <!-- show --><a style="display:block;" href="{{ URL::to('employee/' . $id) }}"><img src="{{asset('img/acct.png')}}" alt=""><li>My Account</li></a>
                        @endif
                    </div>
                    <div class="account-click-item-wrapper">
                        <a style="display:block;" href='{{ url("/logout") }}'><img src="{{asset('img/logout.png')}}" alt=""><li>Logout</li></a>
                    </div>
                </ul>
            </div>
        </div>
    </div>

    <div class="content-container">
        <div id='cssmenu'>
            <ul>

                <!-- Employees -->
                @if($user_type == 'company')
                <li class="{{ Request::is(['employee/*', 'employee']) ? '-active' : '' }}"><a href='/employee'><span>Employees</span></a></li>
                @elseif($user_type == 'admin')
                <li class="{{ Request::is(['employee/*', 'employee']) ? 'active' : '' }} has-sub"><a><span>Employees</span></a>
                    <ul>
                        <li><a href='{{ url("employee") }}'><span>List All Employees</span></a></li>
                        <li class='last'><a href='{{ url("/employee/create") }}'><span>Create New Employee</span></a></li>
                    </ul>
                </li>
                @endif

                <!-- Companies -->
                @if($user_type == 'admin')
                <li class="{{ Request::is(['company/*', 'company']) ? 'active' : '' }} has-sub">
                    <a>
                        <span>Companies
                            <?php 
                            if($new_company > 0){ 
                                echo "<span style='background-color:red; padding:3px 10px; border-radius:100%; margin-left:10px;'>" . $new_company . "</span>";
                            } else {
                                echo "";
                            }
                            ?>
                        </span>
                    </a>
                    <ul>
                        <li><a href='{{ url("/companies") }}'><span>List All Companies</span></a></li>
                        <li class='last'><a href='{{ url("/company/create") }}'><span>Create New Company</span></a></li>
                    </ul>
                </li>
                @elseif(session()->get('user_type') == 'employee')
                <li class="{{ Request::is(['company/*', 'company']) ? 'active' : '' }}"><a href='{{ url("/company") }}'><span>Companies</span></a></li>
                @endif

                <!-- Timesheets -->
                @if($user_type == 'employee')
                <li class="{{ Request::is(['timesheets/*', 'timesheets']) ? 'active' : '' }}"><a href='{{ url("/tasks/employee/".$id."/accepted-invitations/") }}'><span>Timesheets</span></a></li>
                @endif

                <!-- Tasks -->
                @if($user_type == 'employee')
                <li class="{{ Request::is(['tasks/*', 'tasks']) ? 'active' : '' }} has-sub">
                    <a>
                        <span>
                            Tasks
                            <?php 
                            if($new_task > 0){ 
                                echo "<span style='background-color:red; padding:3px 10px; border-radius:100%; margin-left:10px;'>" . $new_task . "</span>";
                            } else {
                                echo "";
                            }
                            ?>
                        </span>
                    </a>
                    <ul>
                        <li><a href='{{ url("/tasks/employee/".$id."/task-invitations/") }}'><span>All Task Invitations</span></a></li>
                        <li class='last'><a href='{{ url("/tasks/employee/".$id."/accepted-invitations/") }}'><span>All Accepted Invitations</span></a></li>
                    </ul>
                </li>
                @elseif($user_type == 'company')
                <li class="{{ Request::is(['tasks/*', 'tasks']) ? 'active' : '' }} has-sub"><a><span>Tasks</span></a>
                    <ul>
                        <li><a href='{{ url("/tasks") }}'><span>List All Tasks</span></a></li>
                        <li class='last'><a href='{{ url("/tasks/create") }}'><span>Create New Task</span></a></li>
                    </ul>
                </li>
                @elseif($user_type == 'admin')
                <li class="{{ Request::is(['tasks/*', 'tasks']) ? 'active' : '' }}">
                    <a href='/tasks'>
                        <span>Tasks</span>
                    </a>
                </li>
                @endif

                <!-- Settings -->
                @if($user_type == 'admin')
                <li class="last {{ Request::is(['settings/*', 'settings']) ? 'active' : '' }} has-sub"><a><span>Settings</span></a>
                    <ul>
                        <li><a href='{{ url("/settings/customize-email-notifications") }}'><span>Customize Email Notifications</span></a></li>
                        <li class='last'><a href='{{ url("/settings/selection-option-manager") }}'><span>Selection Option Manager</span></a></li>
                    </ul>
                </li>
                @elseif($user_type == 'employee')
                <li class="{{ Request::is(['settings/*', 'settings']) ? 'active' : '' }} has-sub"><a><span>Settings</span></a>
                    <ul>
                        <li><a href='{{ url("/settings/employee/deactivate") }}'><span>Deactivate Profile</span></a></li>
                    </ul>
                </li>
                @endif

                <!-- Logout -->
                <li class="last"><a href='{{ url("/logout") }}'><span>Logout</span></a></li>

            </ul>
        </div>
        <div class="body-container">
            <div class="body-content">
                @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
                @endif
                @yield('content')
            </div>
        </div>
    </div>
</div>

<script src='{{asset("js/admin.js") }}'></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
</body>
</html>