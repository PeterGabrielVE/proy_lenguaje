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
                            <div class="col-md-3 card sidebar-card">
                                @include('contractor_views/contractor_sidebar')
                            </div>

                            <div class="col-md-9">
                                <div class="card">
                                    <div class="card-block">
                                        
                                        @include('contractor_views/contractor_bulk_email_form')

                                        <div class="row">
                                            <div class="col-md-5 col-xs-12">
                                                <div class="pgnation-1">
                                                    Showing {{$get_showing_start_at}} to {{$get_showing_end_at}} of {{$total_number_of_entries}} entries
                                                </div>
                                            </div>
                                            <div class="col-md-7 col-xs-12">
                                                <?php
                                                    $lang = htmlspecialchars(trim(stripcslashes(Input::get('lang'))));
                                                    $state = htmlspecialchars(trim(stripcslashes(Input::get('state'))));
                                                    $zip = htmlspecialchars(trim(stripcslashes(Input::get('zip'))));
                                                    $rad = htmlspecialchars(trim(stripcslashes(Input::get('distance_radius'))));
                                                    $main_url = url('/contractors/filter_all?lang=') . $lang . "&state=" . $state . "&zip=" . $zip . "&distance_radius=" . $rad . "&page=";
                                                    $prev_pg_url = $main_url . $get_previous_page_number;
                                                    $next_pg_url = $main_url . $get_next_page_number;
                                                ?>
                                                <div class="flt1a">
                                                    <a class="btn btn-default" href="<?php echo $prev_pg_url; ?>"> <i class="fa fa-arrow-left"></i> Previous</a>
                                                    <span>
                                                        Page {{$get_current_page_number}} |
                                                        {{$get_no_of_pages_left}} Pages(s) Left
                                                    </span>
                                                    <a class="btn btn-default" 
                                                        href="<?php echo $next_pg_url; ?>">
                                                        Next <i class="fa fa-arrow-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- start list of all contractors loop-->
                                            @foreach ($contractors as $contractor)
                                        <!-- start single contractor row -->

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
                                                <?php
                                                    $lang = htmlspecialchars(trim(stripcslashes(Input::get('lang'))));
                                                    $state = htmlspecialchars(trim(stripcslashes(Input::get('state'))));
                                                    $zip = htmlspecialchars(trim(stripcslashes(Input::get('zip'))));
                                                    $rad = htmlspecialchars(trim(stripcslashes(Input::get('distance_radius'))));
                                                    $main_url = url('/contractors/filter_all?lang=') . $lang . "&state=" . $state . "&zip=" . $zip . "&distance_radius=" . $rad . "&page=";
                                                    $prev_pg_url = $main_url . $get_previous_page_number;
                                                    $next_pg_url = $main_url . $get_next_page_number;
                                                ?>
                                                <div class="flt1a">
                                                    <a class="btn btn-default" href="<?php echo $prev_pg_url; ?>"> <i class="fa fa-arrow-left"></i> Previous</a>
                                                    <span>
                                                        Page {{$get_current_page_number}} |
                                                        {{$get_no_of_pages_left}} Pages(s) Left
                                                    </span>
                                                    <a class="btn btn-default" 
                                                        href="<?php echo $next_pg_url; ?>">
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
