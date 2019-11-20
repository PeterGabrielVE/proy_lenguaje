<?php
    use Illuminate\Support\Facades\Input;
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
                            <div class="col-md-3 card sidebar-card">
                                @include('contractor_views/contractor_sidebar')
                            </div>

                            <?php
                                // var_dump($contractor);
                                // die();
                            ?>
                           
                            

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
                                                    $query = htmlspecialchars(trim(stripcslashes(Input::get('q'))));
                                                    $main_url = url('/contractors/s?q=') . $query . "&pg=";
                                                    $prev_pg_url = $main_url . $get_previous_page_number;
                                                    $next_pg_url = $main_url . $get_next_page_number;
                                                ?>
                                                <div class="flt1a">
                                                    <a class="btn btn-default" href="<?php echo $prev_pg_url; ?>"> <i class="fa fa-arrow-left"></i> Previous</a>
                                                    Page {{$get_current_page_number}}
                                                    | {{$get_no_of_pages_left}} Pages(s) Left
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
                                                    $query = htmlspecialchars(trim(stripcslashes(Input::get('q'))));
                                                    $main_url = url('/contractors/s?q=') . $query . "&pg=";
                                                    $prev_pg_url = $main_url . $get_previous_page_number;
                                                    $next_pg_url = $main_url . $get_next_page_number;
                                                ?>
                                                <div class="flt1a">
                                                    <a class="btn btn-default" href="<?php echo $prev_pg_url; ?>"> <i class="fa fa-arrow-left"></i> Previous</a>
                                                    Page {{$get_current_page_number}}
                                                    | {{$get_no_of_pages_left}} Pages(s) Left
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
