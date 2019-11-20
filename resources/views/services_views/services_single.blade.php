@extends('layouts.app')

@section('content')
            
    @include('sidebar')

    @include('header')

    <!-- Content Wrapper START -->
    <div class="main-content">
        <div class="container-fluid">
        
            <?php
                // if the array returns no value
                if ( count($services) <= 0 ){
            ?>                    
                <div class='page-title'>
                    <h1 class='crd-job-single'>
                        No Service To Display
                    </h1>
                    <h3 style="text-align: center;">
                        <a href="{{url('/')}}">Return Home</a>    
                    </h3>                            
                </div>
            <?php
                }
            ?>

            @foreach ($services as $service)
        
            
            <div class="page-title">

                <h1 class="crd-job-single">
                    <?php 
                        if ( 
                               (strlen($service->Service_Name) <= 0 )
                            ){
                            echo "<span class='empty-job-name'><i class='fa fa-meh-o'></i> Empty Service Name</span>";
                        } else {
                            echo removeQuotes($service->Service_Name);
                        }
                    ?>
                </h1>

                <div class="breadcrumbs">
                    <div class="fa fa-hand-o-right"></div> 
                    You are here: 
                    <a href="{{url('/')}}">Home </a>
                        >
                    <a href="{{url('/services/')}}">All Services</a>
                        >
                    <a href="{{url('/service/')}}/{{$service->ID}}">Viewing Single Service</a>
                </div>

            </div>

            <div class="row">
                <div class="col-md-3 card sidebar-card">
                    @include('services_views/services_sidebar')
                </div>
                <div class="col-md-9">
                    <!-- start displaying service details here -->
                    
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                            <div class="card">
                                <div class="card-heading border bottom">
                                    <h4 class="card-title crd-brdr">Service Details 1<i class="fa fa-user-times"></i></h4>
                                    <div class="row crd-job-details">
                                        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                                        <!-- <div class="col-md-6 col-xs-12 col-sm-12 col-lg-6"> -->
                                            <ul class="job-details-ul">
                                                <?php returnTextForServiceSingleView("Service ID", $service->ID); ?>
                                                <?php returnTextForServiceSingleView("Service Name", $service->Service_Name); ?>
                                                <?php returnTextForServiceSingleView("Service State", $service->Service_State); ?>
                                            </ul>
                                            <ul class="job-details-ul">
                                                <li></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>       
                        </div>
                        <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                            <div class="card">
                                <div class="card-heading border bottom">
                                    <h4 class="card-title crd-brdr">Service Details 2 <i class="fa fa-user-times"></i></h4>
                                    <div class="row crd-job-details">
                                        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                                            <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                                                <ul class="job-details-ul">
                                                    <?php returnTextForServiceSingleView("Service Code", $service->Service_Code); ?>
                                                    <?php returnTextForServiceSingleView("Service Rate", $service->Service_Rate); ?>
                                                    <?php returnTextForServiceSingleView("Customer Name", $service->Service_Cus_Number); ?>

                                                    <li>
                                                        <div class="single_job_view_img_cl_title">Attachment</div>
                                                        <?php 
                                                            processEchoFiles2($service->attachments, false);
                                                        ?>    
                                                    </li>
                                                    

                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end displaying service details here -->
                </div>
            </div>

            <div class="single-job-edit">
                <ul class="list-unstyled list-inline text-right pdd-vertical-5">
                    <li class="list-inline-item">
                        <a href="{{url('/services/edit')}}/{{$service->ID}}" class="btn btn-flat btn-edit-cl"> 
                            <i class="fa fa-pencil"></i> Click Here To Edit Service
                        </a>
                    </li>
                </ul>
            </div>

            <div class="row breadcrumbs-2">
                <?php
                    $next_con = $service->ID + 1;
                    $previous_con = $service->ID - 1;
                ?>
                <div class="col-md-6 breadcrumbs-2-prv">
                    <?php
                        if ( $service->ID == 1 ) {
                            //do nothing
                        } else {
                            //display it
                    ?>
                            <a href="{{url('/services/')}}/{{$previous_con}}">
                                <i class="fa fa-arrow-left"></i> Previous Service
                            </a>
                    <?php
                        }
                    ?>
                </div>
                <div class="col-md-6 breadcrumbs-2-nxt">
                    <a href="{{url('/services/')}}/{{$next_con}}">
                        Next Service <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            
            @endforeach

        </div>
    </div>
    <!-- Content Wrapper END -->

@endsection