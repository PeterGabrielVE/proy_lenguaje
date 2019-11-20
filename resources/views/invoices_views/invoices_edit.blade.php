@extends('layouts.app')

@section('content')
            
    @include('sidebar')

    @include('header')

    <!-- Content Wrapper START -->
    <div class="main-content">
        <div class="container-fluid">
            @foreach ($invoices_with_id as $invoice)

            <?php 
                // echo Form::open(array('url'=>'invoices/edit/'.$invoice->ID, 'method'=>'PUT', 'files'=>true));
                echo Form::open(array('url'=>'invoices/edit/'.$invoice->ID, 'method'=>'PUT', 'files'=>true, 'id'=>'edit_invoices_form_id'));
            ?>
            
            <div class="invoices_create_result_text"></div>
            
            <div class="page-title">
                <h1 class="crd-job-single">
                    <span class="crd-job-single-edit">You're editing a invoice:</span>
                    <br/>
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
                    <a class="all_invoices_page_url_a_cl" href="{{url('/invoices/')}}">Invoices</a>
                        >
                    <a class="edit_invoices_page_url_a_cl" href="{{url('/invoices/edit')}}/{{$invoice->ID}}">Edit Invoice</a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <!-- start displaying invoice details here -->
                    
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                            <div class="card">
                                <div class="card-heading border bottom">
                                    <h4 class="card-title crd-brdr">Invoice Details <i class="fa fa-user-times"></i></h4>
                                    <div class="row crd-job-details">
                                        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                                        <!-- <div class="col-md-6 col-xs-12 col-sm-12 col-lg-6"> -->
                                            <ul class="job-details-ul">

                                                <input type="hidden" name="invoice_id" 
                                                    value="<?php echo $invoice->ID; ?>">   
                                                
                                                 <?php inputFieldModelEditViewLi("Invoice Status", $invoice->Invoice_Status, "invoice"); ?>
                                                <?php inputFieldModelEditViewLi("Invoice Jobs Number", $invoice->Invoice_Jobs_Number, "invoice"); ?>
                                                <?php inputFieldModelEditViewLi("Invoice Jobs Name", $invoice->Invoice_Jobs_Name, "invoice"); ?>
                                                <?php  inputFieldModelEditViewLi("Invoice Jobs Provider Name", $invoice->Invoice_Jobs_Provider_Name, "invoice");?>
                                                <?php inputFieldModelEditViewLi("Invoice Jobs Service Address", $invoice->Invoice_Jobs_Service_Address, "invoice"); ?>
                                                <?php inputFieldModelEditViewLi("Invoice Jobs PO Number", $invoice->Invoice_Jobs_PO_Number, "invoice"); ?>
                                                <?php inputFieldModelEditViewLi("Invoice Job Customer Number", $invoice->Invoice_Job_Cus_Number, "invoice"); ?>
                                                <?php inputFieldModelEditViewLi("Invoice Customer Company Name", $invoice->Invoice_Cus_Company_Name, "invoice"); ?>
                                                <?php inputFieldModelEditViewLi("Invoice Customer Billing Contact Name First", $invoice->Invoice_Cus_Billing_Contact_Name_First, "invoice"); ?>
                                                <?php inputFieldModelEditViewLi("Invoice Customer Billing Contact Name last", $invoice->Invoice_Cus_Billing_Contact_Name_last, "invoice"); ?>
                                                <?php inputFieldModelEditViewLi("Invoice Customer Billing Company Street 1", $invoice->Invoice_Cus_Billing_Company_Street_1, "invoice"); ?>
                                                <?php inputFieldModelEditViewLi("Invoice Customer Billing Company Street 2", $invoice->Invoice_Cus_Billing_Company_Street_2, "invoice"); ?>
                                                <?php inputFieldModelEditViewLi("Invoice Customer Billing City", $invoice->Invoice_Cus_Billing_City, "invoice"); ?>
                                                <?php inputFieldModelEditViewLi("Invoice Customer Billing State", $invoice->Invoice_Cus_Billing_State, "invoice"); ?>
                                                <?php inputFieldModelEditViewLi("Invoice Customer Billing Zip", $invoice->Invoice_Cus_Billing_Zip, "invoice"); ?>
                                                <?php inputFieldModelEditViewLi("Invoice Customer Billing Term", $invoice->Invoice_Cus_Billing_Term, "invoice"); ?>
                                                <?php inputFieldModelEditViewLi("Invoice Customer Billing Email", $invoice->Invoice_Cus_Billing_E_mail, "invoice"); ?>
                                                <?php inputFieldModelEditViewLi("Invoice Return Company", $invoice->Invoice_Return_Company, "invoice"); ?>
                                                <?php inputFieldModelEditViewLi("Invoice Return Contact Name", $invoice->Invoice_Return_Contact_Name, "invoice"); ?>
                                                <?php inputFieldModelEditViewLi("Invoice Return Street 1", $invoice->Invoice_Return_Street_1, "invoice"); ?>
                                                <?php inputFieldModelEditViewLi("Invoice return Street 2", $invoice->Invoice_return_Street_2, "invoice"); ?>
                                                <?php inputFieldModelEditViewLi("Invoice Return City", $invoice->Invoice_Return_City, "invoice"); ?>
                                                <?php inputFieldModelEditViewLi("Invoice Return State", $invoice->Invoice_Return_State, "invoice"); ?>
                                                <?php inputFieldModelEditViewLi("Invoice Return Zip", $invoice->Invoice_Return_Zip, "invoice"); ?>
                                                <?php inputFieldModelEditViewLi("Invoice Jobs Contractor ID", $invoice->Invoice_Jobs_Contractor_ID, "invoice"); ?>
                                                <?php inputFieldModelEditViewLi("Invoice Jobs Contractor First Name", $invoice->Invoice_Jobs_Contractor_First_Name, "invoice"); ?>
                                                <?php inputFieldModelEditViewLi("Invoice Jobs Contractors Last Name", $invoice->Invoice_Jobs_Contractors_Last_Name, "invoice"); ?>
                                                <?php inputFieldModelEditViewLi("Invoice Jobs Service Name", $invoice->Invoice_Jobs_Service_Name, "invoice"); ?>
                                                
                                                <li>
                                                    <?php 
                                                        processEchoFiles($invoice->attachments, true);
                                                    ?>
                                                    <br/>
                                                    File Upload:
                                                    <input type="file" name="invoice_edit_file[]" class="form-control" id="Input_Attachments_id" multiple>
                                                    <input type="hidden" name="edit_invoice_old_val" id="edit_invoice_old_val_id" value="<?php echo $invoice->attachments; ?>">
                                                    <br/>
                                                </li>    
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
                                                   <?php inputFieldModelEditViewLi("Invoice Jobs Sevice Name Rate", $invoice->Invoice_Jobs_Sevice_Name_Rate, "invoice"); ?>
                                                    <?php inputFieldModelEditViewLi("Invoice Jobs Service Name Total", $invoice->Invoice_Jobs_Service_Name_Total, "invoice"); ?>
                                                    <?php inputFieldModelEditViewLi("Invoice Jobs Mileage", $invoice->Invoice_Jobs_Mileage, "invoice"); ?>
                                                    <?php inputFieldModelEditViewLi("Invoice Jobs Mileage Rate", $invoice->Invoice_Jobs_Mileage_Rate, "invoice"); ?>
                                                    <?php inputFieldModelEditViewLi("Invoice Jobs Mileage Fee", $invoice->Invoice_Jobs_Mileage_Fee, "invoice"); ?>
                                                    <?php inputFieldModelEditViewLi("Invoice Jobs Parking Fees", $invoice->Invoice_Jobs_Parking_Fees, "invoice"); ?>
                                                    <?php inputFieldModelEditViewLi("Invoice Jobs Travel Time", $invoice->Invoice_Jobs_Travel_Time, "invoice"); ?>
                                                    <?php inputFieldModelEditViewLi("Invoice Jobs Travel Time Rate", $invoice->Invoice_Jobs_Travel_Time_Rate, "invoice"); ?>
                                                    <?php inputFieldModelEditViewLi("Invoice Jobs Travel Time Fee", $invoice->Invoice_Jobs_Travel_Time_Fee, "invoice"); ?>
                                                    <?php inputFieldModelEditViewLi("Invoice Jobs LEP Name", $invoice->Invoice_Jobs_LEP_Name, "invoice"); ?>
                                                    <?php inputFieldModelEditViewLi("Invoice Jobs Special Request", $invoice->Invoice_Jobs_Special_Request, "invoice"); ?>
                                                    <?php inputFieldModelEditViewLi("Invoice Jobs Special Request Total", $invoice->Invoice_Jobs_Special_Request_Total, "invoice"); ?>
                                                    <?php inputFieldModelEditViewLi("Invoice Jobs Post Outcome", $invoice->Invoice_Jobs_Post_Outcome, "invoice"); ?>
                                                    <?php inputFieldModelEditViewLi("Invoice Jobs Post Outcome Fee", $invoice->Invoice_Jobs_Post_Outcome_Fee, "invoice"); ?>
                                                    <?php dateInputFieldModelEditViewLi("Invoice Jobs Scheduled Appointment Time", $invoice->Invoice_Jobs_Scheduled_Appointment_Time, "invoice"); ?>
                                                    <?php inputFieldModelEditViewLi("Invoice Billing Time", $invoice->Invoice_Billing_Time, "invoice"); ?>
                                                    <div class="row crd-job-details">
                                                        <ul class="job-details-ul minwidth100">
                                                            <li class="backgrounded-li width100">
                                                                <?php textareaModelEditView("Invoice Line Item 1 Note", $invoice->Invoice_Line_Item_1_Note, "invoice"); ?>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <?php inputFieldModelEditViewLi("Invoice Line Item 1", $invoice->Invoice_Line_Item_1, "invoice"); ?>
                                                    
                                                    <div class="row crd-job-details">
                                                        <ul class="job-details-ul minwidth100">
                                                            <li class="backgrounded-li width100">
                                                                <?php textareaModelEditView("Invoice Line Item 2 Note", $invoice->Invoice_Line_Item_2_Note, "invoice"); ?>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                    <?php inputFieldModelEditViewLi("Invoice Line Item 2", $invoice->Invoice_Line_Item_2, "invoice"); ?>
                                                    
                                                    <div class="row crd-job-details">
                                                        <ul class="job-details-ul minwidth100">
                                                            <li class="backgrounded-li width100">
                                                                <?php textareaModelEditView("Invoice Line Item 3 Note", $invoice->Invoice_Line_Item_3_Note, "invoice"); ?>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                    <?php inputFieldModelEditViewLi("Invoice Line Item 3", $invoice->Invoice_Line_Item_3, "invoice"); ?>
                                                    <?php inputFieldModelEditViewLi("Invoice Total", $invoice->Invoice_Total, "invoice"); ?>

                                                    <div class="row crd-job-details">
                                                        <ul class="job-details-ul minwidth100">
                                                            <li class="backgrounded-li width100">
                                                                <?php textareaModelEditView("Invoice Notes", $invoice->Invoice_Notes, "invoice"); ?>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                    <?php inputFieldModelEditViewLi("Invoice Attachments", $invoice->Invoice_Attachments, "invoice"); ?>
                                                    <?php dateInputFieldModelEditViewLi("Invoice Due Date", $invoice->Invoice_Due_Date, "invoice"); ?>
                                                    <?php inputFieldModelEditViewLi("Invoice Jobs Request FirstName", $invoice->Invoice_Jobs_Request_FirstName, "invoice"); ?>
                                                    <?php inputFieldModelEditViewLi("Invoice Jobs Request LastName", $invoice->Invoice_Jobs_Request_LastName, "invoice"); ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end displaying invoice details here -->
                </div>
            </div>
            
            <div class="invoices_edit_result_text"></div>

            <div class="edit-job-submit-cl">
                {!! Form::submit('Save Changes', ['class' => 'btn btn-success btn-edit-save', 'id'=>'edit_invoice_id']) !!}
            </div>

            
            {!! Form::close() !!}

            <div class="row breadcrumbs-2">
                <?php
                    $next_invoice = $invoice->ID + 1;
                    $previous_invoice = $invoice->ID - 1;
                ?>
                <div class="col-md-6 breadcrumbs-2-prv">
                    <?php
                        if ( $invoice->ID == 1 ) {
                            //do nothing
                        } else {
                            //display it
                    ?>
                            <a href="{{url('/invoices/')}}/{{$previous_invoice}}">
                                <i class="fa fa-arrow-left"></i>Previous Invoice
                            </a>
                    <?php
                        }
                    ?>
                </div>
                <div class="col-md-6 breadcrumbs-2-nxt">
                    <a href="{{url('/invoices/')}}/{{$next_invoice}}">
                        Next Invoice <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            @endforeach
            
        </div>
    </div>
    <!-- Content Wrapper END -->

@endsection