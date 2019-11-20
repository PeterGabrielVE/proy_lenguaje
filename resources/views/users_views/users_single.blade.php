@extends('layouts.app')

@section('content')
            
    @include('sidebar')

    @include('header')

    <!-- Content Wrapper START -->
    <div class="main-content">
        <div class="container-fluid">
        
            <?php
                // if the array returns no value
                if ( count($users) <= 0 ){
            ?>                    
                <div class='page-title'>
                    <h1 class='crd-job-single'>
                        No User To Display
                    </h1>
                    <h3 style="text-align: center;">
                        <a href="{{url('/')}}">Return Home</a>    
                    </h3>                            
                </div>
            <?php
                }
            ?>

            @foreach ($users as $user)
        
            
            

            <div class="row">
                
                <div class="col-md-12">
                    <!-- start displaying user details here -->
                    

                    <div class="row">
                        <div class="col-md-2 col-lg-2 col-xs-12 col-sm-12"></div>

                        <div class="col-md-8 col-lg-8 col-xs-12 col-sm-12">

                            <div class="page-title">

                <h1 class="crd-job-single">
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
                    <a href="{{url('/users/')}}">All Users</a>
                        >
                    <a href="{{url('/user/')}}/{{$user->id}}">Viewing Single User</a>
                </div>

            </div>

            
                            <div class="card">
                                <div class="card-heading border bottom">
                                    <h4 class="card-title crd-brdr">User Details 1</h4>
                                    <div class="row crd-job-details">
                                        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                                        <!-- <div class="col-md-6 col-xs-12 col-sm-12 col-lg-6"> -->
                                            <ul class="job-details-ul">
                                                <?php returnTextForModelSingleView("Name", $user->name); ?>
                                                <?php returnTextForModelSingleView("Email", $user->email); ?>
                                                <?php returnTextForModelSingleView("Created", $user->created_at); ?>
                                            </ul>
                                            <ul class="job-details-ul">
                                                <li></li>
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

            <div class="single-job-edit">
                <ul class="list-unstyled list-inline text-right pdd-vertical-5">
                    <li class="list-inline-item">
                        <a href="{{url('/users/edit')}}/{{$user->id}}" class="btn btn-flat btn-edit-cl"> 
                            <i class="fa fa-pencil"></i> Click Here To Edit User
                        </a>
                    </li>
                </ul>
            </div>

            <div class="row breadcrumbs-2">
                <?php
                    $next_con = $user->id + 1;
                    $previous_con = $user->id - 1;
                ?>
                <div class="col-md-6 breadcrumbs-2-prv">
                    <?php
                        if ( $user->id == 1 ) {
                            //do nothing
                        } else {
                            //display it
                    ?>
                            <a href="{{url('/users/')}}/{{$previous_con}}">
                                <i class="fa fa-arrow-left"></i> Previous User
                            </a>
                    <?php
                        }
                    ?>
                </div>
                <div class="col-md-6 breadcrumbs-2-nxt">
                    <a href="{{url('/users/')}}/{{$next_con}}">
                        Next User <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            
            @endforeach

        </div>
    </div>
    <!-- Content Wrapper END -->

@endsection