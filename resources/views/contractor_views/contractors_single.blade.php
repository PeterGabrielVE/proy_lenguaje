@extends('layouts.app')

@section('content')
            
    @include('sidebar')

    @include('header')

    <!-- Content Wrapper START -->
    <div class="main-content">
        <div class="container-fluid">
        
            <?php
                // if the array returns no value
                if ( count($contractors) <= 0 ){
            ?>                    
                <div class='page-title'>
                    <h1 class='crd-job-single'>
                        No Contractor To Display
                    </h1>
                    <h3 style="text-align: center;">
                        <a href="{{url('/')}}">Return Home</a>    
                    </h3>                            
                </div>
            <?php
                }
            ?>

            @foreach ($contractors as $contractor)
        
            
            <div class="page-title">

                <h1 class="crd-job-single">
                    <?php 
                        if ( 
                               (strlen($contractor->Con_First_Name) <= 0 )
                            && (strlen($contractor->Con_Middle_Name) <= 0 )
                            && (strlen($contractor->Con_Last_Name) <= 0 )
                            ){
                            echo "<span class='empty-job-name'><i class='fa fa-meh-o'></i> Empty Contractor Name</span>";
                        } else {
                            echo removeQuotes($contractor->Con_First_Name);
                            echo " ";
                            echo removeQuotes($contractor->Con_Middle_Name);
                            echo " ";
                            echo removeQuotes($contractor->Con_Last_Name);

                        }
                    ?>
                </h1>

                <div class="breadcrumbs">
                    <div class="fa fa-hand-o-right"></div> 
                    You are here: 
                    <a href="{{url('/')}}">Home </a>
                        >
                    <a id="contractor_page_url" href="{{url('/contractors/')}}">All Contractors</a>
                    <div class="job_page_url" href="{{url('/jobs/')}}"></div> 
                        >
                    <a href="{{url('/contractors/')}}/{{$contractor->ID}}">Viewing Single Contractor</a>
                </div>

            </div>

            <div class="row">
                             @include('contractor_views/contractor_navigation_horizontal')
                        </div>

            <div class="row">
                
                <div class="col-md-12">
                    <!-- start displaying contractor details here -->
                    
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                            <div class="card">
                                <div class="card-heading border bottom">
                                    <h4 class="card-title crd-brdr">Contractor Details <i class="fa fa-user-times"></i></h4>
                                    <div class="row crd-job-details">
                                        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                                        <!-- <div class="col-md-6 col-xs-12 col-sm-12 col-lg-6"> -->
                                            <ul class="job-details-ul">
                                                <?php //returnTextForContractorSingleView("Contractor ID", $contractor->ID); ?>
                                                <li>
                                                Contractor ID: <b>LLCTR{{$contractor->ID}}</b>
                                                </li>
                                                

                                                <?php returnTextForContractorSingleView("Suffix", $contractor->Con_Suffix); ?>
                                                <?php returnTextForContractorSingleView("Title(s)", $contractor->Con_Title); ?>
                                                
                                                <?php //returnTextForContractorSingleView("First Name", $contractor->Con_First_Name); ?>
                                                <li>
                                                    Full Name:
                                                    <b>
                                                    <span class="contractor_first_name"><?php echo removeQuotes($contractor->Con_First_Name); ?></span>

                                                    
                                                    <span class="contractor_last_name"><?php echo removeQuotes($contractor->Con_Last_Name); ?></span>

                                                    </b>
                                                </li>




                                                <?php returnTextForContractorSingleView("Initial", $contractor->Con_Initial); ?>
                                                <br/>
                                                <?php returnTextForContractorSingleView("Decision DBA", $contractor->Con_DBA); ?>
                                                <?php returnTextForContractorSingleView("DBA Name", $contractor->Con_DBA_Name); ?>
                                                <?php returnTextForContractorSingleView("SSN", $contractor->Con_DBA_SSN); ?>
                                                <?php returnTextForContractorSingleView("Date Of Birthday", $contractor->Con_DBA_DBO); ?>
                                                <?php returnTextForContractorSingleView("Country of Origin", $contractor->Con_DBA_Country); ?>
                                                <br/>
                                                <?php returnTextForContractorSingleView("Physical Address ", $contractor->Con_Physical_Address); ?>
                                               
                                                <?php returnTextForContractorSingleView("City", $contractor->Con_City); ?>
                                                <?php returnTextForContractorSingleView("State", $contractor->Con_State); ?>
                                                <?php returnTextForContractorSingleView("Zip", $contractor->Con_Zip); ?>
                                                <?php returnTextForContractorSingleView("County", $contractor->Con_County); ?>
                                                <br/>
                                                 <?php returnTextForContractorSingleView("Mailing Address", $contractor->Con_Mailing_Address); ?>
                                               
                                                <?php returnTextForContractorSingleView("City", $contractor->Con_MA_City); ?>
                                                <?php returnTextForContractorSingleView("State", $contractor->Con_MA_State); ?>
                                                <?php returnTextForContractorSingleView("Zip", $contractor->Con_MA_Zip_Code); ?>
                                                <?php returnTextForContractorSingleView("County", $contractor->Con_MA_County); ?>
                                                <br/>

                                                <?php returnTextForContractorSingleView("Home Phone", $contractor->Con_Home_Phone); ?>
                                                <?php returnTextForContractorSingleView("Mobile 1", $contractor->Con_Cell_Phone); ?>
                                                <?php returnTextForContractorSingleView("Mobile 2", $contractor->Con_Cell_Phone2); ?>
                                                <?php returnTextForContractorSingleView("office", $contractor->Con_Office_Phone); ?>
                                                <?php returnTextForContractorSingleView("Fax", $contractor->Con_Fax_Phone); ?>
                                                <?php returnTextForContractorSingleView("Other", $contractor->Con_Other_Phone); ?>
                                                
                                                
                                              
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
                                    <h4 class="card-title crd-brdr">Contractor Details 2 <i class="fa fa-user-times"></i></h4>
                                    <div class="row crd-job-details">
                                        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                                            <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                                                <ul class="job-details-ul">


                                                <?php //returnTextForContractorSingleView("Email Address", $contractor->Con_E_mail_Address); ?>

                                                Email Address 1: <b>
                                                    <a target="_blank" href="mailto:<?php echo removeQuotes($contractor->Con_E_mail_Address);?>?subject=Language Link Inquiry About Job"><?php echo removeQuotes($contractor->Con_E_mail_Address);?></a>
                                                </b><br/>
                                                Email Address 2: <b>
                                                    <a target="_blank" href="mailto:<?php echo removeQuotes($contractor->Con_E_mail_Address_2);?>?subject=Language Link Inquiry About Job"><?php echo removeQuotes($contractor->Con_E_mail_Address_2);?></a>
                                                </b><br/>
                                                Email Address 3: <b>
                                                    <a target="_blank" href="mailto:<?php echo removeQuotes($contractor->Con_E_mail_Address_3);?>?subject=Language Link Inquiry About Job"><?php echo removeQuotes($contractor->Con_E_mail_Address_3);?></a>
                                                </b>
                                                
                        
                                                <?php returnTextForContractorSingleView("Skype", $contractor->Con_Skype); ?>
                                            
                                                Website: 
                                                <b>
                                                    <a target="_blank" href="<?php echo removeQuotes($contractor->Con_Website);?>"><?php echo removeQuotes($contractor->Con_Website);?></a>    
                                                </b>
                                                <?php //returnTextForContractorSingleView("Website", $contractor->Con_Website); ?>
                                                
                                                
                                                <?php returnTextForContractorSingleView("TaxID", $contractor->Con_TaxID); ?>
                                                
                                                
                                                <?php //returnTextForContractorSingleView("Birthdate", $contractor->Con_Birthdate); ?>

                                                <li>
                                                    Birthdate: <b> <?php echo setDateValueInViewPretty($contractor->Con_Birthdate); ?> </b>
                                                </li>

                                               
                                                <?php returnTextForContractorSingleView("Originating Country", $contractor->Con_Originating_Country); ?>
                                                <?php returnTextForContractorSingleView("Main Language", $contractor->Con_Language_1); ?>
                                                <?php returnTextForContractorSingleView("Afiliations", $contractor->Con_Afiliations); ?>
                                                <?php returnTextForContractorSingleView("Contractor An Agency?", $contractor->Con_Agency_YesNo); ?>
                                                <?php returnTextForContractorSingleView("Contractor Referred By", $contractor->Con_Referred_By); ?>
                                                 <?php returnTextForContractorSingleView("Referred By Interpreter", $contractor->Con_Referred_By_Name); ?>
                                                  <?php returnTextForContractorSingleView("Referred By Other", $contractor->Con_Referred_By_Other); ?>

                                                   <?php returnTextForContractorSingleView("Interpreter Status", $contractor->Con_Interpreter_Status); ?>
                                                <?php returnTextForContractorSingleView("Services", $contractor->Con_Services); ?>
                                                <?php returnTextForContractorSingleView("Training/Certifications", $contractor->Con_Training_Certifications); ?>
                                                <?php returnTextForContractorSingleView("Payment Method", $contractor->Con_Payment_Method); ?>
                                                 <?php returnTextForContractorSingleView("Is Payment?", $contractor->Con_Payment_Decision); ?>
                                              
                                                </ul>

                                                <div class="card">
                                                    <div class="card-heading border bottom">
                                                        <h4 class="card-title crd-brdr">
                                                            Fullfillment/Internal Notes
                                                        </h4>
                                                        <div class="row crd-job-details">
                                                            <ul class="job-details-ul minwidth100">
                                                                <?php returnTextForContractorSingleView2($contractor->Con_Notes); ?>
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
                    </div>
                        
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                            <div class="card">
                                <div class="card-heading border bottom">
                                    <h4 class="card-title crd-brdr">Contractor Details 3 <i class="fa fa-user-times"></i></h4>
                                    <div class="row crd-job-details">
                                        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                                            <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                                                <ul class="job-details-ul">
                                                    
                                                    <div class="card">
                                                        <div class="card-heading border bottom">
                                                            <h4 class="card-title crd-brdr">
                                                                Contractor Expertise
                                                            </h4>
                                                            <div class="row crd-job-details">
                                                                <ul class="job-details-ul minwidth100">
                                                                    <?php returnTextForContractorSingleView2($contractor->Con_Expertise); ?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <?php returnTextForContractorSingleView("Contractor Other Expertise", $contractor->Con_Expertise_Other); ?>
                                                    
                                                    <?php returnTextForContractorSingleView("Contractor Education Degree", $contractor->Con_Education_Degree); ?>

                                                    <?php returnTextForContractorSingleView("Contractor Education Major", $contractor->Con_Education_Major); ?>

                                                    <?php returnTextForContractorSingleView("Contractor Education Institution", $contractor->Con_Education_Institution); ?>

                                                    <?php returnTextForContractorSingleView("Contractor Education Country", $contractor->Con_Education_Country); ?>

                                                    <?php returnTextForContractorSingleView("Contractor Education Certifications", $contractor->Con_Education_Cetifications); ?>

                                                    <?php returnTextForContractorSingleView("Contractor Education Certifications Organization", $contractor->Con_Education_Certifications_Organization); ?>

                                                    <?php returnTextForContractorSingleView("Contractor Function Training", $contractor->Con_Function_Training); ?>
                                                    <?php returnTextForContractorSingleView("Contractor Services Offered", $contractor->Con_Services_Offered); ?>
                                                    <?php returnTextForContractorSingleView("Contractor Field of Expertise", $contractor->Con_Field_Expertise); ?>
                                                    <li>
                                                        <div class="single_job_view_img_cl_title">Certifications</div>
                                    <?php 
                                        processEchoFiles2($contractor->Con_Expertise_Certifications, false);
                                        
                                    ?>
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
                                    <h4 class="card-title crd-brdr">Contractor Jobs <i class="fa fa-briefcase"></i></h4>
                                    <div class="row crd-job-details">
                                        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                                            <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">                                                
                                                <div class="contractor_jobs_list">
                                                    <!-- <ul class="contractor_jobs_list_ul">

                                                    </ul> -->
                                                </div>

                                                <!-- <ul class="job-details-ul">
                                                    <li>
                                                        
                                                    </li>
                                                    
                                                </ul> -->
                                            </div>
                                        </div>
                                    </div>

                                    <hr/>
                                    
                                    <div class="single_job_view_img_cl_title">Attachment</div>
                                    <?php 
                                        processEchoFiles2($contractor->Con_Attachments, false);
                                        // $get_file_name = removeQuotes($contractor->Con_Attachments);
                                        // $get_url = url('/storage/app/public/llcuploads') . "/" . $get_file_name;
                                        // echo "<a href='".$get_url."'>".$get_file_name."</a>";
                                    ?>

                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                            <div class="card">
                                <div class="card-heading border bottom">
                                    <h4 class="card-title crd-brdr">
                                        Rate/Info
                                    </h4>
                                    <div class="row crd-job-details row-table-cl contractor-rate-tab">
                                        <ul class="contr-ul-list">
                                            <?php returnTextForContractorSingleView("Rate Interpreter Medical Per Hour", $contractor->Con_Rate_Interpret_Medical_PerHour); ?>

                                            <?php returnTextForContractorSingleView("Rate Interpreter Medical Minimum", $contractor->Con_Rate_Interpret_Medical_Minimum); ?>

                                            <?php returnTextForContractorSingleView("Rate Interpreter Medical Per Mile", $contractor->Con_Rate_Interpret_Medical_Mile); ?>

                                            <?php returnTextForContractorSingleView("Rate Interpreter Medical No Show", $contractor->Con_Rate_Interpret_Medical_NoShow); ?>

                                            <?php returnTextForContractorSingleView("Rate Interpreter Medical Cancelation (12,24,48 Hrs.)", $contractor->Con_Rate_Interpret_Medical_Cancelation); ?>

                                            <?php returnTextForContractorSingleView("Rate Interpreter Medical Rush", $contractor->Con_Rate_Interpret_Medical_Rush); ?>

                                            <?php returnTextForContractorSingleView("Rate Interpreter Medical Travel Time", $contractor->Con_Rate_Interpret_Medical_TravelTime); ?>

                                             <div class="card">
                                                        <div class="card-heading border bottom">
                                                            <h4 class="card-title crd-brdr">
                                                                Other:
                                                            </h4>
                                                           <div class="row crd-job-details">
                                                                <ul class="job-details-ul minwidth100">
                                                                    <?php returnTextForContractorSingleView2($contractor->Con_Rate_Interpret_Medical_Other); ?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                </div>

                                            <?php returnTextForContractorSingleView("Rate Interpreter Legal Per Hour", $contractor->Con_Rate_Interpret_Legal_PerHour); ?>

                                            <?php returnTextForContractorSingleView("Rate Interpreter Legal ½ Day (No. of Hours 3,4,5)", $contractor->Con_Rate_Interpret_Legal_Medium); ?>

                                            <?php returnTextForContractorSingleView("Rate Interpreter Legal Full Day (No. of Hours 6,7,8)", $contractor->Con_Rate_Interpret_Legal_FullDay); ?>

                                            <?php returnTextForContractorSingleView("Rate Interpreter Legal Per Mile", $contractor->Con_Rate_Interpret_Legal_PerMile); ?>

                                            <?php returnTextForContractorSingleView("Rate Interpreter Legal Cancelation (Per Hour)", $contractor->Con_Rate_Interpret_Legal_Cancelation_PerHour); ?>

                                            <?php returnTextForContractorSingleView("Rate Interpreter Legal Cancelation (1/2 Day)", $contractor->Con_Rate_Interpret_Legal_Cancelation_Medium); ?>
                                            
                                            <?php returnTextForContractorSingleView("Rate Interpreter Legal Cancelation (Full Day) Cancelation(12,24,48 Hrs.)", $contractor->Con_Rate_Interpret_Legal_Cancelation_FullDay); ?>

                                             <?php returnTextForContractorSingleView("Rate Interpreter Legal Travel Time", $contractor->Con_Rate_Interpret_Legal_TravelTime); ?>


                                            <?php returnTextForContractorSingleView("Rate Interpreter Legal No Show ½ Day", $contractor->Con_Rate_Interpret_Legal_NoShow_Medium); ?>

                                           <?php returnTextForContractorSingleView("Rate Interpreter Legal No Show Full Day", $contractor->Con_Rate_Interpret_Legal_NoShow_FullDay); ?>

                                             <div class="card">
                                                        <div class="card-heading border bottom">
                                                            <h4 class="card-title crd-brdr">
                                                                Other:
                                                            </h4>
                                                            <div class="row crd-job-details">
                                                                <ul class="job-details-ul minwidth100">
                                                                    <?php returnTextForContractorSingleView2($contractor->Con_Rate_Interpret_Legal_Other); ?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                </div>

                                            <?php returnTextForContractorSingleView("Rate Interpreter School Per Hour", $contractor->Con_Rate_Interpret_School_PerHour); ?>

                                            <?php returnTextForContractorSingleView("Rate Interpreter School Minimum", $contractor->Con_Rate_Interpret_School_Minimum); ?>

                                            <?php returnTextForContractorSingleView("Rate Interpreter School Per Mile", $contractor->Con_Rate_Interpret_School_PerMile); ?>

                                            <?php returnTextForContractorSingleView("Rate Interpreter School No Show", $contractor->Con_Rate_Interpret_School_NoShow); ?>

                                            <?php returnTextForContractorSingleView("Rate Interpreter School Cancelation (12,24,48 Hrs.)", $contractor->Con_Rate_Interpret_School_Cancelation); ?>

                                             <?php returnTextForContractorSingleView("Rate Interpreter School Travel Time", $contractor->Con_Rate_Interpret_School_TravelTime); ?>

                                            <?php returnTextForContractorSingleView("Rate Interpreter School Travel Time 2", $contractor->Con_Rate_Interpret_School_TravelTime_2); ?>

                                             <div class="card">
                                                        <div class="card-heading border bottom">
                                                            <h4 class="card-title crd-brdr">
                                                                Other:
                                                            </h4>
                                                           <div class="row crd-job-details">
                                                                <ul class="job-details-ul minwidth100">
                                                                    <?php returnTextForContractorSingleView2($contractor->Con_Rate_Interpret_School_Other); ?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                </div>    
                                            
                                            <?php returnTextForContractorSingleView("Rate Conference Per Hour", $contractor->Con_Rate_Conference_PerHour); ?>

                                            <?php returnTextForContractorSingleView("Rate Conference Minimum", $contractor->Con_Rate_Conference_Minimum); ?>

                                            <?php returnTextForContractorSingleView("Rate Conference Per Mile", $contractor->Con_Rate_Conference_Per_Mile); ?>

                                            <?php returnTextForContractorSingleView("Rate Conference ½ day (No. of Hours 5,6,7,8)", $contractor->Con_Rate_Conference_Medium); ?>

                                            <?php returnTextForContractorSingleView("Rate Conference Full Day (No. of Hours 6,7,8,9)", $contractor->Con_Rate_Conference_FullDay); ?>

                                             <?php returnTextForContractorSingleView("Rate Conference No Show", $contractor->Con_Rate_Conference_NoShow); ?>

                                            <?php returnTextForContractorSingleView("Rate Conference Cancelation(12,24,48 hrs.)", $contractor->Con_Rate_Conference_Cancelation); ?>

                                            <?php returnTextForContractorSingleView("Rate Conference Travel Time", $contractor->Con_Rate_Conference_TravelTime); ?>

                                             <div class="card">
                                                        <div class="card-heading border bottom">
                                                            <h4 class="card-title crd-brdr">
                                                                Other:
                                                            </h4>
                                                           <div class="row crd-job-details">
                                                                <ul class="job-details-ul minwidth100">
                                                                    <?php returnTextForContractorSingleView2($contractor->Con_Rate_Conference_Other); ?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                </div>

                                             <?php returnTextForContractorSingleView("Rate Video Remote Interpretation Per Minute", $contractor->Con_Rate_VRI_PerMinute); ?>   

                                            <?php returnTextForContractorSingleView("Rate Video Remote Interpretation Per Hour", $contractor->Con_Rate_VRI_PerHour); ?>

                                            <?php returnTextForContractorSingleView("Rate Video Remote Interpretation Minimum", $contractor->Con_Rate_VRI_Minimum); ?>

                                            <?php returnTextForContractorSingleView("Rate Video Remote Interpretation No Show", $contractor->Con_Rate_VRI_NoShow); ?>

                                            <?php returnTextForContractorSingleView("Rate Video Remote Interpretation Cancelation", $contractor->Con_Rate_VRI_Cancelation); ?>


                                             <div class="card">
                                                        <div class="card-heading border bottom">
                                                            <h4 class="card-title crd-brdr">
                                                                Other:
                                                            </h4>
                                                           <div class="row crd-job-details">
                                                                <ul class="job-details-ul minwidth100">
                                                                    <?php returnTextForContractorSingleView2($contractor->Con_Rate_VRI_Other); ?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                </div> 
                                              <?php returnTextForContractorSingleView("Rate Telephonic Per Minute", $contractor->Con_Rate_Telephonic_PerMinute); ?>   

                                            <?php returnTextForContractorSingleView("Rate Telephonic Per Hour", $contractor->Con_Rate_Telephonic_PerHour); ?>

                                            <?php returnTextForContractorSingleView("Rate Telephonic Minimum", $contractor->Con_Rate_Telephonic_Minimum); ?>

                                            <?php returnTextForContractorSingleView("Rate Telephonic No Show", $contractor->Con_Rate_Telephonic_NoShow); ?>

                                            <?php returnTextForContractorSingleView("Rate Telephonic Cancelation", $contractor->Con_Rate_Telephonic_Cancelation); ?>


                                             <div class="card">
                                                        <div class="card-heading border bottom">
                                                            <h4 class="card-title crd-brdr">
                                                                Other:
                                                            </h4>
                                                           <div class="row crd-job-details">
                                                                <ul class="job-details-ul minwidth100">
                                                                    <?php returnTextForContractorSingleView2($contractor->Con_Rate_Telephonic_Other); ?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                </div>

                                                <?php returnTextForContractorSingleView("Rate Translation Per Word", $contractor->Con_Rate_Translation_PerWord); ?>
                                                <?php returnTextForContractorSingleView("Rate Translation Per Page", $contractor->Con_Rate_Translation_PerPage); ?>
                                                 <?php returnTextForContractorSingleView("Rate Translation Per Hour", $contractor->Con_Rate_Translation_PerHour); ?>
                                                <?php returnTextForContractorSingleView("Rate Translation Repetition", $contractor->Con_Rate_Translation_Repetition); ?>

                                             <div class="card">
                                                        <div class="card-heading border bottom">
                                                            <h4 class="card-title crd-brdr">
                                                                RUSH JOBS:
                                                            </h4>
                                                           <div class="row crd-job-details">
                                                                <ul class="job-details-ul minwidth100">
                                                                    <?php returnTextForContractorSingleView2($contractor->Con_Rate_Translation_Rush); ?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                </div> 
                                                 <?php returnTextForContractorSingleView("Rate Translation Rush Per Word", $contractor->Con_Rate_Translation_RushPerWord); ?>
                                                <?php returnTextForContractorSingleView("Rate Translation Rush Per Page", $contractor->Con_Rate_Translation_RushPerPage); ?>
                                                 <?php returnTextForContractorSingleView("Rate Translation Rush Per Hour", $contractor->Con_Rate_Translation_RushPerHour); ?>
                                                <?php returnTextForContractorSingleView("Rate Translation Rush Repetition", $contractor->Con_Rate_Translation_RushRepetition); ?>
                                                <?php returnTextForContractorSingleView("Rate Translation Rush Minimum Charge", $contractor->Con_Rate_Translation_RushMinimum); ?>

                                                <?php returnTextForContractorSingleView("Rate Transcription Per Word", $contractor->Con_Rate_Transcription_PerWord); ?>
                                                <?php returnTextForContractorSingleView("Rate Transcription Per Page", $contractor->Con_Rate_Transcription_PerPage); ?>
                                                 <?php returnTextForContractorSingleView("Rate Transcription Per Hour", $contractor->Con_Rate_Transcription_PerHour); ?>
                                               

                                             <div class="card">
                                                        <div class="card-heading border bottom">
                                                            <h4 class="card-title crd-brdr">
                                                                RUSH JOBS:
                                                            </h4>
                                                           <div class="row crd-job-details">
                                                                <ul class="job-details-ul minwidth100">
                                                                    <?php returnTextForContractorSingleView2($contractor->Con_Rate_Transcription_Rush); ?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                </div> 
                                                 <?php returnTextForContractorSingleView("Rate Transcription Rush Per Word", $contractor->Con_Rate_Transcription_RushPerWord); ?>
                                                <?php returnTextForContractorSingleView("Rate Transcription Rush Per Page", $contractor->Con_Rate_Transcription_RushPerPage); ?>
                                                 <?php returnTextForContractorSingleView("Rate Transcription Rush Per Hour", $contractor->Con_Rate_Transcription_RushPerHour); ?>
                                                
                                                <?php returnTextForContractorSingleView("Rate Transcription Rush Minimum Charge", $contractor->Con_Rate_Transcription_RushMinimum); ?>
 
                                              <div class="card">
                                                        <div class="card-heading border bottom">
                                                            <h4 class="card-title crd-brdr">
                                                                OTHER:
                                                            </h4>
                                                           <div class="row crd-job-details">
                                                                <ul class="job-details-ul minwidth100">
                                                                    <?php returnTextForContractorSingleView2($contractor->Con_Rate_Transcription_Other); ?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                </div>
                                                 <div class="card">
                                                        <div class="card-heading border bottom">
                                                            <h4 class="card-title crd-brdr">
                                                                Rate Other Services:
                                                            </h4>
                                                           <div class="row crd-job-details">
                                                                <ul class="job-details-ul minwidth100">
                                                                    <?php returnTextForContractorSingleView2($contractor->Con_Rate_Other_Services); ?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                </div>
                                                <li>
                                            <div class="single_job_view_img_cl_title">Direct Deposit</div>
                                                <?php 
                                                    processEchoFiles2($contractor->Con_Rate_Depost, false);
                                                    
                                                ?>
                                                    </li> 
                                           
                                            <div class="card">
                                                <div class="card-heading border bottom">
                                                    <h4 class="card-title crd-brdr">
                                                        Contractor Rate Notes
                                                    </h4>
                                                    <div class="row crd-job-details">
                                                        <ul class="job-details-ul minwidth100">
                                                            <?php returnTextForContractorSingleView2($contractor->Con_Rate_Notes); ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </ul>
                                    </div>

                                    <div class="show-contractor-rate-tab-btn">Show Rates</div>
                                    <div class="hide-contractor-rate-tab-btn">Hide Rates</div>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                            <div class="card">
                                <div class="card-heading border bottom">
                                    <h4 class="card-title crd-brdr">
                                        Availability
                                    </h4>
                                    <div class="row crd-job-details">
                                        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                                            <div class="contractor-availability-tab-btn col-md-12 col-xs-12 col-sm-12 col-lg-12">
                                                <ul class="job-details-ul">
                                                    <li>
                                                        <ul class="job-details-ul">
                                                            
                                                            <?php returnTextForContractorSingleView("Contractor Availability Monday", $contractor->Con_Availability_Monday); ?>
                                                            
                                                            <?php returnTextForContractorSingleView("Contractor Availability Monday Start", $contractor->Con_Avaiability_Monday_Start); ?>
                                                            <?php returnTextForContractorSingleView("Contractor Availability Monday End", $contractor->Con_Avaiability_Monday_End); ?>
                                                        
                                                        </ul>
                                                        
                                                        <hr/>

                                                        <ul class="job-details-ul">
                                                            <?php returnTextForContractorSingleView("Contractor Availability Tuesday", $contractor->Con_Availability_Tuesday); ?>
                                                            
                                                            <?php returnTextForContractorSingleView("Contractor Availability Tuesday Start", $contractor->Con_Avaiability_Tuesday_Start); ?>
                                                            <?php returnTextForContractorSingleView("Contractor Availability Tuesday End", $contractor->Con_Avaiability_Tuesday_End); ?>
                                                        </ul>
                                                       
                                                        <hr/>

                                                        <ul class="job-details-ul">
                                                            <?php returnTextForContractorSingleView("Contractor Availability Wednesday", $contractor->Con_Availability_Wednesday); ?>
                                                            
                                                            <?php returnTextForContractorSingleView("Contractor Availability Wednesday Start", $contractor->Con_Avaiability_Wednesday_Start); ?>
                                                            <?php returnTextForContractorSingleView("Contractor Availability Wednesday End", $contractor->Con_Avaiability_Webnesday_End); ?>
                                                        </ul>
                                                       
                                                        <hr/>

                                                         <ul class="job-details-ul">
                                                            
                                                            <?php returnTextForContractorSingleView("Contractor Availability Thursday", $contractor->Con_Availability_Thursday); ?>
                                                            
                                                            <?php returnTextForContractorSingleView("Contractor Availability Thursday Start", $contractor->Con_Avaiability_Thursday_Start); ?>
                                                            <?php returnTextForContractorSingleView("Contractor Availability Thursday End", $contractor->Con_Avaiability_Thursday_End); ?>
                                                        
                                                        </ul>
                                                       
                                                        <hr/>

                                                        <ul class="job-details-ul">
                                                            
                                                            <?php returnTextForContractorSingleView("Contractor Availability Friday", $contractor->Con_Availability_Friday); ?>
                                                            
                                                            <?php returnTextForContractorSingleView("Contractor Availability Friday Start", $contractor->Con_Avaiability_Friday_Start); ?>
                                                            <?php returnTextForContractorSingleView("Contractor Availability Friday End", $contractor->Con_Avaiability_Friday_End); ?>
                                                        </ul>

                                                        <hr/>

                                                        <ul class="job-details-ul">
                                                            <?php returnTextForContractorSingleView("Contractor Availability Saturday", $contractor->Con_Availability_Saturday); ?>
                                                            
                                                            <?php returnTextForContractorSingleView("Contractor Availability Saturday Start", $contractor->Con_Avaiability_Saturday_Start); ?>
                                                            <?php returnTextForContractorSingleView("Contractor Availability Saturday End", $contractor->Con_Avaiability_Saturday_End); ?>
                                                        </ul>

                                                        <hr/>

                                                        <ul class="job-details-ul">
                                                            <?php returnTextForContractorSingleView("Contractor Availability Sunday", $contractor->Con_Availability_Sunday); ?>
                                                            
                                                            <?php returnTextForContractorSingleView("Contractor Availability Sunday Start", $contractor->Con_Avaiability_Sunday_Start); ?>
                                                            <?php returnTextForContractorSingleView("Contractor Availability Sunday End", $contractor->Con_Avaiability_Sunday_End); ?>
                                                            <li>
                                                            <div class="single_job_view_img_cl_title">Attachments:</div>
                                                                <?php 
                                                                    processEchoFiles2($contractor->Con_Attachments, false);
                                                                    
                                                                ?>
                                                             </li> 

                                                            <div class="card">
                                                                <div class="card-heading border bottom">
                                                                    <h4 class="card-title crd-brdr">
                                                                        Contractor Additional Info
                                                                    </h4>

                                                                    <div class="row crd-job-details">
                                                                        <ul class="job-details-ul minwidth100">
                                                                            <?php returnTextForContractorSingleView2($contractor->Con_Additional_Info); ?>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="show-contractor-availability-tab-btn">Show Availability</div>
                                    <div class="hide-contractor-availability-tab-btn">Hide Availability</div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end displaying contractor details here -->
                </div>
            </div>

            <div class="single-job-edit">
                <ul class="list-unstyled list-inline text-right pdd-vertical-5">
                    <li class="list-inline-item">
                        <a href="{{url('/contractors/edit')}}/{{$contractor->ID}}" class="btn btn-flat btn-edit-cl"> 
                            <i class="fa fa-pencil"></i> Click Here To Edit Contractor
                        </a>
                    </li>
                </ul>
            </div>

            <div class="row breadcrumbs-2">
                <?php
                    $next_con = $contractor->ID + 1;
                    $previous_con = $contractor->ID - 1;
                ?>
                <div class="col-md-6 breadcrumbs-2-prv">
                    <?php
                        if ( $contractor->ID == 1 ) {
                            //do nothing
                        } else {
                            //display it
                    ?>
                            <a href="{{url('/contractors/')}}/{{$previous_con}}">
                                <i class="fa fa-arrow-left"></i> Previous Contractor
                            </a>
                    <?php
                        }
                    ?>
                </div>
                <div class="col-md-6 breadcrumbs-2-nxt">
                    <a href="{{url('/contractors/')}}/{{$next_con}}">
                        Next Contractor <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            
            @endforeach

        </div>
    </div>
    <!-- Content Wrapper END -->

@endsection