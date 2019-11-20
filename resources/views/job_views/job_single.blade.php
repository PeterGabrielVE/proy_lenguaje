@extends('layouts.app')

@section('content')
            
    @include('sidebar')

    @include('header')

    <!-- Content Wrapper START -->
    <div class="main-content">
        <div class="container-fluid">
            
            <!-- start job for each loop -->
            <?php
                // if the array returns no value
                if ( count($jobs) <= 0 ){
            ?>                    
                <div class='page-title'>
                    <h1 class='crd-job-single'>
                        No Job To Display
                    </h1>
                    <h3 style="text-align: center;">
                        <a href="{{url('/')}}">Return Home</a>    
                    </h3>                            
                </div>
            <?php
                }
            ?>


            @foreach ($jobs as $job)

             @if(Session::has('flash_message'))
                <div class="alert alert-success">
                    {{ Session::get('flash_message') }}
                </div>
            @endif
            
            

            <div class="page-title">
                <h1 class="crd-job-single">
                    <?php 
                        if ( strlen($job->Jobs_Job_Name) < 2 ){
                            echo "<span class='empty-job-name'><i class='fa fa-meh-o'></i> Empty Job Name</span>";
                        } else {
                            echo removeQuotes( $job->Jobs_Job_Name);
                        }
                    ?>
                </h1>

                <div class="breadcrumbs">
                    <div class="fa fa-hand-o-right"></div> 
                    You are here: 
                    <a href="{{url('/')}}">Home </a>
                        >
                    <a href="{{url('/jobs/')}}">All Jobs</a>
                        >
                    <a href="{{url('/jobs/')}}/{{$job->ID}}">Viewing Single Job</a>
                </div>

                
                
            </div>
             
              <div class="row">
                            <div class="col-md-12">
                                @include('job_views/job_navigation_horizontal')
                            </div>
                        </div>     

            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                            <div class="card">
                                <div class="card-heading border bottom">
                                    <h4 class="card-title crd-brdr">Job Details <i class="fa fa-briefcase"></i></h4>
                                    <div class="row crd-job-details">
                                        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                                        <!-- <div class="col-md-6 col-xs-12 col-sm-12 col-lg-6"> -->
                                            <ul class="job-details-ul">
                                                <li>Number/ID: <b>LLJB{{$job->ID}}</b></li>
                                                <li>
                                                    Status:
                                                    &nbsp;
                                                    <?php
                                                        echo  "<span class='job-field'><b>" . removeQuotes( $job->Jobs_Status) . "</b></span>";
                                                    ?>
                                                </li>
                                                <li>
                                                    Request Date:
                                                    <b>
                                                    &nbsp;
                                                    <?php
                                                        echo setDateValueInViewPretty($job->Job_Request_Date);
                                                    ?>
                                                    </b>
                                                </li>
                                                <li>
                                                    Type:
                                                    &nbsp;
                                                    <b>
                                                    <?php
                                                        echo removeQuotes( $job->Jobs_Type);
                                                    ?>
                                                    </b>
                                                </li>
                                                <li>
                                                    Language Requested:
                                                    &nbsp;
                                                    <b>
                                                    <?php
                                                        echo removeQuotes( $job->Jobs_Language_Requested);
                                                    ?>
                                                    </b>
                                                </li>
                                                <!-- <li> -->
                                                    <!-- Customer Number: -->
                                                    
                                                    <!-- <b> -->
                                                    <?php
                                                        //echo removeQuotes( $job->Jobs_Customers_Cus_Number);
                                                    ?>
                                                    <!-- </b> -->
                                                <!-- </li> -->
                                                <li>
                                                    Customer Company:
                                                    &nbsp;
                                                    <b>
                                                    <?php
                                                        if ( 
                                                            isset($job->Jobs_Customers_Company)
                                                            && ( intval($job->Jobs_Customers_Company) > 0 ) 
                                                        ){
                                                            echo removeQuotes(getCustomerNameWithID($job->Jobs_Customers_Company));     
                                                         } else {
                                                            // do nothing
                                                         }
                                                        //removeQuotes( $job->Jobs_Customers_Company);
                                                        
                                                    ?>
                                                    </b>
                                                </li>
                                                <li>
                                                    Requester Name:
                                                    &nbsp;
                                                    <b>
                                                    <?php
                                                        echo removeQuotes( $job->Jobs_Customers_First);
                                                    ?>
                                                    </b>    
                                                </li>
                                                <li>
                                                    LL Rep:
                                                    &nbsp;
                                                    <b>
                                                    <?php
                                                        echo removeQuotes( $job->Jobs_Customers_Last);
                                                    ?>
                                                    </b>
                                                </li>
                                                <!-- <li>
                                                    Service For:
                                                    &nbsp;
                                                    <b> -->
                                                    <?php
                                                        //echo removeQuotes( $job->Jobs_Service_Name);
                                                    ?>
                                                    <!-- </b>
                                                </li> -->
                                                <!-- <li>
                                                    Gender:
                                                    &nbsp;
                                                    <b> -->
                                                    <?php
                                                        //echo removeQuotes( $job->Jobs_Gender_Preference);
                                                    ?>
                                                    <!-- </b>
                                                </li> -->
                                            </ul>
                                        <!-- </div>
                                        <div class="col-md-6 col-xs-12 col-sm-12 col-lg-6"> -->
                                            <ul class="job-details-ul">
                                                <li>
                                                    Appointment Time:
                                                    &nbsp;
                                                    <b>
                                                    <?php
                                                        echo setDateValueInViewPretty($job->Jobs_Start_Time);
                                                    ?>
                                                    </b>
                                                </li>
                                                <li>
                                                    Appointment End Date/Time:
                                                    &nbsp;
                                                    <b>
                                                    <?php
                                                        echo setDateValueInViewPretty($job->Jobs_End_Time);
                                                    ?>
                                                    </b>
                                                </li>
                                                <li>
                                                    Start Working Date/Time:
                                                    &nbsp;
                                                    <b>
                                                    <?php
                                                        // echo $job->Jobs_Start_Working_Time; 
                                                        echo setDateValueInViewPretty($job->Jobs_Start_Working_Time);
                                                    ?>
                                                    </b>
                                                </li>
                                                <li>
                                                    Finish Working Date/Time:
                                                    &nbsp;
                                                    <b>
                                                    <?php
                                                        echo setDateValueInViewPretty($job->Jobs_Finish_Working_time);
                                                    ?>
                                                    </b>
                                                </li>
                                                <li>
                                                    Special Instructions:
                                                    &nbsp;
                                                    <b>
                                                    <?php
                                                        echo removeQuotes( $job->Jobs_Special_Request);
                                                    ?>
                                                    </b>
                                                </li>
                                                <li>
                                                    Customer PO Number:
                                                    &nbsp;
                                                    <b>
                                                    <?php
                                                        echo removeQuotes( $job->Jobs_Customers_PO_Number);
                                                    ?>
                                                    </b>
                                                </li>
                                                <li>
                                                    LEP Name:
                                                    &nbsp;
                                                    <b>
                                                    <?php
                                                        echo removeQuotes( $job->Jobs_LEP_Name);
                                                    ?>
                                                    </b>
                                                </li>
                                                <li>
                                                    LEP: Phone Number:
                                                    &nbsp;
                                                    <b>
                                                    <?php
                                                        echo removeQuotes( $job->Jobs_LEP_Phone);
                                                    ?>
                                                    </b>
                                                </li>
                                                <li>
                                                    <!-- Medical Record: -->
                                                    &nbsp;
                                                    <!-- <b> -->
                                                    <?php
                                                        //echo removeQuotes( $job->Job_Medical_Record_Number);
                                                    ?>
                                                    <!-- </b> -->
                                                </li>
                                                <li>
                                                    <!-- Court Record: -->
                                                    &nbsp;
                                                    <!-- <b> -->
                                                    <?php
                                                        //echo removeQuotes( $job->Jobs_Court_Record_Number);
                                                    ?>
                                                    <!-- </b> -->
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
                                            <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                                                <ul class="job-details-ul">
                                                    <li>
                                                        Service Requested: &nbsp;
                                                        <b>
                                                        <?php
                                                            echo removeQuotes( $job->Jobs_Service_Name);
                                                        ?>
                                                        </b>
                                                    </li>
                                                    <li>
                                                        Service Rate: &nbsp;
                                                        <b>
                                                        <?php
                                                            echo removeQuotes( $job->Jobs_Service_Name_Rate);
                                                        ?>
                                                        </b>
                                                    </li>
                                                    <li>
                                                        Service Code: &nbsp;
                                                        <b>
                                                        <?php
                                                            echo removeQuotes( $job->Jobs_Service_Code);
                                                        ?>
                                                        </b>
                                                    </li>
                                                    <li>
                                                        Estimated Service Hours: &nbsp;
                                                        <b>
                                                        <?php
                                                            echo removeQuotes( $job->Jobs_Service_Hours_Estimate);
                                                        ?>
                                                        </b>
                                                    </li>
                                                    <li>
                                                        Estimated Service Cost: &nbsp;
                                                        <b>
                                                        <?php
                                                            echo removeQuotes( $job->Jobs_Service_Hours_Estimate_Cost);
                                                        ?>
                                                        </b>
                                                    </li>
                                                    <li>
                                                        Mileage Code: &nbsp;
                                                        <b>
                                                        <?php
                                                            echo removeQuotes( $job->Jobs_Service_Mileage_Code);
                                                        ?>
                                                        </b>
                                                    </li>
                                                    <li>
                                                        Mileage Rate: &nbsp;
                                                        <b>
                                                        <?php
                                                            echo removeQuotes( $job->Jobs_Service_Mileage_Rate);
                                                        ?>
                                                        </b>
                                                    </li>
                                                    <li>
                                                        Estimated Miles: &nbsp;
                                                        <b>
                                                        <?php
                                                            echo removeQuotes( $job->Jobs_Service_Mileage_Estimate);
                                                        ?>
                                                        </b>
                                                    </li>
                                                    <li>
                                                        Estimated Mileage Cost: &nbsp;
                                                        <b>
                                                        <?php
                                                            echo removeQuotes( $job->Jobs_Service_Mileage_Cost_Estimate);
                                                        ?>
                                                        </b>
                                                    </li>
                                                    <li>
                                                        Travel Time Code: &nbsp;
                                                        <b>
                                                        <?php
                                                            echo removeQuotes( $job->Jobs_Travel_Time_Code);
                                                        ?>
                                                        </b>
                                                    </li>
                                                    <li>
                                                        Travel Time Rate: &nbsp;
                                                        <b>
                                                        <?php
                                                            echo removeQuotes( $job->Jobs_Travel_Time_Rate);
                                                        ?>
                                                        </b>
                                                    </li>
                                                    <li>
                                                        Travel Time: &nbsp;
                                                        <b>
                                                        <?php
                                                            echo removeQuotes( $job->Jobs_Travel_Time);
                                                        ?>
                                                        </b>
                                                    </li>
                                                    <li>
                                                        Estimated Travel Time Fee: &nbsp;
                                                        <b>
                                                        <?php
                                                            echo removeQuotes( $job->Jobs_Travel_Time_Estimate_Cost);
                                                        ?>
                                                        </b>
                                                    </li>

                                                    <li>
                                                        SubTotal Estimate: &nbsp;
                                                        <b>
                                                        <?php
                                                            echo removeQuotes( $job->Jobs_Service_SubTotal_Estimate);
                                                        ?>
                                                        </b>
                                                    </li>

                                                    <li>
                                                        Other Charges: &nbsp;
                                                        <b>
                                                        <?php
                                                            echo removeQuotes( $job->Jobs_Special_Request_Surcharge);
                                                        ?>
                                                        </b>
                                                    </li>
                                                    <li>
                                                        Other Charges Total: &nbsp;
                                                        <b>
                                                        <?php
                                                            echo removeQuotes( $job->Jobs_Special_Request_Surcharge_Total);
                                                        ?>
                                                        </b>
                                                    </li>
                                                    <li>
                                                        Invoice Date: &nbsp;
                                                        <b>
                                                        <?php
                                                            echo setDateValueInViewPretty( $job->Jobs_Invoice_Date);
                                                        ?>
                                                        </b>
                                                    </li>
                                                    <li>
                                                        Invoice Acceptance Date: &nbsp;
                                                        <b>
                                                        <?php
                                                            echo setDateValueInViewPretty( $job->Jobs_Invoice_Acceptance_Date);
                                                        ?>
                                                        </b>
                                                    </li>

                                                    <li class="emphasised-li">
                                                        Total Estimate: &nbsp;
                                                        
                                                        <?php
                                                            echo removeQuotes( $job->Jobs_Service_Total_Estimate);
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
                        
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                            <div class="card">
                                <div class="card-heading border bottom">
                                    <h4 class="card-title crd-brdr">
                                        Assignment Details
                                    </h4>
                                    <div class="row crd-job-details">
                                        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                                            <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                                                <ul class="job-details-ul">
                                                    <li>
                                                        Assignment Location: &nbsp;
                                                        <b>
                                                        <?php
                                                            echo removeQuotes( $job->Jobs_Assignment_Location);
                                                        ?>
                                                        </b>
                                                    </li>
                                                    <li>
                                                        Assignment Department: &nbsp;
                                                        <b>
                                                        <?php
                                                            echo removeQuotes( $job->Jobs_Assignment_Department);
                                                        ?>
                                                        </b>
                                                    </li>
                                                    <li>
                                                        Assignment Contact Person: &nbsp;
                                                        <b>
                                                        <?php
                                                            echo removeQuotes( $job->Jobs_Assignment_Contact_Person);
                                                        ?>
                                                        </b>
                                                    </li>
                                                    <li>
                                                        Provider Name: &nbsp;
                                                        <b>
                                                        <?php
                                                            echo removeQuotes( $job->Jobs_Assignment_Provider_Name);
                                                        ?>
                                                        </b>
                                                    </li>
                                                    <li>
                                                        Assignment Phone Number: &nbsp;
                                                        <b>
                                                        <?php
                                                            echo removeQuotes( $job->Jobs_Assignment_Phone_Number);
                                                        ?>
                                                        </b>
                                                    </li>
                                                    <li>
                                                        Assignment Street Address 1: &nbsp;
                                                        <b>
                                                        <?php
                                                            echo removeQuotes( $job->Jobs_Assignment_Street_Address_1);
                                                        ?>
                                                        </b>
                                                    </li>
                                                    <li>
                                                        Assignment Street Address 2: &nbsp;
                                                        <b>
                                                        <?php
                                                            echo removeQuotes( $job->Jobs_Assignment_Street_Address_2);
                                                        ?>
                                                        </b>
                                                    </li>
                                                    <li>
                                                        Assignment Address City: &nbsp;
                                                        <b>
                                                        <?php
                                                            echo removeQuotes( $job->Jobs_Assignment_City);
                                                        ?>
                                                        </b>
                                                    </li>
                                                    <li>
                                                        Assignment Address State: &nbsp;
                                                        <b>
                                                        <?php
                                                            echo removeQuotes( $job->Jobs_Assignment_State);
                                                        ?>
                                                        </b>
                                                    </li>
                                                    <li>
                                                        Assignment Address Zip Code: &nbsp;
                                                        <b>
                                                        <?php
                                                            echo removeQuotes( $job->Jobs_Assignment_Zip);
                                                        ?>
                                                        </b>
                                                    </li>
                                                    <li>
                                                        Assignment Email: &nbsp;
                                                        <b>
                                                        <?php
                                                            echo removeQuotes( $job->Jobs_Assignment_Email);
                                                        ?>
                                                        </b>
                                                    </li>
                                                </ul>
                                            </div>
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
                                        <div class="job-contractor-details-div">
                                            <ul class="job-details-ul">
                                                <li>
                                                    Contractor ID: &nbsp; 
                                                    <b>
                                                        <?php //echo getContractIDWithEmail($job->Jobs_Contractor_Email); ?>
                                                        
                                                        <?php //echo "<a target='_blank' href='".url('/contractors/'). "/" . ($job->Jobs_Contractor_ID) . "'>". ($job->Jobs_Contractor_ID) ."</a>" ; ?>
                                                        
                                                        <?php
                                                            $g_ctractor_id = processContractorID($job->Jobs_Contractor_ID, $job->Jobs_Contractor_Email);

                                                            if ( intval($g_ctractor_id) && is_numeric($g_ctractor_id) && (intval($g_ctractor_id) > 0) ){
                                                                echo "<a target='_blank' href='".url('/contractors/'). "/" . $g_ctractor_id . "'>". "LLCTR".$g_ctractor_id ."</a>";

                                                            } else {
                                                                echo "LLCTR".$g_ctractor_id;
                                                            }
                                                        ?>
                                                    </b>

            <?php
                // $get_the_email = \DB::connection()->getPDO()->quote($job->Jobs_Contractor_Email);
                


                // var_dump(getContractIDWithEmail($job->Jobs_Contractor_Email));

            ?>
                                                    <b>
                                                    <?php
                                                        // echo removeQuotes( $job->Jobs_Contractor_ID);
                                                    ?>
                                                    </b>    
                                                </li>
                                                <li>
                                                    Contractor Email: &nbsp;
                                                    <a href="mailto:<?php echo removeQuotes( $job->Jobs_Contractor_Email);?>"><b>
                                                    <?php
                                                        echo removeQuotes( $job->Jobs_Contractor_Email);
                                                    ?>
                                                    </b></a>
                                                </li>
                                                <li>
                                                    Contractor Home Phone Number: &nbsp;
                                                    <b>
                                                    <?php
                                                        echo removeQuotes( $job->Jobs_Contractor_Home_Phone);
                                                    ?>
                                                    </b>    
                                                </li>
                                                <li>
                                                    Contractor Cell Phone Number: &nbsp;
                                                    <b>
                                                    <?php
                                                        echo removeQuotes( $job->Jobs_Contractor_Cell_Phone);
                                                    ?>
                                                    </b>    
                                                </li>
                                                <li>
                                                    Contractor First Name: &nbsp;
                                                    <b>
                                                    <?php
                                                        echo removeQuotes( $job->Jobs_Contractor_First_Name);
                                                    ?>
                                                    </b>    
                                                </li>
                                                <li>
                                                    Contractor Last Name: &nbsp;
                                                    <b>
                                                    <?php
                                                        echo removeQuotes( $job->Jobs_Contractor_Last_Name);
                                                    ?>
                                                    </b>    
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
                                        Fullfillment/Internal Notes
                                    </h4>
                                    <div class="row crd-job-details">
                                        <ul class="job-details-ul" style="width: 100%;">
                                            <li class="backgrounded-li">
                                                Job Fullfillment & Internal Notes: <br/>
                                                <b>
                                                <?php
                                                    echo removeQuotes( $job->Job_Fullfillment_Notes);
                                                ?>
                                                </b>
                                            </li>
                                            <li class="backgrounded-li">
                                                Job Notes: &nbsp;
                                                <b>
                                                <?php
                                                    echo removeQuotes( $job->Jobs_Notes);
                                                ?>
                                                </b>    
                                            </li>
                                            <li>
                                                <div class="single_job_view_img_cl_title">Attachment</div>
                                                <?php 

                                                    // $get_url = url('/storage/app/public/llcuploads') . "/" . $get_file_name;
                                                    
                                                    processEchoFiles2($job->Jobs_Attachments, false);

                                                    // $all_returned_files = explode(",", removeQuotes($job->Jobs_Attachments));
                                                    // for ($i=0; $i < count($all_returned_files); $i++) { 
                                                    //     echo "<a href='". url('/storage/app/public/llcuploads') . "/" . $all_returned_files[$i] ."'>".$all_returned_files[$i]."</a>";
                                                    // }

                                                    // var_dump(  );

                                                    // $get_file_name = removeQuotes($job->Jobs_Attachments);
                                                    
                                                ?>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                            <div class="card">
                                <div class="show-job-by-cntrctor">
                                    <a class="btn btn-default wrap-input-box-text width-1-bx print-work-order-contrctr-frm" href="<?php echo url('/jobs/gencontractorform/') ."/" . removeQuotes($job->ID); ?>" target="_blank">
                                        Print Work Order - Contractor Assignment Form
                                    </a>

                                    <a class="btn btn-default wrap-input-box-text width-1-bx print-work-order-customer-frm" href="<?php echo url('/jobs/gencustomer/') ."/" . removeQuotes($job->ID); ?>" target="_blank">
                                        Print Work Order - Customer Form
                                    </a>

                                    <div class="line-divide"></div>

                                    <div style="color: #cc0404; max-width: 80%; margin: 20px auto 10px; font-weight: bold;">
                                        Note: When you click the "Send Email" button, it sends an email with a pdf attached to it, the pdf attached can be view when you click on the "Generate Form" button above.
                                    </div>

                                    <a class="btn btn-default wrap-input-box-text width-1-bx send-contractor-email" href="<?php echo url('/jobs/emailcontractor/') ."/" . removeQuotes($job->ID); ?>">
                                        Send Job To Contractor
                                    </a>

                                    <a class="btn btn-default wrap-input-box-text width-1-bx send-customer-email" href="<?php echo url('/jobs/emailcustomer/') ."/" . removeQuotes($job->ID); ?>">
                                        Send Customer Job Confirmation
                                    </a>

                                    <div class="line-divide"></div>

                                    <!-- Contractor Custom Email Message - START -->
                                    <div style="text-align: center;margin: 0 auto;">
                                        <b><u>Contractor Custom Email Message</u></b>
                                        <br/>
                                        Send contractor custom message. The Contractor Assignment Form will be sent automatically along with the email signature at the bottom of the message.
                                    </div>
                                    <?php
                                        echo Form::open(array('files'=>true, 'method'=>'GET', 'id'=>'email_contractor_manual_form_id'));
                                    ?> 
                                        <input type="hidden" name="" id="email_contractor_manual_form_id_url" value="<?php echo url('/jobs/emailcontractormanual/') ."/" . removeQuotes($job->ID); ?>">
                                        <br/>
                                        <label for="contractor_email_add_id">Email Address:</label>
                                        <input type="text" name="contractor_email_add" id="contractor_email_add_id" placeholder="email@domain.com" class="form-control">
                                        <br/>
                                        <label for="message_val_id">Message:</label>
                                        <textarea name="message_val" id="message_val_id" class="message_val_cl form-control" placeholder="message goes here..." style="min-height: 100px !important;"></textarea>
                                        <br/>
                                        <input type="submit" value="Send" class="btn btn-success message_val_btn_cl">
                                    </form>
                                    <div class="contractor_response_msg"></div>
                                    <!-- Contractor Custom Email Message - END -->

                                    <div class="line-divide"></div>

                                    <!-- Customer Custom Email Message - START -->
                                    <div style="text-align: center;margin: 0 auto;">
                                        <b><u>Customer Custom Email Message</u></b>
                                        <br/>
                                        Send customer custom message. The Customer Job confirmation will be sent automatically along with the email signature at the bottom of the message.
                                    </div>
                                    <?php
                                        echo Form::open(array('files'=>true, 'method'=>'GET', 'id'=>'email_customer_manual_form_id'));
                                    ?> 
                                        <input type="hidden" name="" id="email_customer_manual_form_id_url" value="<?php echo url('/jobs/emailcustomermanual/') ."/" . removeQuotes($job->ID); ?>">
                                        <br/>
                                        <label for="customer_email_add_id">Email Address:</label>
                                        <input type="email" name="customer_email_add" id="customer_email_add_id" placeholder="email@domain.com" class="form-control">
                                        <br/>
                                        <label for="customer_message_val_id">Message:</label>
                                        <textarea name="message_val" id="customer_message_val_id" class="message_val_cl form-control" placeholder="message goes here..." style="min-height: 100px !important;"></textarea>
                                        <br/>
                                        <input type="submit" value="Send" class="btn btn-success message_val_btn_cl">
                                    </form>
                                    <div class="customer_response_msg"></div>
                                    <!-- Customer Custom Email Message - END -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="single-job-edit">
                <ul class="list-unstyled list-inline text-right pdd-vertical-5">
                    <li class="list-inline-item">
                        <a href="{{url('/jobs/edit')}}/{{$job->ID}}" class="btn btn-flat btn-edit-cl"> 
                            <i class="fa fa-pencil"></i> Click Here To Edit Job
                        </a>
                    </li>
                </ul>
            </div>

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
                                <i class="fa fa-arrow-left"></i> Previous Job
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

            @endforeach
            <!-- end job for each loop -->
            
        </div>
    </div>
    <!-- Content Wrapper END -->

@endsection