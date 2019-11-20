@extends('layouts.app')

@section('content')
            
    @include('sidebar')

    @include('header')

    <!-- Content Wrapper START -->
    <div class="main-content">
        <div class="container-fluid">
        
            <?php
                // if the array returns no value
                if ( count($contractor_billings) <= 0 ){
            ?>                    
                <div class='page-title'>
                    <h1 class='crd-job-single'>
                        No Contractor Billing To Display
                    </h1>
                    <h3 style="text-align: center;">
                        <a href="{{url('/')}}">Return Home</a>    
                    </h3>                            
                </div>
            <?php
                }
            ?>

            @foreach ($contractor_billings as $contractor_billing)
        
            
            <div class="page-title">

                <h1 class="crd-job-single">
                    <?php 
                        if ( 
                               (strlen($contractor_billing->ConBill_Job_Name) <= 0 )
                            ){
                            echo "<span class='empty-job-name'><i class='fa fa-meh-o'></i> Empty Job Name</span>";
                        } else {
                            echo removeQuotes($contractor_billing->ConBill_Job_Name);
                        }
                    ?>
                </h1>

                <div class="breadcrumbs">
                    <div class="fa fa-hand-o-right"></div> 
                    You are here: 
                    <a href="{{url('/')}}">Home </a>
                        >
                    <a href="{{url('/contractor-billings/')}}">All Contractor Billings</a>
                        >
                    <a href="{{url('/contractor-billings/')}}/{{$contractor_billing->ID}}">Viewing Single Contractor Billing</a>
                </div>

            </div>

            <div class="row">
                <div class="col-md-3 card sidebar-card">
                    @include('contractor_billing_views/contractor_billing_sidebar')
                </div>
                <div class="col-md-9">
                    <!-- start displaying invoice details here -->
                    
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                            <div class="card">
                                <div class="card-heading border bottom">
                                    <h4 class="card-title crd-brdr">Contractor Billing Details 1 <i class="fa fa-user-times"></i></h4>
                                    <div class="row crd-job-details">
                                        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                                        <!-- <div class="col-md-6 col-xs-12 col-sm-12 col-lg-6"> -->
                                            <ul class="job-details-ul">
                                                <?php returnTextForModelSingleView("Status", $contractor_billing->ConBill_Status); ?>
                                                <?php returnTextForModelSingleView("Contractor Number", $contractor_billing->ConBill_Con_Number); ?>
                                                <?php returnTextForModelSingleView("Contractor DBA", $contractor_billing->ConBill_Con_DBA); ?>
                                                <?php returnTextForModelSingleView("Contractor First Name", $contractor_billing->ConBill_First_Name); ?>
                                                <?php returnTextForModelSingleView("Contractor Last Name", $contractor_billing->ConBill_Last_Name); ?>
                                                <?php returnTextForModelSingleView("Contractor Address Street 1", $contractor_billing->ConBill_Address_Street_1); ?>
                                                <?php returnTextForModelSingleView("Contractor Address Street 2", $contractor_billing->ConBill_Address_Street_2); ?>
                                                <?php returnTextForModelSingleView("Contractor City", $contractor_billing->ConBill_City); ?>
                                                <?php returnTextForModelSingleView("Contractor State", $contractor_billing->ConBill_State); ?>
                                                <?php returnTextForModelSingleView("Contractor Zip", $contractor_billing->ConBill_Zip); ?>
                                                <?php returnTextForModelSingleView("Job ID", $contractor_billing->ConBill_Job_ID); ?>
                                                <?php returnTextForModelSingleView("Job Name", $contractor_billing->ConBill_Job_Name); ?>
                                                <?php returnTextForModelSingleView("Jobs Service Name", $contractor_billing->ConBill_Jobs_Service_Name); ?>
                                                <?php returnTextForModelSingleView("Jobs Service Name Rate", $contractor_billing->ConBill_Jobs_Service_Name_Rate); ?>
                                                <?php returnTextForModelSingleView("Customer Number", $contractor_billing->ConBill_Jobs_Customer_Number); ?>
                                                <?php returnTextForModelSingleView("Customer Company", $contractor_billing->ConBill_Jobs_Customer_Company); ?>
                                                <?php returnTextForModelSingleView("Assignment Location", $contractor_billing->ConBill_Jobs_Assignment_Location); ?>
                                                <?php returnTextForModelSingleView("Actual Start Time", $contractor_billing->ConBill_Job_Actual_Start_Time); ?>
                                                <?php returnTextForModelSingleView("Actual Finish Time", $contractor_billing->ConBill_Job_Actual_Finish_Time); ?>
                                                <?php returnTextForModelSingleView("Total Billing Time", $contractor_billing->ConBill_Job_Total_Billing_Time); ?>
                                                <?php returnTextForModelSingleView("Billing Service Name", $contractor_billing->ConBill_Con_Billing_Service_Name); ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>       
                        </div>
                        <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                            <div class="card">
                                <div class="card-heading border bottom">
                                    <h4 class="card-title crd-brdr">Contractor Billings Details 2 <i class="fa fa-user-times"></i></h4>
                                    <div class="row crd-job-details">
                                        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                                            <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                                                <ul class="job-details-ul">
                                                    <?php returnTextForModelSingleView("Billing Rate", $contractor_billing->ConBill_Con_Billing_Rate); ?>
                                                    <?php returnTextForModelSingleView("Billing Service Name Total", $contractor_billing->ConBill_Con_Billing_Service_Name_Total); ?>
                                                    <?php returnTextForModelSingleView("LEP Name", $contractor_billing->ConBill_Job_LEP_Name); ?>
                                                    <?php returnTextForModelSingleView("Special Request", $contractor_billing->ConBill_Job_Special_Request); ?>
                                                    <?php returnTextForModelSingleView("Special Request Fee", $contractor_billing->ConBill_Job_Special_request_Fee); ?>
                                                    <?php returnTextForModelSingleView("No Show Fee", $contractor_billing->ConBill_Job_No_Show_Fee); ?>
                                                    <?php returnTextForModelSingleView("Cancellation Fee", $contractor_billing->ConBill_Job_Cancellation_Fee); ?>
                                                    <?php returnTextForModelSingleView("Mileage", $contractor_billing->ConBill_Job_Mileage); ?>
                                                    <?php returnTextForModelSingleView("Mileage Rate", $contractor_billing->ConBill_Job_Mileage_Rate); ?>
                                                    <?php returnTextForModelSingleView("Contractor Mileage Rate", $contractor_billing->ConBill_Job_Con_Mileage_Rate); ?>
                                                    <?php returnTextForModelSingleView("Contractor Mileage Rate Fee", $contractor_billing->ConBill_Job_Con_Mileage_Rate_Fee); ?>
                                                    <?php returnTextForModelSingleView("Parking Fees", $contractor_billing->ConBill_Job_Parking_Fees); ?>
                                                    <?php returnTextForModelSingleView("Travel Time", $contractor_billing->ConBill_Job_Travel_Time); ?>
                                                    <?php returnTextForModelSingleView("Travel Time Rate", $contractor_billing->ConBill_Job_Travel_Time_Rate); ?>
                                                    <?php returnTextForModelSingleView("Contractor Travel Time Rate", $contractor_billing->ConBill_Job_Con_Travel_Time_Rate); ?>
                                                    <?php returnTextForModelSingleView("Contractor Travel Time Rate Fee", $contractor_billing->ConBill_job_Con_Travel_Time_Rate_Fee); ?>
                                                    <?php returnTextForModelSingleView("Post Outcome", $contractor_billing->ConBill_Job_Post_Outcome); ?>
                                                    <?php returnTextForModelSingleView("InvoiceTotal", $contractor_billing->ConBill_Job_InvoiceTotal); ?>
                                                    <?php returnTextForModelSingleView("BillTotal", $contractor_billing->ConBill_Job_BillTotal); ?>
                                                    <?php returnTextForModelSingleView("Notes", $contractor_billing->ConBill_Notes); ?>
                                                    <?php //returnTextForModelSingleView("Attachments", $contractor_billing->ConBill_Attachments); ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end displaying contractor-billings details here -->
                </div>
            </div>

            <div class="single-job-edit">
                <ul class="list-unstyled list-inline text-right pdd-vertical-5">
                    <li class="list-inline-item">
                        <a href="{{url('/contractor-billings/edit')}}/{{$contractor_billing->ID}}" class="btn btn-flat btn-edit-cl"> 
                            <i class="fa fa-pencil"></i> Click Here To Edit Contractor Billing
                        </a>
                    </li>
                </ul>
            </div>

            <div class="row breadcrumbs-2">
                <?php
                    $next_con = $contractor_billing->ID + 1;
                    $previous_con = $contractor_billing->ID - 1;
                ?>
                <div class="col-md-6 breadcrumbs-2-prv">
                    <?php
                        if ( $contractor_billing->ID == 1 ) {
                            //do nothing
                        } else {
                            //display it
                    ?>
                            <a href="{{url('/contractor-billings/')}}/{{$previous_con}}">
                                <i class="fa fa-arrow-left"></i> Previous Contractor Billing
                            </a>
                    <?php
                        }
                    ?>
                </div>
                <div class="col-md-6 breadcrumbs-2-nxt">
                    <a href="{{url('/contractor-billings/')}}/{{$next_con}}">
                        Next Contractor Billing <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            
            @endforeach

        </div>
    </div>
    <!-- Content Wrapper END -->

@endsection