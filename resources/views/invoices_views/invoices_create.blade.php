@extends('layouts.app')

@section('content')
            
    @include('sidebar')

    @include('header')

    <!-- Content Wrapper START -->
    <div class="main-content">
        <div class="container-fluid">
            
            <?php 
            // echo Form::open(array('url'=>'invoices/create/', 'method'=>'PUT', 'files'=>true));
            echo Form::open(array('url'=>'invoices/create/', 'method'=>'PUT', 'file'=>true, 'id'=>'create_invoices_form_id'));
            ?>
            
            <div class="invoices_create_result_text"></div>
            
            <div class="page-title">
                <h1 class="crd-job-single">
                    <span class="crd-job-single-edit">You're creating a new invoice entry:</span>
                </h1>

                <div class="breadcrumbs">
                    <div class="fa fa-hand-o-right"></div> 
                    You are here: 
                    <a href="{{url('/')}}">Home </a>
                        >
                    <a href="{{url('/invoices/')}}">All Invoices</a>
                        >
                    <a class="create_invoices_page_url_a_cl" href="{{url('/invoices/create')}}">Create New Invoice</a>
                    <a class="all_invoices_page_url_a_cl" href="{{url('/invoices/')}}">Create New Invoice</a>
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
                                                <?php returnInputFieldForCreateViewLi("Invoice Status", "invoices"); ?>
                                                <?php returnInputFieldForCreateViewLi("Invoice Jobs Number", "invoices"); ?>
                                                <?php returnInputFieldForCreateViewLi("Invoice Jobs Name", "invoices"); ?>
                                                <?php returnInputFieldForCreateViewLi("Invoice Jobs Provider Name", "invoices"); ?>
                                                <?php returnInputFieldForCreateViewLi("Invoice Jobs Service Address", "invoices"); ?>
                                                <?php returnInputFieldForCreateViewLi("Invoice Jobs PO Number", "invoices"); ?>
                                                <?php returnInputFieldForCreateViewLi("Invoice Job Cus Number", "invoices"); ?>
                                                <?php returnInputFieldForCreateViewLi("Invoice Cus Company Name", "invoices"); ?>
                                                <?php returnInputFieldForCreateViewLi("Invoice Cus Billing Contact Name First", "invoices"); ?>
                                                <?php returnInputFieldForCreateViewLi("Invoice Cus Billing Contact Name last", "invoices"); ?>
                                                <?php returnInputFieldForCreateViewLi("Invoice Cus Billing Company Street 1", "invoices"); ?>
                                                <?php returnInputFieldForCreateViewLi("Invoice Cus Billing Company Street 2", "invoices"); ?>
                                                <?php returnInputFieldForCreateViewLi("Invoice Cus Billing City", "invoices"); ?>
                                                <?php returnInputFieldForCreateViewLi("Invoice Cus Billing State", "invoices"); ?>
                                                <?php returnInputFieldForCreateViewLi("Invoice Cus Billing Zip", "invoices"); ?>
                                                <?php returnInputFieldForCreateViewLi("Invoice Cus Billing Term", "invoices"); ?>
                                                <?php returnInputFieldForCreateViewLi("Invoice Cus Billing E-mail", "invoices"); ?>
                                                <?php returnInputFieldForCreateViewLi("Invoice Return Company", "invoices"); ?>
                                                <?php returnInputFieldForCreateViewLi("Invoice Return Contact Name", "invoices"); ?>
                                                <?php returnInputFieldForCreateViewLi("Invoice Return Street 1", "invoices"); ?>
                                                <?php returnInputFieldForCreateViewLi("Invoice return Street 2", "invoices"); ?>
                                                <?php returnInputFieldForCreateViewLi("Invoice Return City", "invoices"); ?>
                                                <?php returnInputFieldForCreateViewLi("Invoice Return State", "invoices"); ?>
                                                <?php returnInputFieldForCreateViewLi("Invoice Return Zip", "invoices"); ?>
                                                <?php returnInputFieldForCreateViewLi("Invoice Jobs Contractor ID", "invoices"); ?>
                                                <?php returnInputFieldForCreateViewLi("Invoice Jobs Contractor First Name", "invoices"); ?>
                                                <?php returnInputFieldForCreateViewLi("Invoice Jobs Contractors Last Name", "invoices"); ?>
                                                <?php returnInputFieldForCreateViewLi("Invoice Jobs Service Name", "invoices"); ?>
                                                <li>
                                                    <h4 class="card-title crd-brdr">
                                                        File Upload
                                                    </h4>

                                                    <div class="crd-job-details">
                                                        File Upload:
                                                        <input type="file" name="invoice_create_file_upload[]" class="form-control" id="Input_Attachments_id" multiple>
                                                        <br/>
                                                    </div>
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
                                                   <?php returnInputFieldForCreateViewLi("Invoice Jobs Sevice Name Rate", "invoices"); ?>
                                                    <?php returnInputFieldForCreateViewLi("Invoice Jobs Service Name Total", "invoices"); ?>
                                                    <?php returnInputFieldForCreateViewLi("Invoice Jobs Mileage", "invoices"); ?>
                                                    <?php returnInputFieldForCreateViewLi("Invoice Jobs Mileage Rate", "invoices"); ?>
                                                    <?php returnInputFieldForCreateViewLi("Invoice Jobs Mileage Fee", "invoices"); ?>
                                                    <?php returnInputFieldForCreateViewLi("Invoice Jobs Parking Fees", "invoices"); ?>
                                                    <?php returnInputFieldForCreateViewLi("Invoice Jobs Travel Time", "invoices"); ?>
                                                    <?php returnInputFieldForCreateViewLi("Invoice Jobs Travel Time Rate", "invoices"); ?>
                                                    <?php returnInputFieldForCreateViewLi("Invoice Jobs Travel Time Fee", "invoices"); ?>
                                                    <?php returnInputFieldForCreateViewLi("Invoice Jobs LEP Name", "invoices"); ?>
                                                    <?php returnInputFieldForCreateViewLi("Invoice Jobs Special Request", "invoices"); ?>
                                                    <?php returnInputFieldForCreateViewLi("Invoice Jobs Special Request Total", "invoices"); ?>
                                                    <?php returnInputFieldForCreateViewLi("Invoice Jobs Post Outcome", "invoices"); ?>
                                                    <?php returnInputFieldForCreateViewLi("Invoice Jobs Post Outcome Fee", "invoices"); ?>
                                                    
                                                    <?php 
                                                        echo "
                                                        <li>
                                                        <label for='Invoice_Jobs_Scheduled_Appointment_Time_id'>Invoice Jobs Scheduled Appointment Time</label>
                                                        <input type='text' name='Invoice_Jobs_Scheduled_Appointment_Time' 
                                                            value='0000-00-00 00:00:00' class='form-control' id='Invoice_Jobs_Scheduled_Appointment_Time_id' /> 
                                                        </li>
                                                        ";
                                                    ?>

                                                    <?php returnInputFieldForCreateViewLi("Invoice Billing Time", "invoices"); ?>
                                                    <?php returnInputFieldForCreateViewLi("Invoice Line Item 1 Note", "invoices"); ?>
                                                    <?php returnInputFieldForCreateViewLi("Invoice Line Item 1", "invoices"); ?>
                                                    <?php returnInputFieldForCreateViewLi("Invoice Line Item 2 Note", "invoices"); ?>
                                                    <?php returnInputFieldForCreateViewLi("Invoice Line Item 2", "invoices"); ?>
                                                    <?php returnInputFieldForCreateViewLi("Invoice Line Item 3 Note", "invoices"); ?>
                                                    <?php returnInputFieldForCreateViewLi("Invoice Line Item 3", "invoices"); ?>
                                                    <?php returnInputFieldForCreateViewLi("Invoice Total", "invoices"); ?>
                                                    <?php returnInputFieldForCreateViewLi("Invoice Notes", "invoices"); ?>
                                                    <?php returnInputFieldForCreateViewLi("Invoice Attachments", "invoices"); ?>
                                                    
                                                    <?php 
                                                        echo "
                                                        <li>
                                                        <label for='Invoice_Due_Date_id'>Invoice Due Date</label>
                                                        <input type='text' name='Invoice_Due_Date' 
                                                            value='0000-00-00 00:00:00' class='form-control' id='Invoice_Due_Date_id' /> 
                                                        </li>
                                                        ";
                                                    ?>

                                                    <?php returnInputFieldForCreateViewLi("Invoice Jobs Request FirstName", "invoices"); ?>
                                                    <?php returnInputFieldForCreateViewLi("Invoice Jobs Request LastName", "invoices"); ?>
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

            <div class="invoices_create_result_text"></div>

            <div class="edit-job-submit-cl">
                {!! Form::submit('Create Invoice', ['class' => 'btn btn-success btn-edit-save', 'id'=>'create_invoice_id']) !!}
            </div>

            
            {!! Form::close() !!}
            
        </div>
    </div>
    <!-- Content Wrapper END -->

@endsection