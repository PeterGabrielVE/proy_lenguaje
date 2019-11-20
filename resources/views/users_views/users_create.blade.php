@extends('layouts.app')

@section('content')
            
    @include('sidebar')

    @include('header')

    <!-- Content Wrapper START -->
    <div class="main-content">
        <div class="container-fluid">
            
            <?php 
            echo Form::open(array('url'=>'users/create/', 'method'=>'PUT', 'id'=>'create_users_form_id'));
            //echo Form::open(array('url'=>'users/create/', 'method'=>'PUT'));
            ?>
            
            <div class="users_create_result_text"></div>
            
            <div class="page-title">
                <h1 class="crd-job-single">
                    <span class="crd-job-single-edit">You're creating a new User entry:</span>
                </h1>

                <div class="breadcrumbs">
                    <div class="fa fa-hand-o-right"></div> 
                    You are here: 
                    <a href="{{url('/')}}">Home </a>
                        >
                    <a href="{{url('/users/')}}">All Users</a>
                        >
                    <a class="create_users_page_url_a_cl" href="{{url('/users/create')}}">Create New User</a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2 col-lg-2 col-xs-12 col-sm-12"></div>
                <div class="col-md-8 col-lg-8 col-xs-12 col-sm-12">
                    <h4 class="card-title crd-brdr">User Details <i class="fa fa-user-times"></i></h4>
                    <div class="row crd-job-details">
                        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                        <!-- <div class="col-md-6 col-xs-12 col-sm-12 col-lg-6"> -->
                            <ul class="job-details-ul">
                                <?php returnInputFieldForCreateViewLi("User Full Name", "User"); ?>
                                <?php //returnInputFieldForCreateViewLi("Email Address", "Email Address"); ?>
                                <li>
                                    <label for="Email Address_Email_Address_id">Email Address:</label>
                                    <input type="email" name="Email_Address" class="form-control" id="Email Address_Email_Address_id">
                                </li>

                                <li>
                                    <label for="Email Address_Password_id">Password:</label>
                                    <input type="password" name="Password" class="form-control" id="Email Address_Password_id">
                                </li>

                                <li>
                                    <input type="checkbox" name="IsAdmin" id="Email Address_IsAdmin_id" value="1"> Is Admin
                                </li>

                                <?php //returnInputFieldForCreateViewLi("Password", "Email Address"); ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-lg-2 col-xs-12 col-sm-12"></div>
            </div>

            <div class="users_create_result_text"></div>

            <div class="edit-job-submit-cl">
                {!! Form::submit('Create User', ['class' => 'btn btn-success btn-edit-save', 'id'=>'create_User_id']) !!}
            </div>

            
            {!! Form::close() !!}
            
        </div>
    </div>
    <!-- Content Wrapper END -->

@endsection