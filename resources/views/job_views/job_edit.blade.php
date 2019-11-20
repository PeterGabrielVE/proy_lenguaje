@extends('layouts.app')

@section('content')
            
    @include('sidebar')

    @include('header')

    <!-- Content Wrapper START -->
    <div class="main-content">
        <div class="container-fluid">
            
            @foreach ($jobs as $job)

            <?php //dd($job->Jobs_Attachments) ?>

            <?php $value = intval($job->ID); ?>
            <?php
            //echo Form::open(array('url'=>'jobs/edit/'.$job->ID, 'files'=>true, 'method'=>'PUT', 'id'=>'edit_job_form_id'));
            echo Form::open(array('url'=>'jobs/edit/'.$job->ID, 'files'=>true, 'method'=>'PUT', 'enctype' => 'multipart/form-data'));
            ?>
                <div class="job_edit_result_text"></div>

                <div class="page-title">
                    
                    <h1 class="crd-job-single">
                        <span class="crd-job-single-edit">You're currently editing this job:</span>
                        <?php 
                            if ( strlen($job->Jobs_Job_Name) <= 0 ){
                                echo "<span class='empty-job-name'><i class='fa fa-meh-o'></i> Empty Job Name</span>";
                            } else {
                                echo str_replace("'", "", $job->Jobs_Job_Name);
                            }
                        ?>
                    </h1>

                    <div class="breadcrumbs">
                        <div class="fa fa-hand-o-right"></div> 
                        You are here: 
                        <a href="{{url('/')}}">Home </a>
                            >
                        <a class="all_jobs_page_url" href="{{url('/jobs/')}}">All Jobs</a>
                            >
                        <a class="url2" href="{{url('/')}}"></a>
                            >
                        <a class="job_page_url_a_cl" href="{{url('/jobs/edit')}}/{{$job->ID}}">Editing Single Job</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                        <div class="card">
                            <div class="card-heading border bottom">
                                <h4 class="card-title crd-brdr">Job Details <i class="fa fa-briefcase"></i></h4>
                                <div class="row crd-job-details">
                                    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                                    <!-- <div class="col-md-6 col-xs-12 col-sm-12 col-lg-6"> -->
                                        <ul class="job-details-ul">
                                            <li>Number/ID: <b>{{$job->ID}}</b></li>
                                            {!! Form::hidden('Job_ID', $job->ID, ['id' => 'job_ID_id']) !!}
                                                <li>
                                                    <?php
                                                        $get_Jobs_Job_Name = str_replace("'", "", $job->Jobs_Job_Name);
                                                    ?>
                                                    <li class="select-cutmn-job-name">
                                                    <label for="slctz-jobname">Name:</label>
                                                    <select id="slctz-jobname" name="Job_Name">
                                                        <option value="<?php echo $get_Jobs_Job_Name; ?>" disabled selected><?php echo $get_Jobs_Job_Name; ?></option>
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

                                                <!-- <label for="Jobs_Job_Name_id">Job Name:</label> -->
                                                <!-- {!! Form::text('Job_Name', $get_Jobs_Job_Name, ['class' => 'form-control', 'id'=>'Jobs_Job_Name_id']) !!} -->
                                            </li>
                                            <li>
                                                <?php
                                                    $get_job_status = str_replace("'", "", $job->Jobs_Status);
                                                ?>
                                                <label for="Job_Status_id">Status:</label>
                                                {!! Form::text('Job_Status', $get_job_status, ['class' => 'form-control', 'id'=>'Job_Status_id']) !!}
                                            </li>
                                            <li>
                                                <?php
                                                    $get_job_Request_Date = setDateValueInView($job->Job_Request_Date);
                                                ?>
                                                <label for="request_date_id">Request Date:</label>
                                                {!! Form::text('Request_Date', $get_job_Request_Date, ['class' => 'form-control', 'id'=>'request_datetimepicker']) !!}
                                            </li>
                                            <li>
                                                <?php
                                                    $get_Jobs_Type = str_replace("'", "", $job->Jobs_Type);
                                                ?>
                                                <label for="Job_Type_id"> Type:</label>

                                                {!! Form::text('Job_Type', $get_Jobs_Type, ['class' => 'form-control', 'id'=>'Job_Type_id']) !!}
                                            </li>
                                            <li>
                                                <label for="get_Jobs_Language_Requested_id">Language Requested:</label>
                                                <?php
                                                    $get_Jobs_Language_Requested = removeQuotes($job->Jobs_Language_Requested);
                                                

                    echo "<select id='selectize-dropdown-job-type' name='Jobs_Language_Requested' class='job_edit_select'>";
                    echo "<option value='" . $get_Jobs_Language_Requested ."' disabled selected>";
                    ?>
                    <?php echo $get_Jobs_Language_Requested . "</option>";
                    
                        $get_all_the_languages_from_db = \DB::select('SELECT language FROM languages');
                        if ( isset($get_Jobs_Language_Requested) && strlen($get_Jobs_Language_Requested) > 2 && !empty($get_Jobs_Language_Requested) ) {
                            $get_the_language = $get_Jobs_Language_Requested;
                        } else{
                            $get_the_language = "";
                        }
                        

                        foreach ($get_all_the_languages_from_db as $key => $value) {
                            $get_array = get_object_vars($value);
                            $language_trimmed = utf8_decode(trim($get_array['language']));
                            // if (
                            //         isset($language_trimmed) && 
                            //         (strlen($language_trimmed) > 2) &&
                            //         ($language_trimmed === $get_the_language)
                            //     ) {
                            //     echo "<option value='". $language_trimmed ."' selected> ". $language_trimmed ."</option>";    
                            // } else {
                            //     echo "<option value='". $language_trimmed ."'> ". $language_trimmed ."</option>";    
                            // }
                            echo "<option value='". $language_trimmed ."'> ". $language_trimmed ."</option>";    
                        }
                    ?>
                </select>
                                            </li>
                                            <li>
                                                <?php
                                                    $get_Jobs_Customers_Cus_Number = str_replace("'", "", $job->Jobs_Customers_Cus_Number);
                                                ?>
                                                <!-- <label for="Customer_Number_id">Customer Number:</label> -->
                                                {!! Form::hidden('Customer_Number', $get_Jobs_Customers_Cus_Number, ['class' => 'form-control', 'id'=>'Customer_Number_id']) !!}
                                            </li>
                                             <li class="select-cutmn">
                                                <label for="Customer_Company_id">Customer Company:</label>
                                                    
                                                <select id="slctz-customers" name="Customer_Company">
                                                    <?php
                                                        if ( 
                                                            isset($job->Jobs_Customers_Company)
                                                            && ( intval($job->Jobs_Customers_Company) > 0 ) 
                                                        ){
                                                            $l_Jobs_Customers_Company =removeQuotes(getCustomerNameWithID($job->Jobs_Customers_Company));     
                                                            echo "<option value='".$l_Jobs_Customers_Company."' disabled selected>".$l_Jobs_Customers_Company."</option>";

                                                            // echo "<input type='text' name='Customer_Company' class='form-control' value='".$l_Jobs_Customers_Company."'>";
                                                         } else {
                                                            echo "<option value='' disabled selected>Select Customer Company...</option>";

                                                            // echo "<input type='text' name='Customer_Company' class='form-control' value=''>";
                                                         }
                                                    ?>
                                                    <!-- <option value="" disabled selected>Select Customer Company...</option> -->
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

                                                    <?php
                                                        // if ( 
                                                        //     isset($job->Jobs_Customers_Company)
                                                        //     && ( intval($job->Jobs_Customers_Company) > 0 ) 
                                                        // ){
                                                        //     $l_Jobs_Customers_Company =removeQuotes(getCustomerNameWithID($job->Jobs_Customers_Company));     
                                                        //     echo "<input type='text' name='Customer_Company' class='form-control' value='".$l_Jobs_Customers_Company."'>";
                                                        //  } else {
                                                        //     echo "<input type='text' name='Customer_Company' class='form-control' value=''>";
                                                        //  }
                                                    ?>
                                                    

                                                <!-- <input type="text" name="Customer_Company" class="form-control" value="<?php /*echo removeQuotes(getCustomerNameWithID($job->Jobs_Customers_Company));*/  ?>  "> -->

                                                <!-- <select id="slctz-customers" name="Customer_Company"> -->
                                                    <!-- <option value="<?php //echo removeQuotes(getCustomerNameWithID($job->Jobs_Customers_Company)); ?>" disabled selected><?php //echo removeQuotes(getCustomerNameWithID($job->Jobs_Customers_Company)); ?></option> -->
                                                    <?php
                                                        // $get_all_the_customers_from_db = \DB::select('SELECT ID, Cus_Company_Name FROM customers');
                                                        // foreach ($get_all_the_customers_from_db as $key => $value) {
                                                        //     $get_array = get_object_vars($value);
                                                        //     $c_id = trim($get_array['ID']);
                                                        //     $c_name = str_replace("'", "", trim($get_array['Cus_Company_Name']));
                                                        //     echo "<option id='job-cr8-cstmr' value='".$c_id."'>".$c_name."</option>";
                                                        // }
                                                    ?>
                                                <!-- </select> -->
                                            </li>
                                            <li>
                                                <?php
                                                    $get_Jobs_Customers_First = str_replace("'", "", $job->Jobs_Customers_First);
                                                ?>
                                                <label for="Customer_First_Name_id">Requester Name:</label>
                                                {!! Form::text('Customer_First_Name', $get_Jobs_Customers_First, ['class' => 'form-control', 'id'=>'Customer_First_Name_id']) !!}
                                            </li>
                                            <li>
                                                <?php
                                                    $get_Jobs_Customers_Last = str_replace("'", "", $job->Jobs_Customers_Last);
                                                ?>
                                                <label for="Customer_Last_Name_id">LLP Rep:</label>
                                                {!! Form::text('Customer_Last_Name', $get_Jobs_Customers_Last, ['class' => 'form-control', 'id'=>'Customer_Last_Name_id']) !!}
                                            </li>
                                            <li>
                                                <?php
                                                    $get_Jobs_Service_Name = str_replace("'", "", $job->Jobs_Service_Name);
                                                ?>
                                                <!-- <label for="Service_For_id">Service For:</label> -->
                                                {!! Form::hidden('Service_For', $get_Jobs_Service_Name, ['class' => 'form-control', 'id'=>'Service_For_id']) !!}
                                            </li>
                                            <li>
                                                <?php
                                                    $get_Jobs_Gender_Preference = str_replace("'", "", $job->Jobs_Gender_Preference);
                                                ?>
                                                <!-- <label for="Gender_id">Gender:</label> -->
                                                {!! Form::hidden('Gender', $get_Jobs_Gender_Preference, ['class' => 'form-control', 'id'=>'Gender_id']) !!}
                                            </li>
                                        </ul>
                                        <ul class="job-details-ul">
                                            <li>
                                                <?php
                                                    $get_Jobs_Start_Time = setDateValueInView($job->Jobs_Start_Time);
                                                ?>
                                                <label for="Appointment_Start_Date_id">Appointment Start Date/Time:</label>
                                                {!! Form::text('Appointment_Start_Date', $get_Jobs_Start_Time, ['class' => 'form-control', 'id'=>'Appointment_Start_Date_id']) !!}
                                            </li>
                                            <li>
                                                <?php
                                                    $get_Jobs_End_Time = setDateValueInView($job->Jobs_End_Time);
                                                ?>
                                                <label for="Appointment_End_Date_id">Appointment End Date/Time:</label>
                                                {!! Form::text('Appointment_End_Date', $get_Jobs_End_Time, ['class' => 'form-control', 'id'=>'Appointment_End_Date_id']) !!}
                                            </li>
                                            <li>
                                                <?php
                                                    $get_Jobs_Start_Working_Time = setDateValueInView($job->Jobs_Start_Working_Time);
                                                ?>
                                                <label for="Appointment_Start_Working_Time_id">Appointment Start Working Date/Time:</label>
                                                {!! Form::text('Start_Working_Time', $get_Jobs_Start_Working_Time, ['class' => 'form-control', 'id'=>'Appointment_Start_Working_Time_id']) !!}
                                            </li>
                                            <li>
                                                <?php
                                                $get_Jobs_Finish_Working_time = setDateValueInView($job->Jobs_Finish_Working_time);
                                                ?>
                                                <label for="Appointment_Finish_Working_Time_id">Appointment Finish Working Date/Time:</label>
                                                {!! Form::text('Finish_Working_Time', $get_Jobs_Finish_Working_time, ['class' => 'form-control', 'id'=>'Appointment_Finish_Working_Time_id']) !!}
                                            </li>
                                            <li>
                                                <?php
                                                    $get_Jobs_Special_Request = str_replace("'", "", $job->Jobs_Special_Request);
                                                ?>
                                                <label for="Special_Request_id">Special Request:</label>
                                                {!! Form::textarea('Special_Request', $get_Jobs_Special_Request, ['class' => 'form-control', 'id'=>'Special_Request_id']) !!}
                                            </li>
                                            <li>
                                                <?php
                                                    $get_Jobs_Customers_PO_Number = str_replace("'", "", $job->Jobs_Customers_PO_Number);
                                                ?>
                                                <label for="Customer_PO_Number_id">Customer PO Number:</label>
                                                {!! Form::text('Customer_PO_Number', $get_Jobs_Customers_PO_Number, ['class' => 'form-control', 'id'=>'Customer_PO_Number_id']) !!}
                                            </li>
                                            <li>
                                                <?php
                                                    $get_Jobs_LEP_Name = str_replace("'", "", $job->Jobs_LEP_Name);
                                                ?>
                                                <label for="Jobs_LEP_Name_id">LEP Name:</label>
                                                {!! Form::text('Jobs_LEP_Name', $get_Jobs_LEP_Name, ['class' => 'form-control', 'id'=>'Jobs_LEP_Name_id']) !!}
                                            </li>
                                            <li>
                                                <?php
                                                    $get_Jobs_LEP_Phone = str_replace("'", "", $job->Jobs_LEP_Phone);
                                                ?>
                                                <label for="LEP_Phone_Number_id">LEP Phone Number:</label>
                                                {!! Form::text('LEP_Phone_Number', $get_Jobs_LEP_Phone, ['class' => 'form-control', 'id'=>'LEP_Phone_Number_id']) !!}
                                            </li>
                                            <li>
                                                <?php
                                                    $get_Job_Medical_Record_Number = str_replace("'", "", $job->Job_Medical_Record_Number);
                                                ?>
                                                <!-- <label for="Medical_Record_id">Medical Record:</label> -->
                                                {!! Form::hidden('Medical_Record', $get_Job_Medical_Record_Number, ['class' => 'form-control', 'id'=>'Medical_Record_id']) !!}
                                            </li>
                                            <li>
                                                <?php
                                                    $get_Jobs_Court_Record_Number = str_replace("'", "", $job->Jobs_Court_Record_Number);
                                                ?>
                                                <!-- <label for="Court_Record_id">Court Record:</label> -->
                                                {!! Form::hidden('Court_Record', $get_Jobs_Court_Record_Number, ['class' => 'form-control', 'id'=>'Court_Record_id']) !!}
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
                                                <select name="Service_Requested" id="Service_Requested_id" class="Service_Requested_cl form-control">
                                                    <option></option>
                                                </select>
                                            </li>
                                            <li>
                                                <?php
                                                    $get_Jobs_Service_Name_Rate = str_replace("'", "", $job->Jobs_Service_Name_Rate);
                                                ?>
                                                <label for="Service_Name_Rate_id">Service Rate:</label>
                                                {!! Form::text('Service_Name_Rate', $get_Jobs_Service_Name_Rate, ['class' => 'form-control', 'id'=>'Service_Name_Rate_id']) !!}
                                            </li>
                                            <li>
                                                <?php
                                                    $get_Jobs_Service_Code = str_replace("'", "", $job->Jobs_Service_Code);
                                                ?>
                                                <label for="Service_Code_id">Service Code:</label>
                                                {!! Form::text('Service_Code', $get_Jobs_Service_Code, ['class' => 'form-control', 'id'=>'Service_Code_id']) !!}
                                            </li>
                                            <li>
                                                <?php
                                                    $get_Jobs_Service_Hours_Estimate = str_replace("'", "", $job->Jobs_Service_Hours_Estimate);
                                                ?>
                                                <label for="Estimated_Service_Hours_id">Estimated Service Hours:</label>
                                                {!! Form::text('Estimated_Service_Hours', $get_Jobs_Service_Hours_Estimate, ['class' => 'form-control', 'id'=>'Estimated_Service_Hours_id']) !!}
                                            </li>
                                            <li>
                                                <?php
                                                    $get_Jobs_Service_Hours_Estimate_Cost = str_replace("'", "", $job->Jobs_Service_Hours_Estimate_Cost);
                                                ?>
                                                <label for="Estimated_Service_Cost_id">Estimated Service Cost:</label>
                                                {!! Form::text('Estimated_Service_Cost', $get_Jobs_Service_Hours_Estimate_Cost, ['class' => 'form-control', 'id'=>'Estimated_Service_Cost_id']) !!}
                                            </li>
                                            <li>
                                                <?php
                                                    $get_Jobs_Service_Mileage_Code = str_replace("'", "", $job->Jobs_Service_Mileage_Code);
                                                ?>
                                                <!-- <label for="Mileage_Code_id">Mileage Code:</label>
                                                {!! Form::text('Mileage_Code', $get_Jobs_Service_Mileage_Code, ['class' => 'form-control', 'id'=>'Mileage_Code_id']) !!} -->

                                                <label for="Mileage_Code_id">Mileage Code:</label>
                                                <select name="Mileage_Code" id="Mileage_Code_id" class="Service_Requested_cl form-control">
                                                    <option><?php echo $get_Jobs_Service_Mileage_Code; ?></option>
                                                </select>

                                            </li>
                                            <li>
                                                <?php
                                                    $get_Jobs_Service_Mileage_Rate = str_replace("'", "", $job->Jobs_Service_Mileage_Rate);
                                                ?>
                                                <label for="Mileage_Rate_id">Mileage Rate:</label>
                                                {!! Form::text('Mileage_Rate', $get_Jobs_Service_Mileage_Rate, ['class' => 'form-control', 'id'=>'Mileage_Rate_id']) !!}
                                            </li>
                                            <li>
                                                <?php
                                                    $get_Jobs_Service_Mileage_Estimate = str_replace("'", "", $job->Jobs_Service_Mileage_Estimate);
                                                ?>
                                                <label for="Estimated_Miles_id">Estimated Miles:</label>
                                                {!! Form::text('Estimated_Miles', $get_Jobs_Service_Mileage_Estimate, ['class' => 'form-control', 'id'=>'Estimated_Miles_id']) !!}
                                            </li>
                                            <li>
                                                <?php
                                                    $get_Jobs_Service_Mileage_Cost_Estimate = str_replace("'", "", $job->Jobs_Service_Mileage_Cost_Estimate);
                                                ?>
                                                <label for="Estimated_Mileage_Cost_id">Estimated Mileage Cost:</label>
                                                {!! Form::text('Estimated_Mileage_Cost', $get_Jobs_Service_Mileage_Cost_Estimate, ['class' => 'form-control', 'id'=>'Estimated_Mileage_Cost_id']) !!}
                                            </li>
                                            <li>
                                                <?php
                                                    $get_Jobs_Travel_Time_Code = str_replace("'", "", $job->Jobs_Travel_Time_Code);
                                                ?>
                                                <label for="Travel_Time_Code_id">Travel Time Code:</label>
                                                {!! Form::text('Travel_Time_Code', $get_Jobs_Travel_Time_Code, ['class' => 'form-control', 'id'=>'Travel_Time_Code_id']) !!}
                                            </li>
                                            <li>
                                                <?php
                                                    $get_Jobs_Travel_Time_Rate = str_replace("'", "", $job->Jobs_Travel_Time_Rate);
                                                ?>
                                                <label for="Travel_Time_Rate_id">Travel Time Rate:</label>
                                                {!! Form::text('Travel_Time_Rate', $get_Jobs_Travel_Time_Rate, ['class' => 'form-control', 'id'=>'Travel_Time_Rate_id']) !!}
                                            </li>
                                            <li>
                                                <?php
                                                    $get_Jobs_Travel_Time = str_replace("'", "", $job->Jobs_Travel_Time);
                                                ?>
                                                <label for="Estimated_Travel_Time_id">Estimated Travel Time:</label>
                                                {!! Form::text('Estimated_Travel_Time', $get_Jobs_Travel_Time, ['class' => 'form-control', 'id'=>'Estimated_Travel_Time_id']) !!}
                                            </li>
                                            <li>
                                                <?php
                                                    $get_Jobs_Travel_Time_Estimate_Cost = str_replace("'", "", $job->Jobs_Travel_Time_Estimate_Cost);
                                                ?>
                                                <label for="Estimated_Travel_Time_Fee_id">Estimated Travel Time Fee:</label>
                                                {!! Form::text('Estimated_Travel_Time_Fee', $get_Jobs_Travel_Time_Estimate_Cost, ['class' => 'form-control', 'id'=>'Estimated_Travel_Time_Fee_id']) !!}
                                            </li>
                                            <li>
                                                <?php
                                                    $get_Invoice_Date = setDateValueInView($job->Jobs_Invoice_Date);
                                                ?>
                                                <label for="invoice_date_datetimepicker">Invoice Date:</label>
                                                {!! Form::text('Invoice_Date', $get_Invoice_Date, ['class' => 'form-control', 'id'=>'invoice_date_datetimepicker']) !!}
                                            </li>
                                            <li>
                                                <?php
                                                    $get_Invoice_Acceptance_Date = setDateValueInView($job->Jobs_Invoice_Acceptance_Date);
                                                ?>
                                                <label for="invoice_acceptance_date_datetimepicker">Invoice Acceptance Date:</label>
                                                {!! Form::text('Invoice_Acceptance_Date', $get_Invoice_Acceptance_Date, ['class' => 'form-control', 'id'=>'invoice_acceptance_date_datetimepicker']) !!}
                                            </li>
                                            <li>
                                                <?php
                                                    $get_Jobs_Service_SubTotal_Estimate = str_replace("'", "", $job->Jobs_Service_SubTotal_Estimate);
                                                ?>
                                                <label for="SubTotal_Estimate_id">SubTotal Estimate:</label>
                                                {!! Form::text('SubTotal_Estimate', $get_Jobs_Service_SubTotal_Estimate, ['class' => 'form-control', 'id'=>'SubTotal_Estimate_id']) !!}
                                            </li>

                                            <li>
                                                <?php
                                                    $get_Jobs_Special_Request_Surcharge = str_replace("'", "", $job->Jobs_Special_Request_Surcharge);
                                                ?>
                                                <label for="Special_Request_Surcharge_id">Other Charges:</label>
                                                {!! Form::text('Special_Request_Surcharge', $get_Jobs_Special_Request_Surcharge, ['class' => 'form-control', 'id'=>'Special_Request_Surcharge_id']) !!}
                                            </li>

                                            <li>
                                                <?php
                                                    $get_Jobs_Special_Request_Surcharge_Total = str_replace("'", "", $job->Jobs_Special_Request_Surcharge_Total);
                                                ?>
                                                <label for="Special_Request_Surcharge_Total_id">Other Charges Total:</label>
                                                {!! Form::text('Special_Request_Surcharge_Total', $get_Jobs_Special_Request_Surcharge_Total, ['class' => 'form-control', 'id'=>'Special_Request_Surcharge_Total_id']) !!}
                                            </li>

                                            <li class="emphasised-li-2">
                                                <?php
                                                    $get_Jobs_Service_Total_Estimate = str_replace("'", "", $job->Jobs_Service_Total_Estimate);
                                                ?>
                                                <label for="Total_Estimate_id">Total Estimate:</label>
                                                {!! Form::text('Total_Estimate', $get_Jobs_Service_Total_Estimate, ['class' => 'form-control', 'id'=>'Total_Estimate_id']) !!}
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
                                                <?php
                                                    $get_Jobs_Assignment_Location = str_replace("'", "", $job->Jobs_Assignment_Location);
                                                ?>
                                                <label for="Assignment_Location_id">Assignment Location:</label>
                                                {!! Form::text('Assignment_Location', $get_Jobs_Assignment_Location, ['class' => 'form-control', 'id'=>'Assignment_Location_id']) !!}
                                            </li>
                                            <li>
                                                <?php
                                                    $get_Jobs_Assignment_Department = str_replace("'", "", $job->Jobs_Assignment_Department);
                                                ?>
                                                <label for="Assignment_Department_id">Assignment Department:</label>
                                                {!! Form::text('Assignment_Department', $get_Jobs_Assignment_Department, ['class' => 'form-control', 'id'=>'Assignment_Department_id']) !!}
                                            </li>
                                            <li>
                                                <?php
                                                    $get_Jobs_Assignment_Contact_Person = str_replace("'", "", $job->Jobs_Assignment_Contact_Person);
                                                ?>
                                                <label for="Assignment_Contact_Person_id">Assignment Contact Person:</label>
                                                {!! Form::text('Assignment_Contact_Person', $get_Jobs_Assignment_Contact_Person, ['class' => 'form-control', 'id'=>'Assignment_Contact_Person_id']) !!}
                                            </li>
                                            <li>
                                                <?php
                                                    $get_Jobs_Assignment_Provider_Name = str_replace("'", "", $job->Jobs_Assignment_Provider_Name);
                                                ?>
                                                <label for="Provider_Name_id">Provider Name:</label>
                                                {!! Form::text('Provider_Name', $get_Jobs_Assignment_Provider_Name, ['class' => 'form-control', 'id'=>'Provider_Name_id']) !!}
                                            </li>
                                            <li>
                                                <?php
                                                    $get_Jobs_Assignment_Phone_Number = str_replace("'", "", $job->Jobs_Assignment_Phone_Number);
                                                ?>
                                                <label for="Assignment_Phone_Number_id">Assignment Phone Number:</label>
                                                {!! Form::text('Assignment_Phone_Number', $get_Jobs_Assignment_Phone_Number, ['class' => 'form-control', 'id'=>'Assignment_Phone_Number_id']) !!}
                                            </li>
                                            <li>
                                                <?php
                                                    $get_Jobs_Assignment_Street_Address_1 = str_replace("'", "", $job->Jobs_Assignment_Street_Address_1);
                                                ?>
                                                <label for="Assignment_Street_Address_1_id">Assignment Street Address 1:</label>
                                                {!! Form::text('Assignment_Street_Address_1', $get_Jobs_Assignment_Street_Address_1, ['class' => 'form-control', 'id'=>'Assignment_Street_Address_1_id']) !!}
                                            </li>
                                            <li>
                                                <?php
                                                    $get_Jobs_Assignment_Street_Address_2 = str_replace("'", "", $job->Jobs_Assignment_Street_Address_2);
                                                ?>
                                                <label for="Assignment_Street_Address_2_id">Assignment Street Address 2:</label>
                                                {!! Form::text('Assignment_Street_Address_2', $get_Jobs_Assignment_Street_Address_2, ['class' => 'form-control', 'id'=>'Assignment_Street_Address_2_id']) !!}
                                            </li>
                                            <li>
                                                <?php
                                                    $get_Jobs_Assignment_City = str_replace("'", "", $job->Jobs_Assignment_City);
                                                ?>
                                                <label for="Jobs_Assignment_City_id">Assignment Address City:</label>
                                                {!! Form::text('Assignment_City', $get_Jobs_Assignment_City, ['class' => 'form-control', 'id'=>'Jobs_Assignment_City_id']) !!}
                                            </li>
                                            <li>
                                                <?php
                                                    $get_Jobs_Assignment_State = str_replace("'", "", $job->Jobs_Assignment_State);
                                                ?>
                                                <label for="Jobs_Assignment_State_id">Assignment Address State:</label>
                                                {!! Form::text('Assignment_State', $get_Jobs_Assignment_State, ['class' => 'form-control', 'id'=>'Jobs_Assignment_State_id']) !!}
                                            </li>
                                            <li>
                                                <?php
                                                    $get_Jobs_Assignment_Zip = str_replace("'", "", $job->Jobs_Assignment_Zip);
                                                ?>
                                                <label for="Jobs_Assignment_Zip_Code_id">Assignment Address Zip Code:</label>
                                                {!! Form::text('Assignment_Zip_Code', $get_Jobs_Assignment_Zip, ['class' => 'form-control', 'id'=>'Jobs_Assignment_Zip_Code_id']) !!}
                                            </li>
                                            <li>
                                                <?php
                                                    $get_Jobs_Assignment_Email = str_replace("'", "", $job->Jobs_Assignment_Email);
                                                ?>
                                                <label for="Jobs_Assignment_Email_id">Assignment Email:</label>
                                                {!! Form::text('Assignment_Email', $get_Jobs_Assignment_Email, ['class' => 'form-control', 'id'=>'Jobs_Assignment_Email_id']) !!}
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
                                                    <?php
                                                        $get_Jobs_Contractor_ID = str_replace("'", "", $job->Jobs_Contractor_ID);
                                                    ?>
                                                    <label for="Contractor_ID_id">Contractor ID:</label>
                                                    {!! Form::text('Contractor_ID', $get_Jobs_Contractor_ID, ['class' => 'form-control', 'id'=>'Contractor_ID_id']) !!} 
                                                </li>
                                                
                                                <div class="job-create-find-contractor">
                                                    Type contractor ID above and click find contractor to prefill the contractor details below.
                                                    <br/>
                                                    <a class="btn btn-primary job-create-find-contractor-btn" id="job-create-find-contractor-btn-id">Find Contractor</a>
                                                </div>

                                                <li>
                                                    <?php
                                                        $get_Jobs_Contractor_Email = str_replace("'", "", $job->Jobs_Contractor_Email);
                                                    ?>
                                                    <label for="Contractor_Email_id">Contractor Email:</label>
                                                    {!! Form::text('Contractor_Email', $get_Jobs_Contractor_Email, ['class' => 'form-control', 'id'=>'Contractor_Email_id']) !!}  
                                                </li>
                                                <li>
                                                    <?php
                                                        $get_Jobs_Contractor_Home_Phone = str_replace("'", "", $job->Jobs_Contractor_Home_Phone);
                                                    ?>
                                                    <label for="Contractor_Home_Phone_Number_id">Contractor Home Phone Number:</label>
                                                    {!! Form::text('Contractor_Home_Phone_Number', $get_Jobs_Contractor_Home_Phone, ['class' => 'form-control', 'id'=>'Contractor_Home_Phone_Number_id']) !!}   
                                                </li>
                                                <li>
                                                    <?php
                                                        $get_Jobs_Contractor_Cell_Phone = str_replace("'", "", $job->Jobs_Contractor_Cell_Phone);
                                                    ?>
                                                    <label for="Contractor_Cell_Phone_Number_id">Contractor Cell Phone Number:</label>
                                                    {!! Form::text('Contractor_Cell_Phone_Number', $get_Jobs_Contractor_Cell_Phone, ['class' => 'form-control', 'id'=>'Contractor_Cell_Phone_Number_id']) !!}   
                                                </li>
                                                <li>
                                                    <?php
                                                        $get_Jobs_Contractor_First_Name = str_replace("'", "", $job->Jobs_Contractor_First_Name);
                                                    ?>
                                                    <label for="Contractor_First_Name_id">Contractor First Name:</label>
                                                    {!! Form::text('Contractor_First_Name', $get_Jobs_Contractor_First_Name, ['class' => 'form-control', 'id'=>'Contractor_First_Name_id']) !!}  
                                                </li>
                                                <li>
                                                    <?php
                                                        $get_Jobs_Contractor_Last_Name = str_replace("'", "", $job->Jobs_Contractor_Last_Name);
                                                    ?>
                                                    <label for="Contractor_Last_Name_id">Contractor Last Name:</label>
                                                    {!! Form::text('Contractor_Last_Name', $get_Jobs_Contractor_Last_Name, ['class' => 'form-control', 'id'=>'Contractor_Last_Name_id']) !!}   
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
                                            <li class="backgrounded-li width100">
                                                <?php
                                                    $get_Job_Fullfillment_Notes = str_replace("'", "", $job->Job_Fullfillment_Notes);
                                                ?>
                                                <label for="Job_Fullfillment_Internal_Notes_id">Job Fullfillment & Internal Notes:</label>
                                                {!! Form::textarea('Job_Fullfillment_Internal_Notes', $get_Job_Fullfillment_Notes, ['class' => 'form-control', 'id'=>'Job_Fullfillment_Internal_Notes_id']) !!}
                                            </li>
                                            <li class="backgrounded-li width100">
                                                <?php
                                                    $get_Jobs_Notes = str_replace("'", "", $job->Jobs_Notes);
                                                ?>
                                                <label for="Job_Notes_id">Job Notes:</label>
                                                {!! Form::textarea('Job_Notes', $get_Jobs_Notes, ['class' => 'form-control', 'id'=>'Job_Notes_id']) !!}  
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
                                <!-- <h4 class="card-title crd-brdr">
                                    File Upload
                                </h4> -->

                                <div class="crd-job-details">
                                    <div class="single_job_view_img_cl_title">Attachment</div>
                                    <?php 
                                        processEchoFiles($job->Jobs_Attachments, true);

                                        // $get_file_name = removeQuotes($job->Jobs_Attachments);
                                        // $get_url = url('/storage/app/public/llcuploads') . "/" . $get_file_name;
                                        // echo "<a href='".$get_url."'>".$get_file_name."</a>";
                                        // echo "<input type='hidden' name='original_file_name'  value='". $get_file_name ."'>";
                                    ?>
                                    
                                    <br/>
                                    File(s) Upload:
                                     
                                    <!--<input type="file" name="job_create_contractor_file_upload[]" class="form-control" id="Input_Attachments_id" multiple>--> 
                            <div class="form-group">
                                <div class="dropzone clsbox border-dropzone" id="myDropzone" name="">
                                    {{csrf_field()}}
                                   
                                    <input type="hidden" name="edit_job_old_val" id="edit_job_old_val_id" value="<?php echo $job->Jobs_Attachments; ?>">
                                </div>
                             </div>
                                    <!-- <input type="hidden" name="edit_job_old_val" id="edit_job_old_val_id" value="<php echo $job->Jobs_Attachments; ?>">
                                    <br/> -->
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- </form> -->
            
            
            <div class="job_edit_result_text"></div>
            

            <div class="edit-job-submit-cl">
                {!! Form::submit('Save Changes', ['class' => 'btn btn-success btn-edit-save', 'id'=>'edit_job_id']) !!}
            </div>

            

            
            {!! Form::close() !!}

            <!-- end showing all job details -->

            <div class="row breadcrumbs-2">
                <?php
                    $next_job = $job->ID + 1;
                    $previous_job = $job->ID - 1;
                ?>
                <div class="col-md-6 breadcrumbs-2-prv">
                    <?php
                        if ( $job->ID == 1 ) {
                            //do nothing
                        } else {
                            //display it
                    ?>
                            <a href="{{url('/jobs/')}}/{{$previous_job}}">
                                <i class="fa fa-arrow-left"></i>Previous Job
                            </a>
                    <?php
                        }
                    ?>
                </div>
                <div class="col-md-6 breadcrumbs-2-nxt">
                    <a href="{{url('/jobs/')}}/{{$next_job}}">
                        Next Job <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
            </div>



            <script>
    var uploadedDocumentMap = {}; 

var AttachmentFile = <?php echo json_encode($job->Jobs_Attachments) ?>;
    //console.log(AttachmentFile);

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

            @endforeach
            
        </div>
    </div>
    <!-- Content Wrapper END -->
   

@endsection

