
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
                                <div class="card card-filter">
                                @include('job_views/job_navigation_horizontal')
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            {{--<div class="col-md-3 card sidebar-card">
                                @include('job_views/job_sidebar')
                            </div>--}}
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-block">

                                        <div class="row">
                                            <div class="col-md-5 col-xs-12">
                                                <div class="pgnation-1">
                                                    Showing {{$get_showing_start_at}} to {{$get_showing_end_at}} of {{$total_number_of_entries}} entries
                                                </div>
                                            </div>
                                            <div class="col-md-7 col-xs-12">
                                                <div class="flt1a">
                                                    <a class="btn btn-default" href="{{url('/jobs/page/')}}/{{$get_previous_page_number}}"> <i class="fa fa-arrow-left"></i> Previous</a>
                                                    <span>
                                                        Page {{$get_current_page_number}}
                                                            | {{$get_no_of_pages_left}} Pages(s) Left
                                                    </span>
                                                    <a class="btn btn-default" 
                                                        href="{{url('/jobs/page')}}/{{$get_next_page_number}}">
                                                        Next <i class="fa fa-arrow-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- start list of all contractors loop-->
                                        @foreach ($jobs as $job)

                                        <!-- start single contractor row -->
                                        
                                        @include('job_views.job-block-section')
                                                                               
                                        <!-- end single contractor row -->

                                        @endforeach

                                        <div class="row">
                                            <div class="col-md-5 col-xs-12">
                                                <div class="pgnation-1">
                                                    Showing {{$get_showing_start_at}} to {{$get_showing_end_at}} of {{$total_number_of_entries}} entries
                                                </div>
                                            </div>
                                            <div class="col-md-7 col-xs-12">
                                                <div class="flt1a">
                                                    <a class="btn btn-default" href="{{url('/jobs/page/')}}/{{$get_previous_page_number}}"> <i class="fa fa-arrow-left"></i> Previous</a>
                                                    <span>
                                                        Page {{$get_current_page_number}}
                                                            | {{$get_no_of_pages_left}} Pages(s) Left
                                                    </span>
                                                    <a class="btn btn-default" 
                                                        href="{{url('/jobs/page')}}/{{$get_next_page_number}}">
                                                        Next <i class="fa fa-arrow-right"></i>
                                                    </a>
                                                </div>
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
