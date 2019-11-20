@extends('layouts.app')

@section('content')
            
    @include('sidebar')

    @include('header')

    <!-- Content Wrapper START -->
    <div class="main-content">
        <div class="container-fluid">
            
            <?php 
            echo Form::open(array('url'=>'contractor-billings/create/', 'method'=>'PUT', 'id'=>'create_contractor_billings_form_id'));
            //echo Form::open(array('url'=>'invoices/create/', 'method'=>'PUT'));
            ?>
            
            <div class="contractor_billing_create_result_text"></div>
            
            <div class="page-title">
                <h1 class="crd-job-single">
                    <span class="crd-job-single-edit">You're creating a new contractor billing entry:</span>
                </h1>

                <div class="breadcrumbs">
                    <div class="fa fa-hand-o-right"></div> 
                    You are here: 
                    <a href="{{url('/')}}">Home </a>
                        >
                    <a class="all_contractor_billings_page_url_a_cl" href="{{url('/contractor-billings/')}}">All Contractor Billing</a>
                        >
                    <a class="create_contractor_billings_page_url_a_cl" href="{{url('/contractor-billings/create')}}">Create New Contractor Billing</a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <!-- start displaying invoice details here -->
                    
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                            <div class="card">
                                <div class="card-heading border bottom">
                                    <h4 class="card-title crd-brdr">Contractor Billings Details <i class="fa fa-user-times"></i></h4>
                                    <div class="row crd-job-details">
                                        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                                        <!-- <div class="col-md-6 col-xs-12 col-sm-12 col-lg-6"> -->
                                            <ul class="job-details-ul">
                                                <?php returnInputFieldForCreateViewLi("Status", "contractor_billing"); ?>
                                                <?php returnInputFieldForCreateViewLi("Contractor Number", "contractor_billing"); ?>
                                                <?php returnInputFieldForCreateViewLi("Contractor DBA", "contractor_billing"); ?>
                                                <?php returnInputFieldForCreateViewLi("First Name", "contractor_billing"); ?>
                                                <?php returnInputFieldForCreateViewLi("Last Name", "contractor_billing"); ?>
                                                <?php returnInputFieldForCreateViewLi("Address Street 1", "contractor_billing"); ?>
                                                <?php returnInputFieldForCreateViewLi("Address Street 2", "contractor_billing"); ?>
                                                <?php returnInputFieldForCreateViewLi("City", "contractor_billing"); ?>
                                                <?php returnInputFieldForCreateViewLi("State", "contractor_billing"); ?>
                                                <?php returnInputFieldForCreateViewLi("Zip", "contractor_billing"); ?>
                                                <?php returnInputFieldForCreateViewLi("Job ID", "contractor_billing"); ?>
                                                <?php returnInputFieldForCreateViewLi("Job Name", "contractor_billing"); ?>
                                                <?php returnInputFieldForCreateViewLi("Jobs Service Name", "contractor_billing"); ?>
                                                <?php returnInputFieldForCreateViewLi("Jobs Service Name Rate", "contractor_billing"); ?>
                                                <?php returnInputFieldForCreateViewLi("Jobs Customer Number", "contractor_billing"); ?>
                                                <?php returnInputFieldForCreateViewLi("Jobs Customer Company", "contractor_billing"); ?>
                                                <?php returnInputFieldForCreateViewLi("Jobs Assignment Location", "contractor_billing"); ?>

                                                <?php 
                                                    echo "
                                                    <li>
                                                    <label for='Actual_Start_Time_id'>Job Actual Start Time</label>
                                                    <input type='text' name='Job_Actual_Start_Time' 
                                                        value='0000-00-00 00:00:00' class='form-control' id='Actual_Start_Time_id' /> 
                                                    </li>
                                                    ";
                                                ?>

                                                <?php 
                                                    echo "
                                                    <li>
                                                    <label for='Actual_Finish_Time_id'>Job Actual Finish Time</label>
                                                    <input type='text' name='Job_Actual_Finish_Time' 
                                                        value='0000-00-00 00:00:00' class='form-control' id='Actual_Finish_Time_id' /> 
                                                    </li>
                                                    ";
                                                ?>

                                                <?php returnInputFieldForCreateViewLi("Job Total Billing Time", "contractor_billing"); ?>
                                                <?php returnInputFieldForCreateViewLi("Contractor Billing Service Name", "contractor_billing"); ?>
                                                
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
                                                   <?php returnInputFieldForCreateViewLi("Contractor Billing Rate", "contractor_billing"); ?>
                                                    <?php returnInputFieldForCreateViewLi("Contractor Billing Service Name Total", "contractor_billing"); ?>
                                                    <?php returnInputFieldForCreateViewLi("Job LEP Name", "contractor_billing"); ?>
                                                    <?php returnInputFieldForCreateViewLi("Job Special Request", "contractor_billing"); ?>
                                                    <?php returnInputFieldForCreateViewLi("Job Special request Fee", "contractor_billing"); ?>
                                                    <?php returnInputFieldForCreateViewLi("Job No Show Fee", "contractor_billing"); ?>
                                                    <?php returnInputFieldForCreateViewLi("Job Cancellation Fee", "contractor_billing"); ?>
                                                    <?php returnInputFieldForCreateViewLi("Job Mileage", "contractor_billing"); ?>
                                                    <?php returnInputFieldForCreateViewLi("Job Mileage Rate", "contractor_billing"); ?>
                                                    <?php returnInputFieldForCreateViewLi("Job Con Mileage Rate", "contractor_billing"); ?>
                                                    <?php returnInputFieldForCreateViewLi("Job Con Mileage Rate Fee", "contractor_billing"); ?>
                                                    <?php returnInputFieldForCreateViewLi("Job Parking Fees", "contractor_billing"); ?>
                                                    <?php returnInputFieldForCreateViewLi("Job Travel Time", "contractor_billing"); ?>
                                                    <?php returnInputFieldForCreateViewLi("Job Travel Time Rate", "contractor_billing"); ?>
                                                    <?php returnInputFieldForCreateViewLi("Job Con Travel Time Rate", "contractor_billing"); ?>
                                                    <?php returnInputFieldForCreateViewLi("job Con Travel Time Rate Fee", "contractor_billing"); ?>
                                                    <?php returnInputFieldForCreateViewLi("Job Post Outcome", "contractor_billing"); ?>
                                                    <?php returnInputFieldForCreateViewLi("Job InvoiceTotal", "contractor_billing"); ?>
                                                    <?php returnInputFieldForCreateViewLi("Job BillTotal", "contractor_billing"); ?>
                                                    <?php returnInputFieldForCreateViewLi("Notes", "contractor_billing"); ?>
                                                    <?php returnInputFieldForCreateViewLi("Attachments", "contractor_billing"); ?>
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

            <div class="contractor_billing_create_result_text"></div>

            <div class="edit-job-submit-cl">
                {!! Form::submit('Create Contractor Billing', ['class' => 'btn btn-success btn-edit-save', 'id'=>'create_contractor_billing_id']) !!}
            </div>

            
            {!! Form::close() !!}
            
        </div>
    </div>
    <!-- Content Wrapper END -->

@endsection