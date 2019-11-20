<?php
    // date_default_timezone_set('America/New_York');
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
                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                           <div class="card">
                                <div class="card-block" style="text-align: center;">
                                    <div class="icon-card">
                                        <i class="fa fa-briefcase"></i>
                                    </div>
                                    <div class="text-card">
                                        <span><?php echo noOfJobs(); ?></span>
                                        <br/>
                                            Jobs created
                                        <br/>
                                        <a class="link" href="{{url('/jobs')}}">View All Jobs</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="card">
                                <div class="card-block" style="text-align: center;">
                                    <div class="icon-card">
                                        <i class="fa fa-user-times"></i>
                                    </div>
                                    <div class="text-card">
                                        <span><?php echo noOfContractors(); ?></span>
                                        <br/>
                                        Contractors
                                        <br/>
                                        <a class="link" href="{{url('/contractors')}}">View All Contractors</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="card">
                                <div class="card-block" style="text-align: center;">
                                    <div class="icon-card">
                                        <i class="fa fa-users"></i>
                                    </div>
                                    <div class="text-card">
                                        <span><?php echo noOfCustomers(); ?></span>
                                        <br/>
                                        Customers
                                        <br/>
                                        <a class="link" href="{{url('/customers')}}">View All Customers</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="card card-jobs-button">
                                <div class="card-block">
                                    <div class="sidebar-job-date-ranges">
                                        <h4><strong>Jobs</strong></h4>
                                        <?php
                                            echo displayNextNoOfDays("1 days", "Today's Jobs");
                                        ?>
                                        <?php
                                           echo displayNextNoOfDays("2 days", "Next Day Jobs");
                                        ?>
                                        <?php
                                            echo displayNextNoOfDays("3 days", "Next 2 Days Jobs");
                                        ?>
                                        <?php
                                            echo displayNextNoOfDays("8 days", "Next 7 Days Jobs");
                                        ?>
                                        <?php
                                            echo displayNextNoOfDays("31 days", "Next 30 Days Jobs");
                                        ?>
                                        <?php
                                            echo displayPrevNoOfDays("8 days", "Last 7 Days Jobs");
                                        ?>
                                        <?php
                                            echo displayPrevNoOfDays("3 days", "Last 2 Days Jobs");
                                        ?>
                                        <?php
                                            echo displayPrevNoOfDays("31 days", "Last 30 Days Jobs");
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <!-- Content Wrapper END -->
@endsection
