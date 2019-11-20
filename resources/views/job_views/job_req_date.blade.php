<?php
    use Illuminate\Support\Facades\Input;
?>

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
                                <a href="{{url('/')}}">Home</a>
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
                                    
                                    <?php
                                    if ( count($jobs) < 1 ) {
                                    ?>
                                    <div class="card">
                                        <div class="card-heading card-heading-2">
                                            <h4 class="card-title card-title-2">Nothing to display.</h4>
                                        </div>
                                    </div>
                                    <?php
                                    } else {
                                        //execute code 
                                    ?>

                                        <div class="row">
                                            <div class="col-md-5 col-xs-12">
                                                <div class="pgnation-1">
                                                    Showing {{$get_showing_start_at}} to {{$get_showing_end_at}} of {{$total_number_of_entries}} entries
                                                </div>
                                            </div>
                                            <div class="col-md-7 col-xs-12">
                                                <?php

                                                    $start_end_date = Input::get('req_date');
                                                    $start_0 = date("m/d/Y", strtotime(substr($start_end_date, 0, 10)));
                                                    $end_0 = date("m/d/Y", strtotime(substr($start_end_date, 13)));

                                                    $start = htmlspecialchars(trim(stripcslashes($start_0)));
                                                    $end = htmlspecialchars(trim(stripcslashes($end_0)));
                                                    
                                                    $main_url = url('jobs/filter_req_date?req_date=') . $start . " -  " . $end . "&pg=";

                                                    // filter_start_end_date?date_start_end=11/21/2017 - 11/21/2017

                                                    $prev_pg_url = $main_url . $get_previous_page_number;
                                                    $next_pg_url = $main_url . $get_next_page_number;
                                                ?>
                                                <div class="flt1a">
                                                    <a class="btn btn-default" href="<?php echo $prev_pg_url; ?>"> <i class="fa fa-arrow-left"></i> Previous</a>
                                                        Page {{$get_current_page_number}}
                                                        | {{$get_no_of_pages_left}} Page(s) Left
                                                    <a class="btn btn-default" 
                                                        href="<?php echo $next_pg_url; ?>">
                                                        Next <i class="fa fa-arrow-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        @foreach ($jobs as $job)

                                        <!-- start single contractor row -->

                                        @include('job_views.job-block-section')                                       
                                        <!-- end single contractor row -->

                                        @endforeach

                                    <?php
                                    }
                                    ?>

                                        <div class="row">
                                            <div class="col-md-5 col-xs-12">
                                                <div class="pgnation-1">
                                                    Showing {{$get_showing_start_at}} to {{$get_showing_end_at}} of {{$total_number_of_entries}} entries
                                                </div>
                                            </div>
                                            <div class="col-md-7 col-xs-12">
                                                <?php

                                                    $start_end_date = Input::get('req_date');
                                                    $start_0 = date("m/d/Y", strtotime(substr($start_end_date, 0, 10)));
                                                    $end_0 = date("m/d/Y", strtotime(substr($start_end_date, 13)));

                                                    $start = htmlspecialchars(trim(stripcslashes($start_0)));
                                                    $end = htmlspecialchars(trim(stripcslashes($end_0)));
                                                    
                                                    $main_url = url('jobs/filter_req_date?req_date=') . $start . " -  " . $end . "&pg=";

                                                    // filter_start_end_date?date_start_end=11/21/2017 - 11/21/2017

                                                    $prev_pg_url = $main_url . $get_previous_page_number;
                                                    $next_pg_url = $main_url . $get_next_page_number;
                                                ?>
                                                <div class="flt1a">
                                                    <a class="btn btn-default" href="<?php echo $prev_pg_url; ?>"> <i class="fa fa-arrow-left"></i> Previous</a>
                                                        Page {{$get_current_page_number}}
                                                        | {{$get_no_of_pages_left}} Page(s) Left
                                                    <a class="btn btn-default" 
                                                        href="<?php echo $next_pg_url; ?>">
                                                        Next <i class="fa fa-arrow-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        



                                        <?php
                                        //var_dump($pages_left);
                                        ?>
                                        
                                        
                                        <!-- end list of all contractors loop -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Content Wrapper END -->
@endsection
