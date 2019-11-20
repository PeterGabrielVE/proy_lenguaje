@extends('layouts.app')

@section('content')
            
    @include('sidebar')

    @include('header')

    <?php header('Access-Control-Allow-Origin: *'); ?>

    <!-- Content Wrapper START -->
    <div class="main-content">
        <div class="container-fluid">  

            
            <?php
            echo Form::open(array('url'=>'jobs/create/', 'files'=>true, 'method'=>'PUT', 'id'=>'create_job_form_id'));
            // echo Form::open(array('url'=>'jobs/create/', 'files'=>true, 'method'=>'PUT'));
            ?>
                <div class="job_create_result_text"></div>

                <div class="page-title">
                    
                    <h1 class="crd-job-single">
                        <span class="crd-job-single-edit">You're creating a new job entry:</span>
                    </h1>

                    <div class="breadcrumbs">
                        <div class="fa fa-hand-o-right"></div> 
                        You are here: 
                        <a href="{{url('/')}}">Home </a>
                            >
                        <a class="all_jobs_page_url" href="{{url('/jobs/')}}">All Jobs</a>
                        <a class="url2" href="{{url('/')}}"></a>
                            >
                        <a class="create_job_page_url_a_cl" href="{{url('/jobs/create/')}}">Create New Job</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                        <div class="card">
                            <div class="card-heading border bottom">
                                <h4 class="card-title crd-brdr">Details<i class="fa fa-briefcase"></i></h4>
                                <div class="row crd-job-details">
                                    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                                        <ul class="job-details-ul">
                                            <li class="select-cutmn-job-name">
                                                <label for="slctz-jobname">Name:</label>
                                                <select id="slctz-jobname" name="Job_Name">
                                                    <option value="" disabled selected>Name...</option>
                                                    <option id='job-cr8-jobname' value='Disability Evaluation'>Disability Evaluation
                                                    <option id='job-cr8-jobname' value='Workers Compensation'>Workers Compensation
                                                    <option id='job-cr8-jobname' value='Dr. Visit'>Dr. Visit</option>
                                                    <option id='job-cr8-jobname' value='IME'>IME</option>
                                                    <option id='job-cr8-jobname' value='IEP'>IEP</option>
                                                    <option id='job-cr8-jobname' value='Parent Conference'>Parent Conference</option>
                                                    <option id='job-cr8-jobname' value='Court'>Court</option>
                                                    <option id='job-cr8-jobname' value='Deposition'>Deposition</option>
                                                    <option id='job-cr8-jobname' value='Immigration Offices'>Immigration Offices</option>
                                                    <option id='job-cr8-jobname' value='Immigration Court'>Immigration Court</option>
                                                    <option id='job-cr8-jobname' value='Surgery'>Surgery</option>
                                                    <option id='job-cr8-jobname' value='Recorded Statement'>Recorded Statement</option>
                                                    <option id='job-cr8-jobname' value='Physical Therapy'>Physical Therapy</option>
                                                    <option id='job-cr8-jobname' value='Translation'>Translation</option>
                                                    <option id='job-cr8-jobname' value='Telephonic Interpretation'>Telephonic Interpretation</option>
                                                    <option id='job-cr8-jobname' value='VRI'>VRI</option>
                                                </select>
                                            </li>

                                            <li class="select-cutmn-job-status">
                                                <label for="slctz-jobstatus">Status:</label>
                                                <select id="slctz-jobstatus" name="Job_Status">
                                                    <option value="" disabled selected>Select Status...</option>
                                                    <option id='job-cr8-jobstatus' value='Request'>Request</option>
                                                    <option id='job-cr8-jobstatus' value='Canceled'>Canceled</option>
                                                    <option id='job-cr8-jobstatus' value='Completed'>Completed</option>
                                                    <option id='job-cr8-jobstatus' value='Invoice Sent'>Invoice Sent</option>
                                                    <option id='job-cr8-jobstatus' value='Bill Sent'>Bill Sent</option>
                                                    <option id='job-cr8-jobstatus' value='Quote'>Quote</option>
                                                    <option id='job-cr8-jobstatus' value='Miss Trip'>Miss Trip</option>
                                                    <option id='job-cr8-jobstatus' value='In Progress'>In Progress</option>
                                                    <option id='job-cr8-jobstatus' value='Closed'>Closed</option>
                                                    <option id='job-cr8-jobstatus' value='Ready for Invoicing'>Ready for Invoicing</option>
                                                    <option id='job-cr8-jobstatus' value='Missed Opportunity'>Missed Opportunity</option>
                                                    <option id='job-cr8-jobstatus' value='Partially Paid'>Partially Paid</option>
                                                    <option id='job-cr8-jobstatus' value='Missed Opportunity'>Missed Opportunity</option>
                                                </select>
                                            </li>
                                            <li>
                                                <?php 
                                                    // echo "<br/><br/>";
                                                    // echo date('Y/m/d H:s'); 

                                                ?>
                                                <label for="request_date_id">Request Date:</label>
                                                <input type="text" name="Request_Date" value="" id="request_datetimepicker" class="form-control">

                                                
                                            </li>
                                            <br/>
                                            <li class="select-cutmn-job-type">
                                                <label for="slctz-jobtype">Job Type:</label>
                                                <select id="slctz-jobtype" name="Job_Type">
                                                    <option value="" disabled selected>Select Job Type...</option>
                                                    <option id='job-cr8-jobtype' value='Interpretation'>Interpretation</option>
                                                    <option id='job-cr8-jobtype' value='Translation'>Translation</option>
                                                    <option id='job-cr8-jobtype' value='Telephonic interpretation'>Telephonic interpretation</option>
                                                    <option id='job-cr8-jobtype' value='Transportation'>Transportation</option>
                                                    <option id='job-cr8-jobtype' value='VRI'>VRI</option>
                                                </select>
                                            </li>

                                           <!--  <li>
                                                <label for="Job_Type_id">Job Type:</label>
                                                {!! Form::text('Job_Type', ' ', ['class' => 'form-control', 'id'=>'Job_Type_id']) !!}
                                            </li> -->

                                            <li class="select-cutmn-job-type">
                                                <label for="get_Jobs_Language_Requested_id">Language Requested:</label>
                                                <select id="selectize-dropdown-job-type" name="Jobs_Language_Requested">
                                                    <option value="" disabled selected>Select a Language...</option>
                                                    <!-- <option value="4">Standard</option> -->
                                                    <?php
                                                        $get_all_the_languages_from_db = \DB::select('SELECT language FROM languages');
                                                        foreach ($get_all_the_languages_from_db as $key => $value) {
                                                            $get_array = get_object_vars($value);
                                                            $language_trimmed = utf8_decode(trim($get_array['language']));
                                                            echo "<option value='". $language_trimmed ."'> ". $language_trimmed ."</option>";    
                                                        }
                                                    ?>
                                                </select>
                                            </li>
                                            <li>
                                                <label for="Customer_PO_Number_id">Customer PO Number:</label>
                                                {!! Form::text('Customer_PO_Number', ' ', ['class' => 'form-control', 'id'=>'Customer_PO_Number_id']) !!}
                                            </li>
                                            <li>
                                                <!-- <label for="get_Jobs_Language_Requested_id">Customer Number:</label> -->
                                                {!! Form::hidden('Customer_Number', ' ', ['class' => 'form-control', 'id'=>'Customer_Number_id']) !!}
                                            </li>

                                                    <!-- <select> -->
                                                    <?php
                                                        // $get_all_the_customers_from_db = \DB::select('SELECT ID, Cus_Company_Name FROM customers');

                                                        // foreach ($get_all_the_customers_from_db as $key => $value) {
                                                        //     $get_array = get_object_vars($value);
                                                        //     // var_dump($get_array["Cus_Company_Name"]);
                                                        //      //echo trim($get_array['ID']);
                                                        //      //echo " - ";
                                                        //     $c_name = str_replace("'", "", trim($get_array['Cus_Company_Name']));
                                                        //     //echo "<br/><br/>";
                                                        //     echo "<option value='". $c_name ."'>". $c_name ."</option>";

                                                        // }
                                                    ?>
                                                    <!-- </select> -->


                                            <li class="select-cutmn">
                                                <label for="Customer_Company_id">Customer Company:</label>
                                                <!-- {!! Form::text('Customer_Company', ' ', ['class' => 'form-control', 'id'=>'Customer_Company_id']) !!} -->

                                                <select id="slctz-customers" name="Customer_Company">
                                                    <option value="" disabled selected>Select Customer Company...</option>
                                                    <?php
                                                        $get_all_the_customers_from_db = \DB::select('SELECT ID, Cus_Company_Name FROM customers');
                                                        foreach ($get_all_the_customers_from_db as $key => $value) {
                                                            $get_array = get_object_vars($value);
                                                            $c_id = trim($get_array['ID']);
                                                            $c_name = str_replace("'", "", trim($get_array['Cus_Company_Name']));
                                                            echo "<option id='job-cr8-cstmr' value='".$c_id."'>".$c_name."</option>";
                                                        }
                                                    ?>
                                                </select>
                                            </li>
                                            <li>
                                                <label for="Customer_First_Name_id">Requester Name:</label>
                                                {!! Form::text('Customer_First_Name', ' ', ['class' => 'form-control', 'id'=>'Customer_First_Name_id']) !!}
                                            </li>
                                            <li>
                                                <label for="Customer_Last_Name_id">LL Rep:</label>
                                                {!! Form::text('Customer_Last_Name', ' ', ['class' => 'form-control', 'id'=>'Customer_Last_Name_id']) !!}
                                            </li>
                                            <li>
                                                <!-- <label for="Customer_Email_id">Customer Email Address:</label> -->
                                                {!! Form::hidden('Customer_Email', ' ', ['class' => 'form-control', 'id'=>'Customer_Email_id']) !!}
                                            </li>
                                            <li>
                                                <!-- <label for="Service_For_id">Service For:</label> -->
                                                {!! Form::hidden('Service_For', ' ', ['class' => 'form-control', 'id'=>'Service_For_id']) !!}
                                            </li>
                                            <li>
                                                <!-- <label for="Gender_id">Gender:</label> -->
                                                {!! Form::hidden('Gender', ' ', ['class' => 'form-control', 'id'=>'Gender_id']) !!}
                                            </li>
                                           
                                        </ul>
                                        <ul class="job-details-ul">
                                            <li>
                                                <label for="Appointment_Start_Date_id">Appointment Start Date/Time:</label>
                                                {!! Form::text('Appointment_Start_Date', ' ', ['class' => 'form-control', 'id'=>'Appointment_Start_Date_id']) !!}
                                            </li>
                                            <li>
                                                <label for="Appointment_End_Date_id">Appointment End Date/Time:</label>
                                                {!! Form::text('Appointment_End_Date', ' ', ['class' => 'form-control', 'id'=>'Appointment_End_Date_id']) !!}
                                            </li>
                                            <li>
                                                <!-- <label for="Appointment_Start_Working_Time_id">Appointment Start Working Date/Time:</label> -->
                                                {!! Form::hidden('Start_Working_Time', ' ', ['class' => 'form-control', 'id'=>'Appointment_Start_Working_Time_id']) !!}
                                            </li>
                                            <li>
                                                <!-- <label for="Appointment_Finish_Working_Time_id">Appointment Finish Working Date/Time:</label> -->
                                                {!! Form::hidden('Finish_Working_Time', ' ', ['class' => 'form-control', 'id'=>'Appointment_Finish_Working_Time_id']) !!}
                                            </li>
                                            <li>
                                                <label for="Special_Request_id">Special Request:</label>
                                                {!! Form::textarea('Special_Request', ' ', ['class' => 'form-control', 'id'=>'Special_Request_id']) !!}
                                            </li>
                                            <li>
                                                <label for="Jobs_LEP_Name_id">LEP Name:</label>
                                                {!! Form::text('Jobs_LEP_Name', ' ', ['class' => 'form-control', 'id'=>'Jobs_LEP_Name_id']) !!}
                                            </li>
                                            <li>
                                                <label for="LEP_Phone_Number_id">LEP Phone Number:</label>
                                                {!! Form::text('LEP_Phone_Number', ' ', ['class' => 'form-control', 'id'=>'LEP_Phone_Number_id']) !!}
                                            </li>
                                            <li>
                                                <!-- <label for="Medical_Record_id">Medical Record:</label> -->
                                                {!! Form::hidden('Medical_Record', ' ', ['class' => 'form-control', 'id'=>'Medical_Record_id']) !!}
                                            </li>
                                            <li>
                                                <!-- <label for="Court_Record_id">Court Record:</label> -->
                                                {!! Form::hidden('Court_Record', ' ', ['class' => 'form-control', 'id'=>'Court_Record_id']) !!}
                                            </li>
                                            <li>
                                                <label for="The_Service_Type_id">Service Type:</label>
                                                {!! Form::text('The_Service_Type', ' ', ['class' => 'form-control', 'id'=>'The_Service_Type_id']) !!}
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
                                <h4 class="card-title crd-brdr">Estimate/Quote <i class="fa fa-money"></i></h4>
                                <div class="row crd-job-details">
                                    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                                        <ul class="job-details-ul">
                                            <li>
                                                <input type="hidden" id="srv_rq_first" value="">
                                                <label for="Service_Requested_id">Service Requested:</label>
                                                <!-- {!! Form::text('Service_Requested', ' ', ['class' => 'form-control', 'id'=>'Service_Requested_id']) !!} -->
                                                <select name="Service_Requested" id="Service_Requested_id" class="Service_Requested_cl form-control">
                                                    <option></option>
                                                </select>
                                            </li>
                                            <li>
                                                <label for="Service_Name_Rate_id">Service Rate:</label>
                                                <span class="inline-dollar-sign">$</span>
                                                {!! Form::text('Service_Name_Rate', ' ', ['class' => 'form-control', 'id'=>'Service_Name_Rate_id']) !!}
                                            </li>
                                            <li>
                                                <label for="Service_Code_id">Service Code:</label>
                                                {!! Form::text('Service_Code', ' ', ['class' => 'form-control', 'id'=>'Service_Code_id']) !!}
                                            </li>
                                            <li>
                                                <label for="Estimated_Service_Hours_id">Estimated Service Hours:</label>
                                                {!! Form::text('Estimated_Service_Hours', '', ['class' => 'form-control', 'id'=>'Estimated_Service_Hours_id']) !!}
                                            </li>
                                            <li>
                                                <label for="Estimated_Service_Cost_id">Estimated Service Cost:</label>
                                                <span class="inline-dollar-sign">$</span>
                                                {!! Form::text('Estimated_Service_Cost', ' ', ['class' => 'form-control', 'id'=>'Estimated_Service_Cost_id']) !!}
                                            </li>
                                            <hr>
                                            <li>
                                               <!--  <label for="Mileage_Code_id">Mileage Code:</label>
                                                {!! Form::text('Mileage_Code', ' ', ['class' => 'form-control', 'id'=>'Mileage_Code_id']) !!} -->

                                                 <label for="Mileage_Code_id">Mileage Code:</label>
                                                <select name="Mileage_Code" id="Mileage_Code_id" class="Service_Requested_cl form-control">
                                                    <option></option>
                                                </select>


                                            </li>
                                            <li>
                                                <label for="Mileage_Rate_id">Mileage Rate:</label>
                                                <span class="inline-dollar-sign">$</span>
                                                {!! Form::text('Mileage_Rate', ' ', ['class' => 'form-control', 'id'=>'Mileage_Rate_id']) !!}
                                            </li>
                                            <li>
                                                <label for="Estimated_Miles_id">Estimated Miles:</label>
                                                {!! Form::text('Estimated_Miles', '', ['class' => 'form-control', 'id'=>'Estimated_Miles_id']) !!}
                                            </li>
                                            <li>
                                                <label for="Estimated_Mileage_Cost_id">Estimated Mileage Cost:</label>
                                                <span class="inline-dollar-sign">$</span>
                                                {!! Form::text('Estimated_Mileage_Cost', ' ', ['class' => 'form-control', 'id'=>'Estimated_Mileage_Cost_id']) !!}
                                            </li>
                                            <hr>
                                            <li>
                                                <label for="Travel_Time_Estimate_id">Travel Time:</label>
                                                {!! Form::text('Travel_Time_Estimate', ' ', ['class' => 'form-control', 'id'=>'Travel_Time_Estimate_id']) !!}
                                            </li>
                                            
                                            <li>
                                                <label for="Jobs_Parking_Fees_id">Jobs Parking Fees:</label>
                                                {!! Form::text('Jobs_Parking_Fees', ' ', ['class' => 'form-control', 'id'=>'Jobs_Parking_Fees_id']) !!}
                                            </li>
                                            <li>
                                                <label for="Jobs_Mileage_id">Jobs Mileage:</label>
                                                {!! Form::text('Jobs_Mileage', ' ', ['class' => 'form-control', 'id'=>'Jobs_Mileage_id']) !!}
                                            </li>
                                            <li>
                                                <label for="Travel_Time_Code_id">Travel Time Code:</label>
                                                {!! Form::text('Travel_Time_Code', ' ', ['class' => 'form-control', 'id'=>'Travel_Time_Code_id']) !!}
                                            </li>
                                            <li>
                                                <label for="Travel_Time_Rate_id">Travel Time Rate:</label>
                                                {!! Form::text('Travel_Time_Rate', ' ', ['class' => 'form-control', 'id'=>'Travel_Time_Rate_id']) !!}
                                            </li>
                                            <li>
                                                <label for="Jobs_Total_Billing_Hours_id">Total Billing Hours:</label>
                                                {!! Form::text('Jobs_Total_Billing_Hours', ' ', ['class' => 'form-control', 'id'=>'Jobs_Total_Billing_Hours_id']) !!}
                                            </li>
                                            
                                            <li>
                                                <label for="Estimated_Travel_Time_id">Estimated Travel Time:</label>
                                                {!! Form::text('Estimated_Travel_Time', ' ', ['class' => 'form-control', 'id'=>'Estimated_Travel_Time_id']) !!}
                                            </li>
                                            <li>
                                                <label for="Estimated_Travel_Time_Fee_id">Estimated Travel Time Fee:</label>
                                                {!! Form::text('Estimated_Travel_Time_Fee', ' ', ['class' => 'form-control', 'id'=>'Estimated_Travel_Time_Fee_id']) !!}
                                            </li>

                                            <li>
                                                <label for="SubTotal_Estimate_id">SubTotal Estimate:</label>
                                                {!! Form::text('SubTotal_Estimate', ' ', ['class' => 'form-control', 'id'=>'SubTotal_Estimate_id']) !!}
                                            </li>

                                            <li>
                                                <label for="Special_Request_Surcharge_id">Other Charges:</label>
                                                {!! Form::text('Special_Request_Surcharge', ' ', ['class' => 'form-control', 'id'=>'Special_Request_Surcharge_id']) !!}
                                            </li>

                                            <li>
                                                <label for="Special_Request_Surcharge_Total_id">Other Charges Total:</label>
                                                {!! Form::text('Special_Request_Surcharge_Total', ' ', ['class' => 'form-control', 'id'=>'Special_Request_Surcharge_Total_id']) !!}
                                            </li>
                                            <li>
                                                <!-- <label for="invoice_date_datetimepicker">Invoice Date:</label> -->
                                                {!! Form::hidden('Invoice_Date', ' ', ['class' => 'form-control', 'id'=>'invoice_date_datetimepicker']) !!}
                                            </li>
                                            <li>
                                                <!-- <label for="invoice_acceptance_date_datetimepicker">Invoice Acceptance Date:</label> -->
                                                {!! Form::hidden('Invoice_Acceptance_Date', ' ', ['class' => 'form-control', 'id'=>'invoice_acceptance_date_datetimepicker']) !!}
                                            </li>

                                            <li class="emphasised-li-2">
                                                
                                                <label for="Total_Estimate_id">Total Estimate:</label>
                                                {!! Form::text('Total_Estimate', ' ', ['class' => 'form-control', 'id'=>'Total_Estimate_id']) !!}
                                            </li>
                                        </ul>
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
                                <h4 class="card-title crd-brdr">
                                    Assignment Details
                                </h4>
                                <div class="row crd-job-details">
                                    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                                        <ul class="job-details-ul">
                                            <li>
                                                <label for="Assignment_Location_id">Assignment Location:</label>
                                                {!! Form::text('Assignment_Location', ' ', ['class' => 'form-control', 'id'=>'Assignment_Location_id']) !!}
                                            </li>
                                            <li>
                                                <label for="Assignment_Department_id">Assignment Department:</label>
                                                {!! Form::text('Assignment_Department', ' ', ['class' => 'form-control', 'id'=>'Assignment_Department_id']) !!}
                                            </li>
                                            <li>
                                                <label for="Assignment_Contact_Person_id">Assignment Contact Person:</label>
                                                {!! Form::text('Assignment_Contact_Person', ' ', ['class' => 'form-control', 'id'=>'Assignment_Contact_Person_id']) !!}
                                            </li>
                                            <li>
                                                <label for="Provider_Name_id">Provider Name:</label>
                                                {!! Form::text('Provider_Name', ' ', ['class' => 'form-control', 'id'=>'Provider_Name_id']) !!}
                                            </li>
                                            <li>
                                                <label for="Assignment_Phone_Number_id">Assignment Phone Number:</label>
                                                {!! Form::text('Assignment_Phone_Number', ' ', ['class' => 'form-control', 'id'=>'Assignment_Phone_Number_id']) !!}
                                            </li>
                                            <li>
                                                <label for="Assignment_Street_Address_1_id">Assignment Street Address 1:</label>
                                                {!! Form::text('Assignment_Street_Address_1', ' ', ['class' => 'form-control', 'id'=>'Assignment_Street_Address_1_id']) !!}
                                            </li>
                                            <li>
                                                <label for="Assignment_Street_Address_2_id">Assignment Street Address 2:</label>
                                                {!! Form::text('Assignment_Street_Address_2', ' ', ['class' => 'form-control', 'id'=>'Assignment_Street_Address_2_id']) !!}
                                            </li>
                                            <li>
                                                <label for="Jobs_Assignment_City_id">Assignment Address City:</label>
                                                {!! Form::text('Assignment_City', ' ', ['class' => 'form-control', 'id'=>'Jobs_Assignment_City_id']) !!}
                                            </li>
                                            <li>
                                                <label for="Jobs_Assignment_State_id">Assignment Address State:</label>
                                                {!! Form::text('Assignment_State', ' ', ['class' => 'form-control', 'id'=>'Jobs_Assignment_State_id']) !!}
                                            </li>
                                            <li>
                                                <label for="Jobs_Assignment_Zip_Code_id">Assignment Address Zip Code:</label>
                                                {!! Form::text('Assignment_Zip_Code', ' ', ['class' => 'form-control', 'id'=>'Jobs_Assignment_Zip_Code_id']) !!}
                                            </li>
                                            <li>
                                                <label for="Jobs_Assignment_Email_id">Assignment/Customer Email:</label>
                                                {!! Form::text('Assignment_Email', ' ', ['class' => 'form-control', 'id'=>'Jobs_Assignment_Email_id']) !!}
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
                                <h4 class="card-title crd-brdr">
                                    Contractor Details
                                </h4>
                                <div class="row crd-job-details">
                                    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                                        <div class="job-contractor-details-div">
                                            <ul class="job-details-ul">
                                                <li>
                                                    <label for="Contractor_ID_id">Contractor ID:</label>
                                                    {!! Form::text('Contractor_ID', ' ', ['class' => 'form-control', 'id'=>'Contractor_ID_id']) !!} 
                                                </li>
                                                
                                                <div class="job-create-find-contractor">
                                                    Type contractor ID above and click find contractor to prefill the contractor details below.
                                                    <br/>
                                                    <a class="btn btn-primary job-create-find-contractor-btn" id="job-create-find-contractor-btn-id">Find Contractor</a>
                                                </div>

                                                <li>
                                                    <label for="Contractor_Email_id">Contractor Email:</label>
                                                    {!! Form::text('Contractor_Email', ' ', ['class' => 'form-control', 'id'=>'Contractor_Email_id']) !!}  
                                                </li>
                                                <li>
                                                    <label for="Contractor_Home_Phone_Number_id">Contractor Home Phone Number:</label>
                                                    {!! Form::text('Contractor_Home_Phone_Number', ' ', ['class' => 'form-control', 'id'=>'Contractor_Home_Phone_Number_id']) !!}   
                                                </li>
                                                <li>
                                                    <label for="Contractor_Cell_Phone_Number_id">Contractor Cell Phone Number:</label>
                                                    {!! Form::text('Contractor_Cell_Phone_Number', ' ', ['class' => 'form-control', 'id'=>'Contractor_Cell_Phone_Number_id']) !!}   
                                                </li>
                                                <li>
                                                    <label for="Contractor_First_Name_id">Contractor First Name:</label>
                                                    {!! Form::text('Contractor_First_Name', ' ', ['class' => 'form-control', 'id'=>'Contractor_First_Name_id']) !!}  
                                                </li>
                                                <li>
                                                    <label for="Contractor_Last_Name_id">Contractor Last Name:</label>
                                                    {!! Form::text('Contractor_Last_Name', ' ', ['class' => 'form-control', 'id'=>'Contractor_Last_Name_id']) !!}   
                                                </li>
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
                                <h4 class="card-title crd-brdr">
                                    Fullfillment/Internal Notes
                                </h4>
                                <div class="row crd-job-details">
                                    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                                        <ul class="job-details-ul">
                                            {!! Form::hidden('Input_Post_Outcome', ' ', ['class' => 'form-control', 'id'=>'Input_Post_Outcome_id']) !!}
                                            
                                            <li class="backgrounded-li width100">           
                                                <label for="Job_Notes_id">Fullfilment/Internal Notes:</label>
                                                <textarea name="Job_Fullfillment_Internal_Notes" id="jobs_Job_Fullfillment_Internal_Notes_id" class="form-control" cols="50" rows="10"></textarea>
                                            </li>

                                            

                                            <!-- <li class="backgrounded-li width100"> -->
                                                <?php //returnInputFieldForjobsCreateView("Job Fullfillment Internal Notes"); ?>
                                                
                                                <!-- <label for="Job_Fullfillment_Internal_Notes_id">Job Fullfillment & Internal Notes:</label>
                                                {!! Form::text('Job_Fullfillment_Internal_Notes', ' ', ['class' => 'form-control', 'id'=>'Job_Fullfillment_Internal_Notes_id']) !!} -->
                                            <!-- </li> -->
                                            <li class="backgrounded-li width100">           
                                                <label for="Job_Notes_id">Job Notes:</label>
                                                {!! Form::textarea('Job_Notes', ' ', ['class' => 'form-control', 'id'=>'Job_Notes_id']) !!}  
                                            </li>
                                            <li class="backgrounded-li width100">           
                                                <label for="Input_Jobs_Notes_Post_id">Extra Job Notes:</label>
                                                {!! Form::textarea('Input_Jobs_Notes_Post', ' ', ['class' => 'form-control', 'id'=>'Input_Jobs_Notes_Post_id']) !!}  
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
                                <h4 class="card-title crd-brdr">
                                    File Upload
                                </h4>

                                <div class="crd-job-details">
                                    File Upload:
                                      <div class="dropzone clsbox border-dropzone" id="myDropzone" name="">
                                                        {{csrf_field()}}
                                                       
                                                    
                                                    </div>
                                 
                                    <br/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- </form> -->
            
            
            <div class="job_create_result_text"></div>

            <div class="edit-job-submit-cl">
                {!! Form::submit('Create JOB', ['class' => 'btn btn-success btn-edit-save', 'id'=>'create_job_id']) !!}
            </div>

            
            {!! Form::close() !!}

            <!-- end showing all job details -->

            
        </div>
    </div>
    <!-- Content Wrapper END -->
    <script>
        var uploadedDocumentMap = {}; 
        Dropzone.options.myDropzone =
         {
            headers: {
            //'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')'
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
             },
            url:"upload",
            maxFilesize: 200,
            renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
               return time+file.name;
            },
            acceptedFiles: ".jpeg,.jpg,.png,.gif,.pdf,.txt,.ocx,.doc,.docx",
            addRemoveLinks: true,
            timeout: 5000,
            
            type: 'post',
            data: $('#myDropzone').serialize(),
            cache: false,
            processData: false,
            dataType: 'json',
            success: function(file, response) 
            {
                console.log(response);
                 $('form').append('<input type="hidden" id="Input_Attachments_id" name="job_create_contractor_file_upload[]" value="' + response.name + '"><br/>');
                uploadedDocumentMap[file.name] = response.name;
                console.log(uploadedDocumentMap[file.name]);
            },
            removedfile: function (file) {
              file.previewElement.remove()
              var name = ''
              if (typeof file.file_name !== 'undefined') {
                name = file.file_name
              } else {
                name = uploadedDocumentMap[file.name]
              }
          
            },
            error: function(file, response)
            {
               return false;
            },
            /*init: function() {
             this.on("addedfile", function(file) { alert("Added file."); });
             },*/
           
};
    </script>

@endsection