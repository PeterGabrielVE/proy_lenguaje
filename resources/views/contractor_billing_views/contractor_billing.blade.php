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
                            
                            <h1 style="text-align: center;">All Contractor Billing</h1>

                            <div class="breadcrumbs">
                                <div class="fa fa-hand-o-right"></div> 
                                You are here: 
                                <a href="{{url('/')}}">Home </a>
                                    >
                                <a href="{{url('/contractor-billings/')}}">All Contractor Billing</a>
                            </div>

                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-filter">
                            
                                @include('contractor_billing_views/contractor_navigation_horizontal')
                                </div>
                            </div>
                        </div>

                        <div class="row">
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
                                                    <a class="btn btn-default" href="{{url('/contractor-billings/page/')}}{{$get_previous_page_number}}"> <i class="fa fa-arrow-left"></i> Previous</a>
                                                    <span>
                                                        Page
                                                            <select class="list-pagination-select-1">
                                                                <option value="">
                                                                    <a href="">{{$get_current_page_number}}</a>
                                                                </option>
                                                            </select>
                                                            
                                                        Of 
                                                            {{$get_no_of_pages_left}}
                                                    </span>
                                                    <a class="btn btn-default" 
                                                        href="{{url('/contractor-billings/page')}}/{{$get_next_page_number}}">
                                                        Next <i class="fa fa-arrow-right"></i>
                                                    </a>
                                                    <?php
                                                        //var_dump(url()->current());
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        @foreach ($contractor_billings as $contractor_billing)
                                        <div class="card single-contractor-loop-card">
                                            <div class="card-heading card-heading-2">
                                                Contractor Name: <h4 class="card-title card-title-2"><a href="{{url('/contractor-billings/')}}/{{$contractor_billing->ID}}">
                                                    <?php 
                                                        if ( 
                                                               (strlen($contractor_billing->ConBill_First_Name) <= 0 )
                                                            && (strlen($contractor_billing->ConBill_Last_Name) <= 0 )
                                                            ){
                                                            echo "<span class='empty-job-name'><i class='fa fa-meh-o'></i> Empty Contractor Name</span>";
                                                        } else {
                                                            echo removeQuotes($contractor_billing->ConBill_First_Name);
                                                            echo " ";
                                                            echo removeQuotes($contractor_billing->ConBill_Last_Name);

                                                        }
                                                    ?>
                                                </a></h4> 
                                            </div>
                                            <div class="card-body card-body-2">
                                                <div class="row single-job-row-1">

                                                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                                        Contractor Billing ID: <b><a href="{{url('/contractor-billings/')}}/{{$contractor_billing->ID}}">{{ $contractor_billing->ID }}</a></b>
                                                        <br/>    
                                                        <?php echo displayRowItem("Contractor Number", $contractor_billing->ConBill_Con_Number) ?>
                                                         <?php echo displayRowItem("Contractor DBA", $contractor_billing->ConBill_Con_DBA) ?>
                                                         <?php echo displayRowItem("Contractor First Name", $contractor_billing->ConBill_First_Name) ?>
                                                         <?php echo displayRowItem("Contractor Last Name", $contractor_billing->ConBill_Last_Name) ?>
                                                         <?php echo displayRowItem("Job ID", $contractor_billing->ConBill_Job_ID) ?>
                                                         <?php echo displayRowItem("Job Name", $contractor_billing->ConBill_Job_Name) ?>
                                                         <?php echo displayRowItem("Jobs Service Name", $contractor_billing->ConBill_Jobs_Service_Name) ?>
                                                         <?php echo displayRowItem("Jobs Service Name Rate", $contractor_billing->ConBill_Jobs_Service_Name_Rate) ?>
                                                         <?php echo displayRowItem("Customer Number", $contractor_billing->ConBill_Jobs_Customer_Number) ?>
                                                         <?php echo displayRowItem("Customer Company", $contractor_billing->ConBill_Jobs_Customer_Company) ?>
                                                         <?php echo displayRowItem("Assignment Location", $contractor_billing->ConBill_Jobs_Assignment_Location) ?>
                                                    </div>    
                                                </div>
                                            </div>
                                            <div class="card-footer border top">
                                                <ul class="list-unstyled list-inline text-right pdd-vertical-5">
                                                    
                                                    <li class="list-inline-item">
                                                        <a href="{{url('/contractor-billings/')}}/{{$contractor_billing->ID}}" class="btn btn-flat btn-view-cl"> 
                                                            <i class="fa fa-eye"></i> View
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a href="{{url('/contractor-billings/edit')}}/{{$contractor_billing->ID}}" class="btn btn-flat btn-edit-cl"> 
                                                            <i class="fa fa-pencil"></i> Edit
                                                        </a>
                                                    </li>
                                                    <?php
                                                        if ( Auth::user()->is_admin == 1) {
                                                    ?>
                                                    <li class="list-inline-item">
                                                        <?php
                                                            echo Form::open(array('url'=>'contractor-billings/delete/'.$contractor_billing->ID, 'method'=>'PUT', 'id'=>'delete_contractor_billing_form_id'))
                                                        ?>
                                                            <input type="hidden" name="get_the_id" value="<?php echo $contractor_billing->ID; ?>">
                                                            <input 
                                                            type="submit" 
                                                            class="btn btn-flat btn-delete-cl"
                                                            id="delete_single_contractor_billing" value="DELETE">
                                                        {!! Form::close() !!}
                                                    </li>
                                                    <?php
                                                        }
                                                    ?>
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
                                                <div class="flt1a">
                                                    <a class="btn btn-default" href="{{url('/contractor-billings/page/')}}{{$get_previous_page_number}}"> <i class="fa fa-arrow-left"></i> Previous</a>
                                                    <span>
                                                        Page
                                                            <select class="list-pagination-select-1">
                                                                <option value="">
                                                                    <a href="">{{$get_current_page_number}}</a>
                                                                </option>
                                                            </select>
                                                            
                                                        Of 
                                                            {{$get_no_of_pages_left}}
                                                    </span>
                                                    <a class="btn btn-default" 
                                                        href="{{url('/contractor-billings/page')}}/{{$get_next_page_number}}">
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
