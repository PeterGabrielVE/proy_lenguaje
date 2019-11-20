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
                            
                            <h1 style="text-align: center;">All Customers</h1>

                            <div class="breadcrumbs">
                                <div class="fa fa-hand-o-right"></div> 
                                You are here: 
                                <a href="{{url('/')}}">Home </a>
                                    >
                                <a href="{{url('/customers/')}}">All Customers</a>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-3 card sidebar-card">
                                @include('customers_views/customers_sidebar')
                            </div>

                            <div class="col-md-9">
                                <div class="card">
                                    <div class="card-block">
                                        
                                        <div class="row">
                                            <div class="col-md-5 col-xs-12">
                                                <div class="pgnation-1">
                                                    Showing {{$get_showing_start_at}} to {{$get_showing_end_at}} of {{$total_number_of_entries}} entries
                                                </div>
                                            </div>
                                            <div class="col-md-7 col-xs-12">
                                                <?php
                                                    $query = htmlspecialchars(trim(stripcslashes(Input::get('q'))));
                                                    $main_url = url('/customers/s?q=') . $query . "&pg=";
                                                    $prev_pg_url = $main_url . $get_previous_page_number;
                                                    $next_pg_url = $main_url . $get_next_page_number;
                                                ?>
                                                <div class="flt1a">
                                                    <a class="btn btn-default" href="<?php echo $prev_pg_url; ?>"> <i class="fa fa-arrow-left"></i> Previous</a>
                                                    
                                                    Page {{$get_current_page_number}} | {{$get_no_of_pages_left}} Page(s) Left
                                                    
                                                    <a class="btn btn-default" 
                                                        href="<?php echo $next_pg_url; ?>">
                                                        Next <i class="fa fa-arrow-right"></i>
                                                    </a>
                                                    <?php
                                                        //var_dump(url()->current());
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        @foreach ($customers as $customer)
                                        <div class="card single-contractor-loop-card">
                                            <div class="card-heading card-heading-2">
                                                Customer Name: 
                                                <h4 class="card-title card-title-2">
                                                    <a href="{{url('/customers/')}}/{{$customer->ID}}">
                                                         <?php 
                                                            if ( 
                                                                   (strlen($customer->Cus_Company_Name) <= 0 )
                                                                ){
                                                                echo "<span class='empty-job-name'><i class='fa fa-meh-o'></i> Empty Customer Name</span>";
                                                            } else {
                                                                echo removeQuotes($customer->Cus_Company_Name);
                                                            }
                                                        ?>
                                                    </a>
                                                </h4> 
                                            </div>
                                            <div class="card-body card-body-2">
                                                <div class="row single-job-row-1">

                                                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                                        Customer ID: <b><a href="{{url('/customers/')}}/{{$customer->ID}}">{{ $customer->ID }}</a></b>
                                                        
                                                        <br/>
                                                        Requester Name:
                                                        <b>
                                                            <?php echo removeQuotes($customer->Cus_First_Name); ?>
                                                        </b>

                                                        <br/>
                                                        
                                                        Middle Name: 
                                                        <b>
                                                            <?php echo removeQuotes($customer->Cus_Middle_Name); ?>
                                                        </b>

                                                        <br/>
                                                        
                                                        LL Rep:
                                                        <b>
                                                            <?php echo removeQuotes($customer->Cus_Last_Name); ?>
                                                        </b>

                                                    </div>    
                                                </div>
                                            </div>
                                            <div class="card-footer border top">
                                                <ul class="list-unstyled list-inline text-right pdd-vertical-5">
                                                    
                                                    <li class="list-inline-item">
                                                        <a href="{{url('/customers/')}}/{{$customer->ID}}" class="btn btn-flat btn-view-cl"> 
                                                            <i class="fa fa-eye"></i> View
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a href="{{url('/customers/edit')}}/{{$customer->ID}}" class="btn btn-flat btn-edit-cl"> 
                                                            <i class="fa fa-pencil"></i> Edit
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <?php

                                                            if ( Auth::user()->is_admin == 1) {
                                                            echo Form::open(array('url'=>'customers/delete/'.$customer->ID, 'method'=>'PUT', 'id'=>'delete_customers_form_id'))
                                                        ?>
                                                            <input type="hidden" name="get_the_id" value="<?php echo $customer->ID; ?>">
                                                            <input 
                                                            type="submit" 
                                                            class="btn btn-flat btn-delete-cl"
                                                            id="delete_single_customer" value="DELETE">
                                                        <?php
                                                            }
                                                        ?>
                                                        {!! Form::close() !!}
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>                                       
                                        

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
                                                    $main_url = url('/customers/s?q=') . $query . "&pg=";
                                                    $prev_pg_url = $main_url . $get_previous_page_number;
                                                    $next_pg_url = $main_url . $get_next_page_number;
                                                ?>
                                                <div class="flt1a">
                                                    <a class="btn btn-default" href="<?php echo $prev_pg_url; ?>"> <i class="fa fa-arrow-left"></i> Previous</a>
                                                    
                                                    Page {{$get_current_page_number}} | {{$get_no_of_pages_left}} Page(s) Left
                                                    
                                                    <a class="btn btn-default" 
                                                        href="<?php echo $next_pg_url; ?>">
                                                        Next <i class="fa fa-arrow-right"></i>
                                                    </a>
                                                    <?php
                                                        //var_dump(url()->current());
                                                    ?>
                                                </div>
                                            </div>
                                        </div>

                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Content Wrapper END -->
@endsection
