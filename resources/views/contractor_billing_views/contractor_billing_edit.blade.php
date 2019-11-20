@extends('layouts.app')

@section('content')
            
    @include('sidebar')

    @include('header')

    <!-- Content Wrapper START -->
    <div class="main-content">
        <div class="container-fluid">
            @foreach ($contractor_billing_with_id as $contractor_billing)

            <?php 
                echo Form::open(array('url'=>'contractor-billings/edit/'.$contractor_billing->ID, 'method'=>'PUT', 'id'=>'edit_contractor_billings_form_id'));
                // echo Form::open(array('url'=>'contractor-billings/edit/'.$contractor_billing->ID, 'method'=>'PUT'));
            ?>
            
            <div class="contractor_billings_create_result_text"></div>
            
            <div class="page-title">
                <h1 class="crd-job-single">
                    <span class="crd-job-single-edit">You're editing a contractor billing:</span>
                    <br/>
                    <?php 
                        if ( 
                               (strlen($contractor_billing->ConBill_Job_Name) <= 0 )
                            ){
                            echo "<span class='empty-job-name'><i class='fa fa-meh-o'></i> Empty Contractor Billing Name</span>";
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
                    <a class="all_contractor_billings_page_url_a_cl" href="{{url('/contractor-billings/')}}"Contractor Billings</a>
                        >
                    <a class="edit_contractor_billings_page_url_a_cl" href="{{url('/contractor-billings/edit')}}/{{$contractor_billing->ID}}">Edit Contractor Billings</a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    
                    
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                            <div class="card">
                                <div class="card-heading border bottom">
                                    <h4 class="card-title crd-brdr">Contractor Billing Details <i class="fa fa-user-times"></i></h4>
                                    <div class="row crd-job-details">
                                        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                                        <!-- <div class="col-md-6 col-xs-12 col-sm-12 col-lg-6"> -->
                                            <ul class="job-details-ul">

                                                <input type="hidden" name="contractor_billing_id" 
                                                    value="<?php echo $contractor_billing->ID; ?>">   
                                                
                                                <?php inputFieldModelEditViewLi("Status", $contractor_billing->ConBill_Status, "contractor_billing"); ?>
                                                <?php inputFieldModelEditViewLi("Contractor Number", $contractor_billing->ConBill_Con_Number, "contractor_billing"); ?>
                                                <?php inputFieldModelEditViewLi("Contractor DBA", $contractor_billing->ConBill_Con_DBA, "contractor_billing"); ?>
                                                <?php inputFieldModelEditViewLi("Contractor First Name", $contractor_billing->ConBill_First_Name, "contractor_billing"); ?>
                                                <?php inputFieldModelEditViewLi("Contractor Last Name", $contractor_billing->ConBill_Last_Name, "contractor_billing"); ?>
                                                <?php inputFieldModelEditViewLi("Contractor Address Street 1", $contractor_billing->ConBill_Address_Street_1, "contractor_billing"); ?>
                                                <?php inputFieldModelEditViewLi("Contractor Address Street 2", $contractor_billing->ConBill_Address_Street_2, "contractor_billing"); ?>
                                                <?php inputFieldModelEditViewLi("Contractor City", $contractor_billing->ConBill_City, "contractor_billing"); ?>
                                                <?php inputFieldModelEditViewLi("Contractor State", $contractor_billing->ConBill_State, "contractor_billing"); ?>
                                                <?php inputFieldModelEditViewLi("Contractor Zip", $contractor_billing->ConBill_Zip, "contractor_billing"); ?>
                                                <?php inputFieldModelEditViewLi("Job ID", $contractor_billing->ConBill_Job_ID, "contractor_billing"); ?>
                                                <?php inputFieldModelEditViewLi("Job Name", $contractor_billing->ConBill_Job_Name, "contractor_billing"); ?>
                                                <?php inputFieldModelEditViewLi("Jobs Service Name", $contractor_billing->ConBill_Jobs_Service_Name, "contractor_billing"); ?>
                                                <?php inputFieldModelEditViewLi("Jobs Service Name Rate", $contractor_billing->ConBill_Jobs_Service_Name_Rate, "contractor_billing"); ?>
                                                <?php inputFieldModelEditViewLi("Customer Number", $contractor_billing->ConBill_Jobs_Customer_Number, "contractor_billing"); ?>
                                                <?php inputFieldModelEditViewLi("Customer Company", $contractor_billing->ConBill_Jobs_Customer_Company, "contractor_billing"); ?>
                                                <?php inputFieldModelEditViewLi("Assignment Location", $contractor_billing->ConBill_Jobs_Assignment_Location, "contractor_billing"); ?>
                                                <?php dateInputFieldModelEditViewLi("Actual Start Time", $contractor_billing->ConBill_Job_Actual_Start_Time, "contractor_billing"); ?>
                                                <?php dateInputFieldModelEditViewLi("Actual Finish Time", $contractor_billing->ConBill_Job_Actual_Finish_Time, "contractor_billing"); ?>
                                                <?php inputFieldModelEditViewLi("Total Billing Time", $contractor_billing->ConBill_Job_Total_Billing_Time, "contractor_billing"); ?>
                                                <?php inputFieldModelEditViewLi("Billing Service Name", $contractor_billing->ConBill_Con_Billing_Service_Name, "contractor_billing"); ?>
                                            </ul>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>       
                        </div>
                        <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                            <div class="card">
                                <div class="card-heading border bottom">
                                    <h4 class="card-title crd-brdr">Contractor Billing Details 2 <i class="fa fa-user-times"></i></h4>
                                    <div class="row crd-job-details">
                                        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                                            <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                                                <ul class="job-details-ul">
                                                   <?php inputFieldModelEditViewLi("Billing Rate", $contractor_billing->ConBill_Con_Billing_Rate, "contractor_billing"); ?>
                                                    <?php inputFieldModelEditViewLi("Billing Service Name Total", $contractor_billing->ConBill_Con_Billing_Service_Name_Total, "contractor_billing"); ?>
                                                    <?php inputFieldModelEditViewLi("LEP Name", $contractor_billing->ConBill_Job_LEP_Name, "contractor_billing"); ?>
                                                    <?php inputFieldModelEditViewLi("Special Request", $contractor_billing->ConBill_Job_Special_Request, "contractor_billing"); ?>
                                                    <?php inputFieldModelEditViewLi("Special Request Fee", $contractor_billing->ConBill_Job_Special_request_Fee, "contractor_billing"); ?>
                                                    <?php inputFieldModelEditViewLi("No Show Fee", $contractor_billing->ConBill_Job_No_Show_Fee, "contractor_billing"); ?>
                                                    <?php inputFieldModelEditViewLi("Cancellation Fee", $contractor_billing->ConBill_Job_Cancellation_Fee, "contractor_billing"); ?>
                                                    <?php inputFieldModelEditViewLi("Mileage", $contractor_billing->ConBill_Job_Mileage, "contractor_billing"); ?>
                                                    <?php inputFieldModelEditViewLi("Mileage Rate", $contractor_billing->ConBill_Job_Mileage_Rate, "contractor_billing"); ?>
                                                    <?php inputFieldModelEditViewLi("Contractor Mileage Rate", $contractor_billing->ConBill_Job_Con_Mileage_Rate, "contractor_billing"); ?>
                                                    <?php inputFieldModelEditViewLi("Contractor Mileage Rate Fee", $contractor_billing->ConBill_Job_Con_Mileage_Rate_Fee, "contractor_billing"); ?>
                                                    <?php inputFieldModelEditViewLi("Parking Fees", $contractor_billing->ConBill_Job_Parking_Fees, "contractor_billing"); ?>
                                                    <?php inputFieldModelEditViewLi("Travel Time", $contractor_billing->ConBill_Job_Travel_Time, "contractor_billing"); ?>
                                                    <?php inputFieldModelEditViewLi("Travel Time Rate", $contractor_billing->ConBill_Job_Travel_Time_Rate, "contractor_billing"); ?>
                                                    <?php inputFieldModelEditViewLi("Contractor Travel Time Rate", $contractor_billing->ConBill_Job_Con_Travel_Time_Rate, "contractor_billing"); ?>
                                                    <?php inputFieldModelEditViewLi("Contractor Travel Time Rate Fee", $contractor_billing->ConBill_job_Con_Travel_Time_Rate_Fee, "contractor_billing"); ?>
                                                    <?php inputFieldModelEditViewLi("Post Outcome", $contractor_billing->ConBill_Job_Post_Outcome, "contractor_billing"); ?>
                                                    <?php inputFieldModelEditViewLi("InvoiceTotal", $contractor_billing->ConBill_Job_InvoiceTotal, "contractor_billing"); ?>
                                                    <?php inputFieldModelEditViewLi("BillTotal", $contractor_billing->ConBill_Job_BillTotal, "contractor_billing"); ?>
                                                    <?php inputFieldModelEditViewLi("Notes", $contractor_billing->ConBill_Notes, "contractor_billing"); ?>
                                                    <?php inputFieldModelEditViewLi("Attachments", $contractor_billing->ConBill_Attachments, "contractor_billing"); ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            
            <div class="contractor_billings_edit_result_text"></div>

            <div class="edit-job-submit-cl">
                {!! Form::submit('Save Changes', ['class' => 'btn btn-success btn-edit-save', 'id'=>'edit_contractor_billing_id']) !!}
            </div>

            
            {!! Form::close() !!}

            <div class="row breadcrumbs-2">
                <?php
                    $next_contractor_billing = $contractor_billing->ID + 1;
                    $previous_contractor_billing = $contractor_billing->ID - 1;
                ?>
                <div class="col-md-6 breadcrumbs-2-prv">
                    <?php
                        if ( $contractor_billing->ID == 1 ) {
                            //do nothing
                        } else {
                            //display it
                    ?>
                            <a href="{{url('/contractor-billings/')}}/{{$previous_contractor_billing}}">
                                <i class="fa fa-arrow-left"></i>Previous Contractor Billing
                            </a>
                    <?php
                        }
                    ?>
                </div>
                <div class="col-md-6 breadcrumbs-2-nxt">
                    <a href="{{url('/contractor-billings/')}}/{{$next_contractor_billing}}">
                        Next Contractor Billing <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            @endforeach
            
        </div>
    </div>
    <!-- Content Wrapper END -->

@endsection