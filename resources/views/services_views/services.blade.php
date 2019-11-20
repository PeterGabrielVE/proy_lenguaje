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
                            
                            <h1 style="text-align: center;">All Services</h1>

                            <div class="breadcrumbs">
                                <div class="fa fa-hand-o-right"></div> 
                                You are here: 
                                <a href="{{url('/')}}">Home </a>
                                    >
                                <a href="{{url('/services/')}}">All Services</a>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-filter">
                                    @include('services_views/services_navigation_horizontal')
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
                                                    <a class="btn btn-default" href="{{url('/services/page/')}}{{$get_previous_page_number}}"> <i class="fa fa-arrow-left"></i> Previous</a>
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
                                                        href="{{url('/services/page')}}/{{$get_next_page_number}}">
                                                        Next <i class="fa fa-arrow-right"></i>
                                                    </a>
                                                    <?php
                                                        //var_dump(url()->current());
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        @foreach ($services as $service)
                                        <div class="card single-contractor-loop-card">
                                            <div class="card-heading card-heading-2">
                                                Service Name: 
                                                <h4 class="card-title card-title-2">
                                                    <a href="{{url('/services/')}}/{{$service->ID}}">
                                                        <?php 
                                                            if ( 
                                                                   (strlen($service->Service_Name) <= 0 )
                                                                ){
                                                                echo "<span class='empty-job-name'><i class='fa fa-meh-o'></i> Empty Service Name</span>";
                                                            } else {
                                                                echo removeQuotes($service->Service_Name);
                                                            }
                                                        ?>
                                                    </a>
                                                </h4> 
                                                


                                            </div>
                                            <div class="card-body card-body-2">
                                                <div class="row single-job-row-1">

                                                    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                                                        Service ID: <b><a href="{{url('/services/')}}/{{$service->ID}}">{{ $service->ID }}</a></b>
                                                        
                                                        <br/>
                                                        Service Name: 
                                                        <b>
                                                            <?php echo removeQuotes($service->Service_Name); ?>
                                                        </b>

                                                        <br/>
                                                        Service State: 
                                                        <b>
                                                            <?php echo removeQuotes($service->Service_State); ?>
                                                        </b>
                                                    </div>    
                                                    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                                                        Code: 
                                                        <b>
                                                            <?php echo removeQuotes($service->Service_Code); ?>
                                                        </b>

                                                        <br/>
                                                        Rate: 
                                                        <b>
                                                            <?php echo removeQuotes($service->Service_Rate); ?>
                                                        </b>

                                                        <br/>

                                                        Customer Name: 
                                                        <b>
                                                            <?php echo removeQuotes($service->Service_Cus_Number); ?>
                                                        </b>
                                                        
                                                        <br/>

                                                        Service Type: 
                                                        <b>
                                                            <?php echo removeQuotes($service->Service_Type); ?>
                                                        </b>
                                                    </div>    
                                                </div>
                                            </div>
                                            <div class="card-footer border top">
                                                <ul class="list-unstyled list-inline text-right pdd-vertical-5">
                                                    
                                                    <li class="list-inline-item">
                                                        <a href="{{url('/services/')}}/{{$service->ID}}" class="btn btn-flat btn-view-cl"> 
                                                            <i class="fa fa-eye"></i> View
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a href="{{url('/services/edit')}}/{{$service->ID}}" class="btn btn-flat btn-edit-cl"> 
                                                            <i class="fa fa-pencil"></i> Edit
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <?php
                                                            echo Form::open(array('url'=>'services/delete/'.$service->ID, 'method'=>'PUT', 'id'=>'delete_services_form_id'))
                                                        ?>
                                                            <input type="hidden" name="get_the_id" value="<?php echo $service->ID; ?>">
                                                            <input 
                                                            type="submit" 
                                                            class="btn btn-flat btn-delete-cl"
                                                            id="delete_single_service" value="DELETE">
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
                                                <div class="flt1a">
                                                    <a class="btn btn-default" href="{{url('/services/page/')}}{{$get_previous_page_number}}"> <i class="fa fa-arrow-left"></i> Previous</a>
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
                                                        href="{{url('/services/page')}}/{{$get_next_page_number}}">
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
