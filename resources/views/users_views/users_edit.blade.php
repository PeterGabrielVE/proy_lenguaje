@extends('layouts.app')

@section('content')
            
    @include('sidebar')

    @include('header')

    <!-- Content Wrapper START -->
    <div class="main-content">
        <div class="container-fluid">
            @foreach ($users_with_id as $user)

            <?php 
                echo Form::open(array('url'=>'users/edit/'.$user->id, 'method'=>'PUT', 'id'=>'edit_users_form_id'));
                // echo Form::open(array('url'=>'users/edit/'.$user->id, 'method'=>'PUT'));
            ?>
            
            <div class="users_edit_result_text"></div>
            
            <div class="page-title">
                <h1 class="crd-job-single">
                    <span class="crd-job-single-edit">You're editing a user:</span>
                    <br/>
                    <?php 
                        if ( 
                               (strlen($user->name) <= 0 )
                            ){
                            echo "<span class='empty-job-name'><i class='fa fa-meh-o'></i> Empty User Name</span>";
                        } else {
                            echo removeQuotes($user->name);

                        }
                    ?>
                </h1>

                <div class="breadcrumbs">
                    <div class="fa fa-hand-o-right"></div> 
                    You are here: 
                    <a href="{{url('/')}}">Home </a>
                        >
                    <a class="all_users_page_url_a_cl" href="{{url('/users/')}}">Users</a>
                        >
                    <a class="edit_users_page_url_a_cl" href="{{url('/users/edit')}}/{{$user->id}}">Edit User</a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <!-- start displaying user details here -->
                    
                    <div class="row">
                        <div class="col-md-2 col-lg-2 col-xs-12 col-sm-12"></div>

                        <div class="col-md-8 col-lg-8 col-xs-12 col-sm-12">
                            <div class="card">
                                <div class="card-heading border bottom">
                                    <h4 class="card-title crd-brdr">User Details <i class="fa fa-user-times"></i></h4>
                                    <div class="row crd-job-details">
                                        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                                        <!-- <div class="col-md-6 col-xs-12 col-sm-12 col-lg-6"> -->
                                            <ul class="job-details-ul">

                                                <input type="hidden" name="user_id" 
                                                    value="<?php echo $user->id; ?>">

                                                <?php inputFieldModelEditViewLi("Full Name", $user->name, "user"); ?>
                                                <?php inputFieldDisabledModelEditViewLi("Email Address", $user->email, "user"); ?>
                                                 <li>
                                                    <label for="password">Password</label>
                                                    <input id="password" type="password" class="form-control" name="password" value="">
                                                </li>
                                            </ul>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>       
                        </div>

                        <div class="col-md-2 col-lg-2 col-xs-12 col-sm-12"></div>
                        
                       
                    </div>
                    <!-- end displaying user details here -->
                </div>
            </div>
            
            <div class="users_edit_result_text"></div>

            <div class="edit-job-submit-cl">
                {!! Form::submit('Save Changes', ['class' => 'btn btn-success btn-edit-save', 'id'=>'edit_user_id']) !!}
            </div>

            
            {!! Form::close() !!}

            <div class="row breadcrumbs-2">
                <?php
                    $next_user = $user->id + 1;
                    $previous_user = $user->id - 1;
                ?>
                <div class="col-md-6 breadcrumbs-2-prv">
                    <?php
                        if ( $user->id == 1 ) {
                            //do nothing
                        } else {
                            //display it
                    ?>
                            <a href="{{url('/users/')}}/{{$previous_user}}">
                                <i class="fa fa-arrow-left"></i>Previous User
                            </a>
                    <?php
                        }
                    ?>
                </div>
                <div class="col-md-6 breadcrumbs-2-nxt">
                    <a href="{{url('/users/')}}/{{$next_user}}">
                        Next User <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            @endforeach
            
        </div>
    </div>
    <!-- Content Wrapper END -->

@endsection