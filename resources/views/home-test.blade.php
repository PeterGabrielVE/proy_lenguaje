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
                    <div class="card">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="home-page-title-1">Contractors by State</div>
                                <div class="maps map-500 padding-20">
                                    <div id="monthly-target">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 border left border-hide-sm">
                                <!-- <div class="card-block"> -->
                                    <div class="home-page-title-1">Last 50 Contractors</div>
                                    <div class="home-page-contractor-list">
                                        <?php
                                            homepageContractorList();
                                        ?>
                                    </div>
                                <!-- </div> -->
                            </div>
                        </div>
                        <div class="card-footer d-none d-md-inline-block">
                            <div class="text-center">
                                <div class="row">
                                    <div class="col-md-4">
                                        <a style="color:#000;font-weight: bold;" class=" btn btn-default homepage_contractors_url" href="{{url('/contractors')}}"><?php echo noOfContractors() . " Contractors"; ?></a>
                                    </div>
                                    <div class="col-md-4">
                                        <form action="{{url('/contractors/s/')}}" method="GET" id="mainContrSearchid" class="mainContrSearch-cl home-page-contractor-search-form">
                                            <input type="text" name="q" class="form-control contrctr-search-btn" id="main_cont_search_id" placeholder="search for Contractor">
                                            <input type="submit" name="s" value="Search" class="btn btn-warning contrctr-search-submit">
                                        </form>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="{{url('/contractors/create')}}"> <h3 class="btn btn-success" style="text-align: center;"> <i class="fa fa-plus"></i> Create New Contractor</h3> </a>    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                           <div class="card">
                                <div class="card-block" style="text-align: center;">
                                    
                                    <?php echo noOfJobs(); ?>
                                        Jobs created
                                    <br/>
                                    <a class="btn btn-success homepage_job_url" href="{{url('/jobs')}}">View All Jobs</a>
                                    
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-block">
                                    <div class="sidebar-job-date-ranges">
                                        <h4><strong>Jobs</strong></h4>
                                        <?php
                                            echo displayNextNoOfDays("1 days", "Today's Jobs");
                                        ?>
                                        <br/>
                                        <?php
                                            echo displayNextNoOfDays("3 days", "Next 2 Days Jobs");
                                        ?>
                                        <br/>
                                        <?php
                                            echo displayNextNoOfDays("8 days", "Next 7 Days Jobs");
                                        ?>
                                        <br/>
                                        <?php
                                            echo displayNextNoOfDays("31 days", "Next 30 Days Jobs");
                                        ?>
                                        <br/>
                                        <?php
                                            echo displayPrevNoOfDays("8 days", "Last 7 Days Jobs");
                                        ?>
                                        <br/>
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
                        <div class="col-lg-4 col-md-4">
                            <div class="card">
                                <div class="card-block" style="text-align: center;">
                                        <?php echo noOfCustomers(); ?> Customers
                                    <br/>
                                    <a class="btn btn-success" href="{{url('/customers')}}">View All Customers</a>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <!-- Content Wrapper END -->
@endsection
