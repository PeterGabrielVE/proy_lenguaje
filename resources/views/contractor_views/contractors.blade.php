<?php

    //if (!(Auth::check())) {
        //echo "MNot Loggedi in";
        //die();
        //return redirect('home');
    // } else {
    //     //do nothing
    // }
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
                            
                            <h1 style="text-align: center;">All Contractors</h1>

                            <div class="breadcrumbs">
                                <div class="fa fa-hand-o-right"></div> 
                                You are here: 
                                <a href="{{url('/')}}">Home </a>
                                    >
                                <a href="{{url('/contractors/')}}">All Contractors</a>
                            </div>

                        </div>
                         
                        <div class="row">
                              
                            <?php
                                // var_dump($contractor);
                                // die();
                            ?>
                           
                            <div class="col-md-12">
                                <div class="card">

                                    <div class="card-block">
                                        
                                        <div class="my-1">
                                            @include('contractor_views/contractor_navigation_horizontal')


                                        </div>

                                         <div class="mx-auto" style="width: 400px">
                                           @include('contractor_views/contractor_bulk_email_form')
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-5 col-xs-12">
                                                <div class="pgnation-1">
                                                    Showing {{$get_showing_start_at}} to {{$get_showing_end_at}} of {{$total_number_of_entries}} entries
                                                </div>
                                            </div>
                                            <div class="col-md-7 col-xs-12">
                                                <div class="flt1a">
                                                    <a class="btn btn-default" href="{{url('/contractors/page/')}}{{$get_previous_page_number}}"> <i class="fa fa-arrow-left"></i> Previous</a>
                                                    
                                                    Page {{$get_current_page_number}}
                                                    | {{$get_no_of_pages_left}} Pages(s) Left
                                                    <a class="btn btn-default" 
                                                        href="{{url('/contractors/page')}}/{{$get_next_page_number}}">
                                                        Next <i class="fa fa-arrow-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- start list of all contractors loop-->
                                        @foreach ($contractors as $contractor)
                                        
                                        @include('contractor_views.contractor-block-section')

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
                                                    <a class="btn btn-default" href="{{url('/contractors/page/')}}{{$get_previous_page_number}}"> <i class="fa fa-arrow-left"></i> Previous</a>
                                                    
                                                    Page {{$get_current_page_number}}
                                                    | {{$get_no_of_pages_left}} Pages(s) Left
                                                    
                                                    <a class="btn btn-default" 
                                                        href="{{url('/contractors/page')}}/{{$get_next_page_number}}">
                                                        Next <i class="fa fa-arrow-right"></i>
                                                    </a>
                                                    <?php
                                                        //var_dump(url()->current());
                                                    ?>
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
