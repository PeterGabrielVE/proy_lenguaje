@extends('layouts.app')

@section('content')
            
    @include('sidebar')

    @include('header')

    <!-- Content Wrapper START -->
    <div class="main-content">
        <div class="container-fluid">
        
            <?php
                // if the array returns no value
                if ( count($invoices) <= 0 ){
            ?>                    
                <div class='page-title'>
                    <h1 class='crd-job-single'>
                        No Invoice To Display
                    </h1>
                    <h3 style="text-align: center;">
                        <a href="{{url('/')}}">Return Home</a>    
                    </h3>                            
                </div>
            <?php
                }
            ?>

            @foreach ($invoices as $invoice)
        
            
            <div class="page-title">

                <h1 class="crd-job-single">
                    <?php 
                        if ( 
                               (strlen($invoice->Invoice_Jobs_Name) <= 0 )
                            ){
                            echo "<span class='empty-job-name'><i class='fa fa-meh-o'></i> Empty Invoice Name</span>";
                        } else {
                            echo removeQuotes($invoice->Invoice_Jobs_Name);
                        }
                    ?>
                </h1>

                <div class="breadcrumbs">
                    <div class="fa fa-hand-o-right"></div> 
                    You are here: 
                    <a href="{{url('/')}}">Home </a>
                        >
                    <a href="{{url('/invoices/')}}">All Invoices</a>
                        >
                    <a href="{{url('/invoice/')}}/{{$invoice->ID}}">Viewing Single Invoice</a>
                </div>

            </div>

            <div class="row">
                <div class="col-md-3 card sidebar-card">
                    @include('invoices_views/invoices_sidebar')
                </div>
                <div class="col-md-9">
                    <!-- start displaying invoice details here -->
                    
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                            <div class="card">
                                <div class="card-heading border bottom">
                                    <h4 class="card-title crd-brdr">Invoice Details 1<i class="fa fa-user-times"></i></h4>
                                    <div class="row crd-job-details">
                                        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                                        <!-- <div class="col-md-6 col-xs-12 col-sm-12 col-lg-6"> -->
                                            <ul class="job-details-ul">
                                                <?php returnTextForModelSingleView("Invoice Status", $invoice->Invoice_Status); ?>
                                                <?php 
                                                    echo 
                                                    "Invoice Job Number: 
                                                    <b>
                                                    <a href='". url('/jobs/')."/".$invoice->Invoice_Jobs_Number."'>". $invoice->Invoice_Jobs_Number . "</a></b> <br/>";
                                                ?>
                                                <?php returnTextForModelSingleView("Invoice Jobs Name", $invoice->Invoice_Jobs_Name); ?>
                                                <?php returnTextForModelSingleView("Invoice Jobs Provider Name", $invoice->Invoice_Jobs_Provider_Name); ?>
                                                <?php returnTextForModelSingleView("Invoice Jobs Service Address", $invoice->Invoice_Jobs_Service_Address); ?>
                                                <?php returnTextForModelSingleView("Invoice Jobs PO Number", $invoice->Invoice_Jobs_PO_Number); ?>
                                                <?php returnTextForModelSingleView("Invoice Job Customer Number", $invoice->Invoice_Job_Cus_Number); ?>
                                                <?php returnTextForModelSingleView("Invoice Customer Company Name", $invoice->Invoice_Cus_Company_Name); ?>
                                                <?php returnTextForModelSingleView("Invoice Customer Billing Contact Name First", $invoice->Invoice_Cus_Billing_Contact_Name_First); ?>
                                                <?php returnTextForModelSingleView("Invoice Customer Billing Contact Name last", $invoice->Invoice_Cus_Billing_Contact_Name_last); ?>
                                                <?php returnTextForModelSingleView("Invoice Customer Billing Company Street 1", $invoice->Invoice_Cus_Billing_Company_Street_1); ?>
                                                <?php returnTextForModelSingleView("Invoice Customer Billing Company Street 2", $invoice->Invoice_Cus_Billing_Company_Street_2); ?>
                                                <?php returnTextForModelSingleView("Invoice Customer Billing City", $invoice->Invoice_Cus_Billing_City); ?>
                                                <?php returnTextForModelSingleView("Invoice Customer Billing State", $invoice->Invoice_Cus_Billing_State); ?>
                                                <?php returnTextForModelSingleView("Invoice Customer Billing Zip", $invoice->Invoice_Cus_Billing_Zip); ?>
                                                <?php returnTextForModelSingleView("Invoice Customer Billing Term", $invoice->Invoice_Cus_Billing_Term); ?>
                                                <?php returnTextForModelSingleView("Invoice Customer Billing Email", $invoice->Invoice_Cus_Billing_E_mail); ?>
                                                <?php returnTextForModelSingleView("Invoice Return Company", $invoice->Invoice_Return_Company); ?>
                                                <?php returnTextForModelSingleView("Invoice Return Contact Name", $invoice->Invoice_Return_Contact_Name); ?>
                                                <?php returnTextForModelSingleView("Invoice Return Street 1", $invoice->Invoice_Return_Street_1); ?>
                                                <?php returnTextForModelSingleView("Invoice return Street 2", $invoice->Invoice_return_Street_2); ?>
                                                <?php returnTextForModelSingleView("Invoice Return City", $invoice->Invoice_Return_City); ?>
                                                <?php returnTextForModelSingleView("Invoice Return State", $invoice->Invoice_Return_State); ?>
                                                <?php returnTextForModelSingleView("Invoice Return Zip", $invoice->Invoice_Return_Zip); ?>
                                                <?php returnTextForModelSingleView("Invoice Jobs Contractor ID", $invoice->Invoice_Jobs_Contractor_ID); ?>
                                                <?php returnTextForModelSingleView("Invoice Jobs Contractor First Name", $invoice->Invoice_Jobs_Contractor_First_Name); ?>
                                                <?php returnTextForModelSingleView("Invoice Jobs Contractors Last Name", $invoice->Invoice_Jobs_Contractors_Last_Name); ?>
                                                <?php returnTextForModelSingleView("Invoice Jobs Service Name", $invoice->Invoice_Jobs_Service_Name); ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>       
                        </div>
                        <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                            <div class="card">
                                <div class="card-heading border bottom">
                                    <h4 class="card-title crd-brdr">Invoice Details 2 <i class="fa fa-user-times"></i></h4>
                                    <div class="row crd-job-details">
                                        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                                            <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                                                <ul class="job-details-ul">
                                                    <?php returnTextForModelSingleView("Invoice Jobs Sevice Name Rate", $invoice->Invoice_Jobs_Sevice_Name_Rate); ?>
                                                    <?php returnTextForModelSingleView("Invoice Jobs Service Name Total", $invoice->Invoice_Jobs_Service_Name_Total); ?>
                                                    <?php returnTextForModelSingleView("Invoice Jobs Mileage", $invoice->Invoice_Jobs_Mileage); ?>
                                                    <?php returnTextForModelSingleView("Invoice Jobs Mileage Rate", $invoice->Invoice_Jobs_Mileage_Rate); ?>
                                                    <?php returnTextForModelSingleView("Invoice Jobs Mileage Fee", $invoice->Invoice_Jobs_Mileage_Fee); ?>
                                                    <?php returnTextForModelSingleView("Invoice Jobs Parking Fees", $invoice->Invoice_Jobs_Parking_Fees); ?>
                                                    <?php returnTextForModelSingleView("Invoice Jobs Travel Time", $invoice->Invoice_Jobs_Travel_Time); ?>
                                                    <?php returnTextForModelSingleView("Invoice Jobs Travel Time Rate", $invoice->Invoice_Jobs_Travel_Time_Rate); ?>
                                                    <?php returnTextForModelSingleView("Invoice Jobs Travel Time Fee", $invoice->Invoice_Jobs_Travel_Time_Fee); ?>
                                                    <?php returnTextForModelSingleView("Invoice Jobs LEP Name", $invoice->Invoice_Jobs_LEP_Name); ?>
                                                    <?php returnTextForModelSingleView("Invoice Jobs Special Request", $invoice->Invoice_Jobs_Special_Request); ?>
                                                    <?php returnTextForModelSingleView("Invoice Jobs Special Request Total", $invoice->Invoice_Jobs_Special_Request_Total); ?>
                                                    <?php returnTextForModelSingleView("Invoice Jobs Post Outcome", $invoice->Invoice_Jobs_Post_Outcome); ?>
                                                    <?php returnTextForModelSingleView("Invoice Jobs Post Outcome Fee", $invoice->Invoice_Jobs_Post_Outcome_Fee); ?>
                                                    <?php returnTextForModelSingleView("Invoice Jobs Scheduled Appointment Time", $invoice->Invoice_Jobs_Scheduled_Appointment_Time); ?>
                                                    <?php returnTextForModelSingleView("Invoice Billing Time", $invoice->Invoice_Billing_Time); ?>
                                                    <?php returnTextForModelSingleView("Invoice Line Item 1 Note", $invoice->Invoice_Line_Item_1_Note); ?>
                                                    <?php returnTextForModelSingleView("Invoice Line Item 1", $invoice->Invoice_Line_Item_1); ?>
                                                    <?php returnTextForModelSingleView("Invoice Line Item 2 Note", $invoice->Invoice_Line_Item_2_Note); ?>
                                                    <?php returnTextForModelSingleView("Invoice Line Item 2", $invoice->Invoice_Line_Item_2); ?>
                                                    <?php returnTextForModelSingleView("Invoice Line Item 3 Note", $invoice->Invoice_Line_Item_3_Note); ?>
                                                    <?php returnTextForModelSingleView("Invoice Line Item 3", $invoice->Invoice_Line_Item_3); ?>
                                                    <?php returnTextForModelSingleView("Invoice Total", $invoice->Invoice_Total); ?>
                                                    <?php returnTextForModelSingleView("Invoice Notes", $invoice->Invoice_Notes); ?>
                                                    <?php returnTextForModelSingleView("Invoice Attachments", $invoice->Invoice_Attachments); ?>
                                                    <?php returnTextForModelSingleView("Invoice Due Date", $invoice->Invoice_Due_Date); ?>
                                                    <?php returnTextForModelSingleView("Invoice Jobs Request FirstName", $invoice->Invoice_Jobs_Request_FirstName); ?>
                                                    <?php returnTextForModelSingleView("Invoice Jobs Request LastName", $invoice->Invoice_Jobs_Request_LastName); ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                            <div class="card">
                                <div class="card-heading border bottom">
                                    <h4 class="card-title crd-brdr">Attachments<i class="fa fa-user-times"></i></h4>
                                    <br/>
                                    <?php 
                                        processEchoFiles2($invoice->attachments, false);
                                        
                                    ?>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                            <div class="card">
                                <div class="card-heading border bottom">
                                    <h4 class="card-title crd-brdr">Generate PDF <i class="fa fa-user-times"></i></h4>
                                    <div class="row crd-job-details">
                                        <a href="{{url('/invoices/pdf')}}">Click Here To View PDF</a>
                                    </div>
                                </div>
                            </div>
                        </div> -->


                    </div>
                    <!-- end displaying invoice details here -->
                </div>
            </div>

            <div class="single-job-edit">
                <ul class="list-unstyled list-inline text-right pdd-vertical-5">
                    <li class="list-inline-item">
                        <a href="{{url('/invoices/edit')}}/{{$invoice->ID}}" class="btn btn-flat btn-edit-cl"> 
                            <i class="fa fa-pencil"></i> Click Here To Edit Invoice
                        </a>
                    </li>
                </ul>
            </div>

            <div class="row breadcrumbs-2">
                <?php
                    $next_con = $invoice->ID + 1;
                    $previous_con = $invoice->ID - 1;
                ?>
                <div class="col-md-6 breadcrumbs-2-prv">
                    <?php
                        if ( $invoice->ID == 1 ) {
                            //do nothing
                        } else {
                            //display it
                    ?>
                            <a href="{{url('/invoices/')}}/{{$previous_con}}">
                                <i class="fa fa-arrow-left"></i> Previous Invoice
                            </a>
                    <?php
                        }
                    ?>
                </div>
                <div class="col-md-6 breadcrumbs-2-nxt">
                    <a href="{{url('/invoices/')}}/{{$next_con}}">
                        Next Invoice <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            
            @endforeach

        </div>
    </div>
    <!-- Content Wrapper END -->

@endsection