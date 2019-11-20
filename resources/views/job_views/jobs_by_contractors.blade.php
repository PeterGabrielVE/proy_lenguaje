
@extends('layouts.app')

@section('content')
<body>
    <div class="app">
        <div class="layout">
            
            @include('sidebar')

            @include('header')

                <!-- Content Wrapper START -->
                <div class="main-content">
                    <div class="container-fluid">
                        <div class="page-title">
                            
                            <h1 style="text-align: center;">All Jobs</h1>

                            <div class="breadcrumbs">
                                <div class="fa fa-hand-o-right"></div> 
                                You are here: 
                                <a href="{{url('/')}}">Home </a>
                                    >
                                <a href="{{url('/jobs/')}}">All Jobs</a>
                            </div>

                        </div>

                          <div class="row">
                            <div class="col-md-12">
                                @include('job_views/job_navigation_horizontal')
                            </div>
                        </div> 

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-block">

                                        <!-- start list of all contractors loop-->
                                        @foreach ($jobs as $job)

                                        <!-- start single contractor row -->
                                        <div class="card">
                                            <div class="card-heading card-heading-2">
                                                Job Name: <h4 class="card-title card-title-2"><a href="{{url('/jobs/')}}/{{$job->ID}}">
                                                    <?php 
                                                        if ( strlen($job->Jobs_Job_Name) <= 0 ){
                                                            echo "<span class='empty-job-name'><i class='fa fa-meh-o'></i> Empty Job Name</span>";
                                                        } else {
                                                            echo removeQuotes( $job->Jobs_Job_Name);
                                                        }
                                                    ?>
                                                </a></h4>

                                            </div>
                                            <div class="card-body card-body-2">
                                                <div class="row single-job-row-1">
                                                    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                                                        ID: <b> {{ $job->ID }} </b> | 
                                                        Status: <b>
                                                            <?php
                                                                echo removeQuotes( $job->Jobs_Status);
                                                            ?>
                                                        </b>
                                                        <br/>
                                                        Request Date: <b>{{ $job->Job_Request_Date }}</b>
                                                        <br/>
                                                        Job Type:  <b>
                                                            <?php
                                                                echo removeQuotes( $job->Jobs_Type );
                                                            ?>
                                                        </b>
                                                        <br/>
                                                        Service Name: 
                                                        <b>
                                                            <?php
                                                                echo removeQuotes( $job->Jobs_Service_Name );
                                                            ?>
                                                        </b>
                                                    </div>    
                                                    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                                                        Job Start Time: 
                                                        <b>
                                                            <?php
                                                                echo removeQuotes( $job->Jobs_Start_Time );
                                                            ?>
                                                        </b>
                                                        <br/>
                                                        Job End Time: 
                                                        <b>
                                                            <?php
                                                                echo removeQuotes( $job->Jobs_End_Time );
                                                            ?>
                                                        </b>
                                                        <br/>
                                                        Service Type: 
                                                        <b>
                                                            <?php
                                                                echo removeQuotes( $job->Jobs_Service_Type );
                                                            ?>
                                                        </b>
                                                        <br/>
                                                        Language: 
                                                        <b>
                                                            <?php
                                                                echo removeQuotes( $job->Jobs_Language_Requested );
                                                            ?>
                                                        </b>
                                                    </div>    
                                                </div>

                                                <div class="row single-job-row-2">
                                                    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                                                        Customer Number: 
                                                        <b>
                                                            <?php
                                                                echo removeQuotes( $job->Jobs_Customers_Cus_Number );
                                                            ?>
                                                        </b>
                                                        <br/>
                                                        Customer Company: 
                                                        <b>
                                                            <?php
                                                                echo removeQuotes( $job->Jobs_Customers_Company );
                                                            ?>
                                                        </b>
                                                        <br/>
                                                        Assigment Location: 
                                                        <b>
                                                            <?php
                                                                echo removeQuotes( $job->Jobs_Assignment_Location );
                                                            ?>
                                                        </b>
                                                        <br/>
                                                        Contact Person: 
                                                        <b>
                                                            <?php
                                                                echo removeQuotes( $job->Jobs_Assignment_Contact_Person );
                                                            ?>
                                                        </b>
                                                        <br/>
                                                        LEP(Limited English Personnel) Name: 
                                                        <b>
                                                            <?php
                                                                echo removeQuotes( $job->Jobs_LEP_Name );
                                                            ?>
                                                        </b>
                                                    </div>  
                                                    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                                                        Contractor ID: 
                                                        <b>
                                                            <?php
                                                                echo removeQuotes( $job->Jobs_Contractor_ID );
                                                            ?>
                                                        </b>
                                                        <br/>
                                                        Contractor First Name: 
                                                        <b>
                                                            <?php
                                                                echo removeQuotes( $job->Jobs_Contractor_First_Name );
                                                            ?>
                                                        </b>
                                                        <br/>
                                                        Contractor Last Name: 
                                                        <b>
                                                            <?php
                                                                echo removeQuotes( $job->Jobs_Contractor_Last_Name );
                                                            ?>
                                                        </b>
                                                        <br/>
                                                        Job Notes: 
                                                        <b>
                                                            <?php
                                                                echo removeQuotes( $job->Jobs_Notes );
                                                            ?>
                                                        </b>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="card-footer border top">
                                                <ul class="list-unstyled list-inline text-right pdd-vertical-5">
                                                    <li class="list-inline-item">
                                                        <a href="{{url('/jobs/')}}/{{$job->ID}}" class="btn btn-flat btn-view-cl"> 
                                                            <i class="fa fa-eye"></i> View
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a href="{{url('/jobs/edit')}}/{{$job->ID}}" class="btn btn-flat btn-edit-cl"> 
                                                            <i class="fa fa-pencil"></i> Edit
                                                        </a>
                                                    </li>
                                                    <?php
                                                    if ( Auth::user()->is_admin == 1) {
                                                    ?>
                                                        <li class="list-inline-item">
                                                            <?php
                                                                echo Form::open(array('url'=>'jobs/delete/'.$job->ID, 'method'=>'PUT', 'id'=>'delete_job_form_id'))
                                                            ?>
                                                                <input type="hidden" name="get_the_id" value="<?php echo $job->ID; ?>">
                                                                <input 
                                                                type="submit" 
                                                                class="btn btn-flat btn-delete-cl"
                                                                id="delete_single_job" value="DELETE">
                                                            {!! Form::close() !!}
                                                        </li>
                                                    <?php        
                                                    }
                                                    ?>
                                                </ul>
                                            </div>
                                        </div>                                       
                                        <!-- end single contractor row -->

                                        @endforeach

                                        <div class="row">
                                            <div class="col-md-5 col-xs-12">
                                                <div class="pgnation-1">
                                                    Showing {{$get_showing_start_at}} to {{$get_showing_end_at}} of {{$total_number_of_entries}} entries
                                                </div>
                                            </div>
                                            <div class="col-md-7 col-xs-12">
                                                <?php
                                                    $main_url = url('/jobs/f/'). "/" . removeQuotes($job->Jobs_Contractor_First_Name) . "/l/" . removeQuotes($job->Jobs_Contractor_First_Name) . "/pg/";
                                                    $prev_pg_url = $main_url . $get_previous_page_number;
                                                    $next_pg_url = $main_url . $get_next_page_number;
                                                ?>
                                                <div class="flt1a">
                                                    <a class="btn btn-default" href="<?php echo $prev_pg_url; ?>"> <i class="fa fa-arrow-left"></i> Previous</a>
                                                    <span>
                                                        Page {{$get_current_page_number}}
                                                            | {{$get_no_of_pages_left}} Pages(s) Left
                                                    </span>
                                                    <a class="btn btn-default" 
                                                        href="<?php echo $next_pg_url; ?>">
                                                        Next <i class="fa fa-arrow-right"></i>
                                                    </a>
                                                </div>
                                                
                                        </div>
                                        <!-- end list of all contractors loop -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Content Wrapper END -->
@endsection
