@extends('layouts.app')

@section('content')
            
    @include('sidebar')

    @include('header')

    <style>
 
            .checkbox label{
                font-size:18px;
                font-weight: bold;
                text-decoration: underline;

            }


           .checkbox label:after, 
            .radio label:after {
            content: '';
            display: table;
            clear: both;
            font-size: 16px;
            }

        .checkbox .cr,
        .radio .cr {
            position: relative;
            display: inline-block;
            border: 1px solid #a9a9a9;
            border-radius: .25em;
            width: 1.3em;
            height: 1.3em;
            float: left;
            margin-right: .5em;
        }

        .radio .cr {
            border-radius: 50%;
        }

        .checkbox .cr .cr-icon,
        .radio .cr .cr-icon {
            position: absolute;
            font-size: .8em;
            line-height: 0;
            top: 50%;
            left: 20%;
        }

        .radio .cr .cr-icon {
            margin-left: 0.04em;
        }

        .checkbox label input[type="checkbox"],
        .radio label input[type="radio"] {
            display: none;
        }

        .checkbox label input[type="checkbox"] + .cr > .cr-icon,
        .radio label input[type="radio"] + .cr > .cr-icon {
            transform: scale(3) rotateZ(-20deg);
            opacity: 0;
            transition: all .3s ease-in;
        }

        .checkbox label input[type="checkbox"]:checked + .cr > .cr-icon,
        .radio label input[type="radio"]:checked + .cr > .cr-icon {
            transform: scale(1) rotateZ(0deg);
            opacity: 1;
        }

        .checkbox label input[type="checkbox"]:disabled + .cr,
        .radio label input[type="radio"]:disabled + .cr {
            opacity: .5;
        }
    </style>

  

    <!-- Content Wrapper START -->
    <div class="main-content">
        <div class="container-fluid">

            
             <div class="blue block">
                   <!-- Modal -->
                <div id="myModal" class="modal fade" role="dialog">
                  <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header btn-info">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"  style="margin: auto;">Message</h4>
                      </div>
                      <div class="modal-body">
                        <p>Select at least one title.</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                      </div>
                    </div>

                  </div>
                </div>
            </div>
            
            <?php 
               // echo Form::open(array('url'=>'contractors/create/', 'method'=>'PUT', 'id'=>'create_contractors_form_id'));
               echo Form::open(array('url'=>'contractors/create/', 'files'=>true, 'method'=>'PUT')); 
            ?>
            
            <div class="contractors_create_result_text"></div>
            
            <div class="page-title">
                <h1 class="crd-job-single">
                    <span class="crd-job-single-edit">You're creating a new contractor entry:</span>
                </h1>

                <div class="breadcrumbs">
                    <div class="fa fa-hand-o-right"></div> 
                    You are here: 
                    <a href="{{url('/')}}">Home </a>
                        
                    <a href="{{url('/contractors/')}}">All Contractors</a>
                        
                    <a class="create_contractors_page_url_a_cl" href="{{url('/contractors/create')}}">Create New Contractor</a>
                    <a class="all_contractors_page_url_a_cl" href="{{url('/contractors/')}}">Create New Contractor</a> 
                </div>
            </div>
    <!-- NAVBAR --->
            <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-details-1-tab" data-toggle="tab" href="#nav-details-1" role="tab" aria-controls="nav-details-1" aria-selected="true" style="padding-right:1px;padding-left: 2px;">Contractor Details</a>
                        <a class="nav-item nav-link" id="nav-details-2-tab" data-toggle="tab" href="#nav-details-2" role="tab" aria-controls="nav-details-2" aria-selected="false" style="padding-right:1px;padding-left: 2px;">Contractor Details 2</a>
                        <a class="nav-item nav-link" id="nav-details-3-tab" data-toggle="tab" href="#nav-details-3" role="tab" aria-controls="nav-details-3" aria-selected="false" style="padding-right:1px;padding-left: 2px;">Contractor Details 3</a>
                        <a class="nav-item nav-link" id="nav-rate-tab" data-toggle="tab" href="#nav-rate" role="tab" aria-controls="nav-rate" aria-selected="false" style="padding-right:1px;padding-left: 2px;">Rate/Info</a>
                        <a class="nav-item nav-link" id="nav-availability-tab" data-toggle="tab" href="#nav-availability" role="tab" aria-controls="nav-availability" aria-selected="false" style="padding-right:1px;padding-left: 2px;">Availability</a>
                        <a class="nav-item nav-link" id="nav-assined-tab" data-toggle="tab" href="#nav-assined" role="tab" aria-controls="nav-assined" aria-selected="false" style="padding-right:1px;padding-left: 2px;">Assined Jobs/Billing </a>
                    </div>
            </nav>

    <!-- NAVBAR --->

                <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                    
                    <!-- TABPANE DETAILS 1 -->

                    <div class="tab-pane fade show active" id="nav-details-1" role="tabpanel" aria-labelledby="nav-details-1-tab">

                        <h4 class="card-title crd-brdr">Contractor Details <i class="fa fa-user-times"></i> <a href="#" id="btn-toogle1" class="btn-toogle" ><i id="icon" class="fa fa-4x fa-plus-circle" aria-hidden="true" style="font-size:24px;"></i></a></h4>
                        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">


                             <ul class="job-details-ul">
                                               
                                                <li>
                                                    <div style="width: 28%;display: inline-block;">
                                                    <label style="width: 100% !important;" for="selectize-dropdown-job-type">Suffix:</label>
                                                </div>
                                                  <div style="width: 68%;display: inline-block;">
                                                    <select name="Suffix" id="selectize-dropdown-job-type" required>
                                                        <option value="Mr.">Mr.</option>
                                                        <option value="Mrs.">Mrs.</option>
                                                        <option value="Miss.">Miss.</option>
                                                        <option value="Other">Other</option>    
                                                    </select>
                                                </div>
                                                    
                                                </li>
                                                  <li>
                                                    <div style="width: 28%;display: inline-block;">
                                                    <label style="width: 100% !important;" for="selectize-dropdown-job-type">Title(s):</label>
                                                </div>
                                                  <div style="width: 68%;display: inline-block;">
                                              <select name="title[]" class="selectize-dropdown-contractor-title" id="selectize-dropdown-contractor-title" multiple="true">
                                                         <option value="CMI">CMI</option>          
                                                        <option value="CHI">CHI</option>
                                                        <option value="Court Cert.">Court Cert.</option>
                                                        <option value="FEDERALLY">Federally Cert.</option>
                                                        <option value="CDI">CDI</option>
                                                        <option value="CDS">CDS <option value="EIC">EIC</option>          
                                                        <option value="IC/TC">IC/TC</option>
                                                        <option value="NAD IV">NAD IV</option>
                                                        <option value="NIC ADVANCED">NIC ADVANCED</option>
                                                        <option value="OIC: S/V">OIC: S/V</option>
                                                        <option value="P DIC">P DIC</option>
                                                       <option value="SC:L">SC:L</option>
                                                        <option value="CI">CI<option value="ETC">ETC</option>          
                                                        <option value="MCSC">MCSC</option>
                                                        <option value="NAD V">NAD V</option>
                                                        <option value="NIC Master">NIC Master</option>
                                                        <option value=">OIC: V/S">OIC: V/S</option>
                                                        <option value="Prov.SC:L">Prov.SC:L</option>
                                                        <option value="SC:PA">SC:PA/</option>
                                                        <option value="CLIP">CLIP</option>
                                                        <option value="Ed: K-12">Ed: K-12</option>
                                                       <option value="NAD III">NAD III</option>
                                                    <option value="NIC">NIC</option><option value="OIC:C">OIC:C</option>          
                                                        <option value="OTC">OTC</option>
                                                        <option value="RSC">RSC</option>
                                                        <option value="TC Master">TC Master</option>
                                                        <option value="OTHER">OTHER</option>
                                                        
                                                    </select>                
                                                  </div>
                                                    
                                                </li>
                                                <li>
                                                    <?php returnInputFieldForContractorCreateView("Name"); ?>
                                                </li>
                                                <li>
                                                   <?php returnInputFieldForContractorCreateView("Initial"); ?>
                                                </li>
                                                <li>
                                                    <?php returnInputFieldForContractorCreateView("Last Name"); ?>
                                                </li>
                                                <br/>
                                                 <li>
                                                   <div class="mb-2 formulario"> 
                                                    <label for="contractor_interpreter">Is the interpreter working with a DBA? </label>
                                                               
                                                    <input type="radio" name="Decision_DBA" value="YES" id="yes" onchange="interpreterWithDBA(this.value)">
                                                    <label for="yes" class="label_radio">YES</label>
                                                   
                                                    <input type="radio" name="Decision_DBA" value="NO" id="no" onchange="interpreterWithDBA(this.value)">

                                                    <label class="label_radio" for="no">NO</label >
                                                    </div>

                                          </li>
                                        <div id="bdaInfo" style="display:none;">
                                            
                                       
                                <li id="bdaInfo1" name="DBA_Name" style=""> <?php returnInputFieldForContractorCreateView("DBA Name");?></li>
                                      <li id="bdaInfo2" name="SSN" style=""> <?php returnInputFieldForContractorCreateView("SSN"); ?></li>
                                      <li id="bdaInfo3" style=""><label for="date_of_birth">Date of Birth:</label>
                                                {!! Form::text('date_of_birth', ' ', ['class' => 'form-control', 'id'=>'date_of_birth']) !!}</li>
                                      <li id="bdaInfo4" style=""> <?php returnInputFieldForContractorCreateView("Country of Origin"); ?></li>
                                             </div>   
                                             <br/>
                                                <li>
                                                    <?php returnInputFieldForContractorCreateView("Physical Address"); ?>
                                                </li>
                                                <li>
                                                    <?php returnInputFieldForContractorCreateView("City"); ?>
                                                </li>
                                                <li>
                                                    <?php returnInputFieldForContractorCreateView("State"); ?>
                                                </li>
                                                <li>
                                                    <?php returnInputFieldForContractorCreateView("Zip Code"); ?>
                                                </li>
                                                <li>
                                                    <?php returnInputFieldForContractorCreateView("County"); ?>
                                                </li>
                                                <br/>
                                                 <li>
                                                    <?php returnInputFieldForContractorCreateView3("Mailing Address"); ?>
                                                </li>
                                                <li>
                                                    <?php returnInputFieldForContractorCreateViewMailing("City"); ?>
                                                </li>
                                                <li>
                                                    <?php returnInputFieldForContractorCreateViewMailing("State"); ?>
                                                </li>
                                                <li>
                                                    <?php returnInputFieldForContractorCreateViewMailing("Zip Code"); ?>
                                                </li>
                                                <li>
                                                    <?php returnInputFieldForContractorCreateViewMailing("County"); ?>
                                                </li>
                                                <li>
                                                 <div style="width: 28%;display: inline-block;">
                                                    <label style="width: 100% !important;" for="selectize-dropdown-job-type">Contact Info:</label>
                                                </div>
                                                  <div style="width: 68%;display: inline-block;">
                                                    <select name="contact_info" id="selectize-dropdown-job-type" onchange="contactOnChange(this)">
                                                        <option>Select Contact</option>
                                                        <option value="homePhone">Home Phone</option>
                                                        <option value="mobile1">Mobile 1</option>
                                                        <option value="mobile2">Mobile 2</option>
                                                        <option value="office">Office</option>
                                                         <option value="fax">Fax</option>
                                                         <option value="other">Other</option>
                                                    </select>
                                                </div>
                                                </li>
                                                <li id="homePhone" style="display: none;">
                                                    <?php returnInputFieldForContractorCreateView("Home Phone"); ?>
                                                    
                                                </li>
                                                <li id="mobile1" style="display: none;">
                                                   <?php returnInputFieldForContractorCreateView("Mobile 1"); ?>
                                                </li>
                                                <li id="mobile2" style="display: none;">
                                                   <?php returnInputFieldForContractorCreateView("Mobile 2"); ?>
                                                </li>  
                                                <li id="office" style="display: none;">
                                                    <?php returnInputFieldForContractorCreateView("Office"); ?>
                                                    
                                                </li>
                                                <li id="fax" style="display: none;">
                                                   <?php returnInputFieldForContractorCreateView("Fax"); ?>
                                                </li>
                                                <li id="other" style="display: none;">
                                                   <?php returnInputFieldForContractorCreateView("Other"); ?>
                                                </li>  
                                                <li>
                                                 <div style="width: 28%;display: inline-block;">
                                                    <label style="width: 100% !important;" for="selectize-dropdown-job-type">E-mail:</label>
                                                </div>
                                                  <div style="width: 68%;display: inline-block;">
                                                    <select name="e-mails" id="selectize-dropdown-job-type" onchange="emailOnChange(this)">
                                                        <option>Select E-mail</option>
                                                        <option value="email1">E-mail 1</option>
                                                        <option value="email2">E-mail 2</option>
                                                        <option value="email3">E-mail 3</option>
                                                        <option value="skype">Skype</option>
                                                         <option value="website">Website</option>
                                                        
                                                    </select>
                                                </div>
                                                </li>
                                                
                                                 <li id="email1" style="display: none;">
                                                    <?php returnInputFieldForContractorCreateView("E-mail 1"); ?>
                                                    
                                                </li>
                                                <li id="email2" style="display: none;">
                                                   <?php returnInputFieldForContractorCreateView("E-mail 2"); ?>
                                                </li>
                                                <li id="email3" style="display: none;">
                                                   <?php returnInputFieldForContractorCreateView("E-mail 3"); ?>
                                                </li>  
                                                <li id="skype" style="display: none;">
                                                    <?php returnInputFieldForContractorCreateView("Skype"); ?>
                                                    
                                                </li>
                                                <li id="website" style="display: none;">
                                                   <?php returnInputFieldForContractorCreateView("Web Site"); ?>
                                                </li>
                                               
 
                                            </ul>

                        </div>

                    </div>

                     <!-- TABPANE DETAILS 1 -->
                     <!-- TABPANE DETAILS 2 -->

                    <div class="tab-pane fade" id="nav-details-2" role="tabpanel" aria-labelledby="nav-details-2-tab">
                      <h4 class="card-title crd-brdr">Contractor Details 2 <i class="fa fa-user-times"> <a href="#" id="btn-toogle2" class="btn-toogle" ><i id="icon2" class="fa fa-plus-circle fa-5x" aria-hidden="true"></i></a></i></h4>

                       <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                                                <ul class="job-details-ul">

                                                     <?php returnInputFieldForContractorCreateViewLi("Afiliations"); ?>
                                                      <?php returnInputFieldForContractorCreateViewLi("Country
                                                      Of Origin"); ?>
                                                    <?php returnInputFieldForContractorCreateViewLi("DOB"); ?>
                                                    
                                                    <?php returnInputFieldForContractorCreateViewLi("TaxID"); ?>
                                                    <li>
                                                <div style="width: 28%;display:inline-block;">
                                                    <label style="width: 100% !important;" for="selectize-dropdown-job-type">How do you hear about us?</label>
                                                </div>
                                                  <div class="my-2" style="width: 68%;display: inline-block;">
                                                    <select name="referred[]" class="select_referred" multiple data-selected-text-format="count > 5">
                                                        
                                                        <option value="Referred by an interpreter">Referred by an interpreter </option>
                                                        <option value="Web Search">Web Search</option>
                                                        <option value="Facebook">Facebook</option>
                                                        <option value="Twitter">Twitter</option>
                                                        <option value="Linkedin">Linkedin</option>
                                                        <option value="Instagram">Instagram</option>
                                                        <option value="Other">Other</option>
                                                    </select>
                                                </div>
                                                    </li>

                                                    <div class="name_referred" style="display: none;">
                                                       <?php returnInputFieldForContractorCreateViewLi2("Name Interpreter"); ?>
                                                    </div>  
                                                    <div class="other_referred" style="display: none;">
                                                       <?php returnInputFieldForContractorCreateViewLi2("Other"); ?>
                                                    </div>  
                                                   <li>
                                                    <?php //returnInputFieldForContractorCreateView("Main Language"); ?>
                                                <div style="width: 28%;display: inline-block;">
                                                    <label style="width: 100% !important;" for="selectize-dropdown-job-type">Main Language:</label>
                                                </div>

                                                <div style="width: 68%;display: inline-block;">
                                                    <select name="language[]" class="selectpicker" multiple data-selected-text-format="count > 5">
                     
                                                        <?php
                                                            $get_all_the_languages_from_db = \DB::select('SELECT language FROM languages');
                                                            if ( isset($_GET['lang']) && strlen($_GET['lang']) > 2 && !empty($_GET['lang']) ) {
                                                                $get_the_language = $_GET['lang'];
                                                            } else{
                                                                $get_the_language = "";
                                                            }
                                                            foreach ($get_all_the_languages_from_db as $key => $value) {
                                                                $get_array = get_object_vars($value);
                                                                $language_trimmed = utf8_decode(trim($get_array['language']));
                                                                echo "<option value='". $language_trimmed ."'> ". $language_trimmed ."</option>";    
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                              </li> 
                                               <?php returnInputFieldForContractorCreateViewLi("Affiliations"); ?>
                                            </ul>
                                                <div style="width: 28%;display: inline-block;">
                                                    <label style="width: 100% !important;" for="selectize-dropdown-job-type">Interpreter Status:</label>
                                                </div>
                                                  <div class="my-2" style="width: 68%;display: inline-block;">
                                                    <select id="selectize-dropdown-job-type" name="Interpreter_Status">
                                                 
                                                        <option value="" disabled selected>Select a Status...</option>
                                                        <option value="Active">Active</option>
                                                        <option value="Inactive">Inactive</option>
                                                        <option value="Never Call or e-mail">Never Call or e-mail</option>
                                                        <option value="Unsubscribed">Unsubscribed</option>
                                                        
                                                    </select>
                                                </div>
                                                <div style="width: 28%;display: inline-block;">
                                                    <label style="width: 100% !important;" for="selectize-dropdown-job-type">Services:</label>
                                                </div>
                                                  <div class="my-2" style="width: 68%;display: inline-block;">
                                                    <select id="selectize-dropdown-job-type" name="Services">
                                                        <option value="" disabled selected>Select a service...</option>
                                                        <option value="INTERPRETATION">INTERPRETATION</option>
                                                        <option value="TRANSLATION">TRANSLATION</option>
                                                        <option value="VIDEO REMOTE INTERPRETATION (VRI)">VIDEO REMOTE INTERPRETATION (VRI)</option>
                                                        <option value="PROOFREADING">PROOFREADING</option>
                                                        <option value="VOICE OVER"> VOICE OVER</option>
                                                    </select>
                                                </div>
                                                  <div class="my-2" style="width: 28%;display: inline-block;">
                                                    <label style="width: 100% !important;" for="selectize-dropdown-job-type">Training/Certifications:</label>
                                                </div>
                                                  <div class="my-2" style="width: 68%;display: inline-block;">
                                                    <select id="selectize-dropdown-job-type" name="TrainingCertifications">
                                                        <option value="" disabled selected>Select a Training/Certifications...</option>
                                                        <option value="40 HR MEDICAL TRAINING">40 HR MEDICAL TRAINING</option>
                                                        <option value="40 HR COMMUNITY INTERPRETER">40 HR COMMUNITY INTERPRETER</option>
                                                        <option value="40 HR SCHOOL TRAINING">40 HR SCHOOL TRAINING</option>
                                                        <option value="OTHER SCHOOL TRAINING">OTHER SCHOOL TRAINING</option>
                                                        <option value="CMI">CMI</option>
                                                    </select>
                                                </div>
                                                 <div class="my-2" style="width: 28%;display: inline-block;">
                                                    <label style="width: 100% !important;" for="selectize-dropdown-job-type">Payment Method:</label>
                                                </div>
                                                  <div style="width: 68%;display: inline-block;">
                                                    <select id="selectize-dropdown-job-type" name="PaymentMethod">
                                                        <option value="" disabled selected>Select a Payment Method...</option>
                                                        <option value="CHECK">CHECK</option>
                                                        <option value="DIRECT">DIRECT</option>
                                                        <option value="DEPOSIT">DEPOSIT</option>
                                                        <option value="PAYPAL">PAYPAL</option>
                                                        <option value="OTHER">OTHER</option>
                                                    </select>
                                                </div>
                                          
                                                    <div class="mb-2 formulario"> 
                                                    <label for="payment_physical">Is payment sent to physical address?</label>
                                                               
                                                    <input type="radio" name="Decision_Payment" value="YES" id="yes_payment" >
                                                    <label for="yes_payment" class="label_radio">YES</label>
                                                   
                                                    <input type="radio" name="Decision_Payment" value="NO" id="no_payment">

                                                    <label class="label_radio" for="no_payment">NO</label >
                                                    </div>
                                             
                                                    </ul>
                                                

                                                <div class="card my-2">
                                                    <div class="card-heading border bottom">
                                                        <h4 class="card-title crd-brdr">
                                                          Notes
                                                        </h4>
                                                        <div class="row crd-job-details">
                                                            <ul class="job-details-ul minwidth100">
                                                                <li class="backgrounded-li width100">
                                                                    <?php returnTextareaFieldForContractorCreateView("Con Fullfillment Internal Note"); ?>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                </div>

                    </div>

                    <!-- TABPANE DETAILS 2 -->
                    <!-- TABPANE DETAILS 3 -->

                    <div class="tab-pane fade" id="nav-details-3" role="tabpanel" aria-labelledby="nav-details-3-tab">

                        <h4 class="card-title crd-brdr">Contractor Details 3 <i class="fa fa-user-times"></i><a href="#" id="btn-toogle3" class="btn-toogle" ><i id="icon3" class="fa fa-plus-circle fa-5x" aria-hidden="true"></i></a></h4>

                              <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">


                                                 <div class="card my-2">
                                                    <div class="card-heading border bottom">
                                                        <h4 class="card-title crd-brdr">
                                                          Contractor Expertise:
                                                        </h4>
                                                        <div class="row crd-job-details">
                                                            <ul class="job-details-ul minwidth100">
                                                                <li class="backgrounded-li width100">
                                                                    <?php returnTextareaFieldForContractorCreateView("Expertise"); ?>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>


                                                <ul class="job-details-ul">
                                                
                                                    <?php returnInputFieldForContractorCreateViewLi("Contractor Other Expertise"); ?>

                                                    <?php returnInputFieldForContractorCreateViewLi("Contractor Education Degree"); ?>

                                                    <?php returnInputFieldForContractorCreateViewLi("Contractor Education Major"); ?>
                                                    
                                                    <?php returnInputFieldForContractorCreateViewLi("Contractor Education Institution"); ?>

                                                    <?php returnInputFieldForContractorCreateViewLi("Contractor Education Country"); ?>

                                                    <?php returnInputFieldForContractorCreateViewLi("Contractor Education Certifications"); ?>

                                                    <?php returnInputFieldForContractorCreateViewLi("Contractor Education Certifications Organization"); ?>

                                                    <?php returnInputFieldForContractorCreateViewLi("Contractor Function Training"); ?>

                                                <div class="my-2" style="width: 28%;display: inline-block;">
                                                    <label style="width: 100% !important;" for="selectize-dropdown-job-type">Services Offered:</label>
                                                </div>
                                                  <div style="width: 68%;display: inline-block;">
                                                    <select id="selectize-dropdown-job-type" name="ServicesOffered">
                                                        <option value="" disabled selected>Select a Payment Services..</option>
                                                        <option value="Interpretation">Interpretation</option>
                                                        <option value="Only Translation">Only Translation</option>
                                                        <option value="Transportation">Transportation</option>
                                                        <option value="Voiceover">Voiceover</option>
                                                        <option value="Transcription">Transcription</option>
                                                        <option value="Subtiteling">Subtiteling</option>
                                                    </select>
                                                </div>
                                                    
                                        
                                                  
                                                  <div style="width: 28%;display: inline-block;">
                                                    <label style="width: 100% !important;" for="selectize-dropdown-job-type">Field of Expertise:</label>
                                                </div>
                                                  <div style="width: 68%;display: inline-block;">
                                                    <select  id="selectize-dropdown-expertise" name="FieldExpertise">
                                                       <optgroup> 
                                                        <option value="Any">Any</option>
                                                        </optgroup>
                                                        <optgroup label="___________________________________________">
                                                        <option value="Tech/Engineering">Tech/Engineering</option>
                                                        <option value="Art/Literacy">Art/Literacy</option>
                                                        <option value="Medical">Medical</option>
                                                        <option value="Law/Patents">Law/Patents</option>
                                                        <option value="Science">Science</option>
                                                        <option value="Bus/Financialy">Bus/Financial</option>
                                                        <option value="Marketing">Marketing</option>
                                                        <option value="Other">Other</option>
                                                        <option value="Social Science">Social Science</option>
                                                        </optgroup>

                                                       <optgroup label="____________________________________">
                                                        <option value="Accounting">Accounting</option>
                                                        <option value="Advertising/Public Relations">Advertising/Public Relations</option>
                                                        <option value="Aero Space/Aviation/Space">Aero Space/Aviation/Space</option>
                                                        <option value="Agriculture">Agriculture</option>
                                                        <option value="Anthropology">Anthropology</option>
                                                        <option value="Archaeology">Archaeology</option>
                                                        <option value="Architecture">Architecture</option>
                                                        <option value="Art/Arts & Crafts, Painting">Art/Arts & Crafts, Painting</option>
                                                        <option value="Astronomy Space">Astronomy Space</option>

                                                        <option value="Automation & Robotics">Automation & Robotics</option>
                                                        <option value="Automotive/ Cars & Trucks">Automotive/ Cars & Trucks</option>
                                                        <option value="Biology (-tech,-chem, micro-)">Biology (-tech,-chem, micro-)</option>
                                                        <option value="Botany">Botany</option>
                                                        <option value="Business/Commerce (general)">Business/Commerce (general)</option>
                                                        <option value="Certificates, Diplomas, Licenses, CVs">Certificates, Diplomas, Licenses, CVs</option>
                                                        <option value="Chemistry; Chem Sci/Eng">Chemistry; Chem Sci/Eng</option>
                                                        <option value="Cinema, Film, Drama, TV">Cinema, Film, Drama, TV</option>
                                                        <option value="Computers (general)">Computers (general)</option>

                                                         <option value="Computers: Hardware">Computers: Hardware</option>
                                                        <option value="Computers: software">Computers: software</option>
                                                        <option value="Computers: Systems, Networks">Computers: Systems, Networks</option>
                                                        <option value="Construction/Civil Engineering">Construction/Civil Engineering</option>

                                                        <option value="Cooking/Culinary">Cooking/Culinary</option>
                                                        <option value="Cosmetics/Beauty">Cosmetics/Beauty</option>
                                                        <option value="Economics">Economics</option>
                                                        <option value="Education/Pedagogy">Education/Pedagogy</option>
                                                        <option value="Electronics/Elect Eng">Electronics/Elect Eng</option>
                                                        
                                                        <option value="Energy/Power Generation">Energy/Power Generation</option>
                                                        <option value="Engineering (general)">Engineering (general)</option>
                                                        <option value="Engineering (Industrial)">Engineering (Industrial)</option>
                                                        <option value="Environmental & Ecology">Environmental & Ecology</option>
                                                        <option value="Esoteric Practices">Esoteric Practices</option>
                                                        <option value="Finance (general)">Finance (general)</option>
                                                        <option value="Fisheries">Fisheries</option>
                                                        <option value="Folklore">Folklore</option>
                                                        <option value="Food & Drink">Food & Drink</option>


                                                        <option value="Forestry/Wood/Timber">Forestry/Wood/Timber</option>
                                                        <option value="Furniture/Household Appliances">Furniture/Household Appliances</option>
                                                        <option value="Games/Video Games/Gaming/Casino">Games/Video Games/Gaming/Casino</option>
                                                        <option value="Genealogy">Genealogy</option>
                                                        <option value="General/Conversation/Greetings/Letters">General/Conversation/Greetings/Letters</option>
                                                        <option value="Genetics">Genetics</option>
                                                        <option value="Geography">Geography</option>
                                                        <option value="Geology">Geology</option>
                                                        <option value="Government/Politics">Government/Politics</option>
                                                        <option value="History">History</option>
                                                        <option value="Human Resources">Human Resources</option>
                                                        <option value="IT (Information Technology)">IT (Information Technology)</option>
                                                        <option value="Idioms/Maxims/Sayings">Idioms/Maxims/Sayings</option>
                                                        <option value="Insurance">Insurance</option>
                                                        <option value="International Org/Dev/Coop">International Org/Dev/Coop</option>
                                                        <option value="Internet, e-commerce">Internet, e-commerce</option>
                                                        <option value="Investment/Securities">Investment/Securities</option>
                                                        <option value="Journalism">Journalism</option>
                                                        <option value="Law: general">Law: general</option>
                                                        <option value="Law: contract (s)">Law: contract (s)</option>
                                                        <option value="Law: Patents, Trademarks, Copyright">Law: Patents, Trademarks, Copyright</option>
                                                        <option value="Law: Taxation & Customs">Law: Taxation & Customs</option>
                                                        <option value="Linguistics">Linguistics</option>
                                                        <option value="Livestock/Animal Husbandry">Livestock/Animal Husbandry</option>
                                                        <option value="Management">Management</option>
                                                        <option value="Manufacturing">Manufacturingy</option>
                                                        <option value="Marketing Research">Marketing Research</option>
                                                        <option value="Materials (Plastics, Ceramics, etc.)">Materials (Plastics, Ceramics, etc.)</option>
                                                        <option value="Mathematics & Statistics">Mathematics & Statistics</option>
                                                        <option value="Mechanics / Mech engineering">Mechanics / Mech engineering</option>
                                                        <option value="Media/Multimedia">Media/Multimedia</option>
                                                        <option value="Medical (general)">Medical (general)</option>
                                                        <option value="Medical: Cardiology">Medical: Cardiology</option>
                                                        <option value="Medical: Dentistry">Medical: Dentistry</option>
                                                        <option value="Medical: Healthcare">Medical: Healthcare</option>
                                                        <option value="Medical: Instruments">Medical: Instruments</option>

                                                        <option value="Medical: Pharmaceuticals">Medical: Pharmaceuticals</option>
                                                        <option value="Metallurgy / Casting">Metallurgy / Casting</option>
                                                        <option value="Meteorology">Meteorology</option>
                                                        <option value="Metrology">Metrology</option>
                                                        <option value="Military/Defense">Military/Defense</option>
                                                        <option value="Mining & Minerals / Gems">Mining & Minerals / Gems</option>
                                                        <option value="Music">Music</option>
                                                        <option value="Names (personal, company)">Names (personal, company)</option>
                                                        <option value="Nuclear Eng/Sci">Nuclear Eng/Sci</option>
                                                        <option value="Nutrition">Nutrition</option>
                                                        <!--<option value="Other">Other</option>-->
                                                        <option value="Paper / Paper Manufacturing">Paper / Paper Manufacturing</option>
                                                        <option value="Patents">Patents</option>
                                                        <option value="Petroleum Eng/Sci">Petroleum Eng/Sci</option>
                                                        <option value="Philosophy">Philosophy</option>
                                                        <option value="Photography/Imaging (& Graphic Arts)">Photography/Imaging (& Graphic Arts)</option>
                                                        <option value="Physics">Physics</option>
                                                        <option value="Poetry & Literature">Poetry & Literature</option>
                                                        <option value="Printing & Publishing">Printing & Publishing</option>
                                                        <option value="Psychology">Psychology</option>
                                                        <option value="Real Estate">Real Estate</option>
                                                        <option value="Religion">Religion</option>
                                                        <option value="Retail">Retail</option>
                                                        <option value="SAP">SAP</option>
                                                        <option value="Safety">Safety</option>
                                                        <option value="Science (general)">Science (general)</option>
                                                        <option value="Ships, Sailing, Maritime">Ships, Sailing, Maritime</option>
                                                        <option value="Slang">Slang</option>
                                                        <option value="Social Science, sociology, Ethics, Etc.">Social Science, sociology, Ethics, Etc.</option>
                                                        <option value="Sports/Fitness/Recreation">Sports/Fitness/Recreation</option>
                                                        <option value="Surveying">Surveying</option>
                                                        <option value="Telecom(munications)">Telecom(munications)</option>
                                                        <option value="Textiles/Clothing/Fashion">Textiles/Clothing/Fashion</option>
                                                        <option value="Tourism / Travel">Tourism / Travel</option>
                                                        <option value="Transport / Transportation / Shipping">Transport / Transportation / Shipping</option>
                                                        <option value="Wine / Oenology / Viticultures">Wine / Oenology / Viticulture</option>
                                                        <option value="Zoology">Zoology</option>
                                                       </optgroup>
                                                    </select>
                                                </div>
                                                <div style="width: 28%;display: inline-block;">
                                                    <label style="width: 100% !important;" for="selectize-dropdown-job-type">Certifications:</label>
                                                </div>
                                                   <div class="my-2" style="width: 68%;display: inline-block;">
                                                   <div class="dropzone clsbox border-dropzone" id="myDropzone" name="">
                                                        {{csrf_field()}}
                                                       
                                                    
                                                    </div>
                                                </div>
                                                   
                                                </ul>
                            </div>

                    </div>

                    <!-- TABPANE DETAILS 3 -->
                     <!-- TABPANE DETAILS 4 -->
                    <div class="tab-pane fade" id="nav-rate" role="tabpanel" aria-labelledby="nav-rate-tab">
                        <h4 class="card-title crd-brdr">Rate/Info <a href="#" id="btn-toogle4" class="btn-toogle" ><i id="icon4" class="fa fa-plus-circle fa-5x" aria-hidden="true"></i></a>
                        </h4>

                         <div class="container">
                                 <div class="row">
                                    <div class="col-12 col-md-12 col-lg-12 col-xl-12">  
                                                 <div style="width: 28%;display: inline-block;">
                                                    <label style="width: 100% !important;" for="selectize-dropdown-job-type">Select a Rate:</label>
                                                </div>
                                                  <div style="width: 68%;display: inline-block;">
                                                    <select name="contact_info" id="selectize-dropdown-job-type" onchange="rateOnChange(this)">
                                                        <option selected disabled>Select Rate</option>
                                                        <option value="ON-SITE INTERPRETATION">ON-SITE INTERPRETATION</option>
                                                        <option value="CONFERENCE">CONFERENCE</option>
                                                        <option value="VIDEO REMOTE INTERPRETATION (VRI)">VIDEO REMOTE INTERPRETATION (VRI)</option>
                                                        <option value="TELEPHONIC">TELEPHONIC</option>
                                                         <option value="TRANSLATION">TRANSLATION</option>
                                                         <option value="TRANSCRIPTION">TRANSCRIPTION </option>
                                                         <option value="Other Services">Other Services</option>
                                                       
                                                    </select>
                                                </div>
                                        </div>
                                    </div><br/>
                                        <div id="rate1" style="display: none">
                                            <div class="row">
                                             
                                                 <div class="col-sm-4">
                                                    <h4 class="card-title crd-brdr">
                                                    ON-SITE INTERPRETATION (Medical):   
                                                    </h4>

                                                    <ul class="contr-ul-list">

                                                    <?php returnInputFieldForContractorCreateViewLiRateMedical("Per Hour"); ?> 
                                                    <?php returnInputFieldForContractorCreateViewLiRateMedical("Minimum"); ?> 
                                                    <?php returnInputFieldForContractorCreateViewLiRateMedical("Per Mile"); ?>
                                                    <?php returnInputFieldForContractorCreateViewLiRateMedical("No Show"); ?> 
                                                    <?php returnInputFieldForContractorCreateViewLiRateMedicalCancelation("Cancelation(12,24,48 Hrs.)"); ?> 
                                                    <?php returnInputFieldForContractorCreateViewLiRateMedical("Rush"); ?>
                                                    <?php returnInputFieldForContractorCreateViewLiRateMedical("Travel Time"); ?> 
                                                     <li class="backgrounded-li width100">
                                                    <?php returnTextareaFieldForContractorCreateViewRate("Other"); ?>
                                                    </li>   

                                                    </ul>
                                               
                                                </div>
                                                 <div class="col-sm-4">
                                                    <h4 class="card-title crd-brdr">
                                                    (Legal):   
                                                    </h4><br/>

                                                    <ul class="contr-ul-list">

                                                    <?php returnInputFieldForContractorCreateViewLiRateLegal("Per Hour"); ?> 
                        
                                                    <?php returnInputFieldForContractorCreateViewLiRateLegalNoon("½ Day (No. of Hours 3,4,5)"); ?>
                                                    <?php returnInputFieldForContractorCreateViewLiRateLegalFullDay("Full Day (No. of Hours 6,7,8)"); ?>
                                                    <?php returnInputFieldForContractorCreateViewLiRateLegal("Per Mile"); ?>
                                                    <?php returnInputFieldForContractorCreateViewLiRateLegalCHour("Cancelation (Per Hour)"); ?>
                                                    <?php returnInputFieldForContractorCreateViewLiRateLegalCNoon("Cancelation (1/2 Day)"); ?>
                                                    <?php returnInputFieldForContractorCreateViewLiRateLegalCFullDay("Cancelation (Full Day) Cancelation(12,24,48 Hrs.)"); ?>
                                                    <?php returnInputFieldForContractorCreateViewLiRateLegal("Travel Time"); ?>       
                                                    <?php returnInputFieldForContractorCreateViewLiRateLegalNoShow("No Show ½ Day"); ?>  
                                                    <?php returnInputFieldForContractorCreateViewLiRateLegal("No Show Full Day"); ?>
                                                    <li class="backgrounded-li width100">
                                                    <?php returnTextareaFieldForContractorCreateViewRateLegal("Other"); ?>
                                                    </li> 

                                                    </ul>
                                               
                                                </div>
                                                <div class="col-sm-4">
                                                    <h4 class="card-title crd-brdr">
                                                    (School):   
                                                    </h4><br/>

                                                    <ul class="contr-ul-list">

                                                    <?php returnInputFieldForContractorCreateViewLiRateSchool("Per Hour"); ?> 
                                                    <?php returnInputFieldForContractorCreateViewLiRateSchool("Minimum"); ?> 
                                                    <?php returnInputFieldForContractorCreateViewLiRateSchool("Per Mile"); ?>
                                                    <?php returnInputFieldForContractorCreateViewLiRateSchool("No Show"); ?> 
                                                    <?php returnInputFieldForContractorCreateViewLiRateSchool("Cancelation"); ?> 
                                                    <?php returnInputFieldForContractorCreateViewLiRateSchool("Travel Time"); ?>
                                                    <?php returnInputFieldForContractorCreateViewLiRateSchool("Travel Time 2"); ?>
                                                    <li class="backgrounded-li width100">
                                                    <?php returnTextareaFieldForContractorCreateViewRateSchool("Other"); ?></li>    

                                                    </ul>
                                                   
                                                </div>
                                           
                                            </div>

                                    
                                        </div><!-- rates 1 -->
                                        
                                    <div class="row">
                                        
                                         <div class="col-sm-4" id="rate2" style="display:none;">
                                                <h4 class="card-title crd-brdr">
                                                CONFERENCE   
                                                </h4>

                                                <ul class="contr-ul-list">

                                                
                                                <?php returnInputFieldForContractorCreateViewLiRateConference("Per Hour"); ?> 
                                                <?php returnInputFieldForContractorCreateViewLiRateConference("Minimum"); ?> 
                                                <?php returnInputFieldForContractorCreateViewLiRateConference("Per Mile"); ?>
                                                <?php returnInputFieldForContractorCreateViewLiRateConferenceNoon("½ day (No. of Hours 5,6,7,8)"); ?> 
                                                <?php returnInputFieldForContractorCreateViewLiRateConferenceFullDay("Full Day (No. of Hours 6,7,8,9)"); ?> 
                                                <?php returnInputFieldForContractorCreateViewLiRateConference("No Show"); ?> 
                                                <?php returnInputFieldForContractorCreateViewLiRateConferenceCancelation("Cancelation(12,24,48 hrs.)"); ?> 
                                                <?php returnInputFieldForContractorCreateViewLiRateConference("Travel Time"); ?>
                                                <li class="backgrounded-li width100">
                                                <?php returnTextareaFieldForContractorCreateViewRateConference("Other"); ?></li>  

                                                </ul>   
                                            </div>
                                            <div class="col-sm-4" id="rate3" style="display:none;">
                                                <h4 class="card-title crd-brdr">
                                                 VIDEO REMOTE INTERPRETATION (VRI)    
                                                </h4>

                                                <ul class="contr-ul-list">

                                                <?php returnInputFieldForContractorCreateViewLiRateVRI("Per Minute"); ?>
                                                <?php returnInputFieldForContractorCreateViewLiRateVRI("Per Hour"); ?> 
                                                <?php returnInputFieldForContractorCreateViewLiRateVRI("Minimum"); ?> 
                                                <?php returnInputFieldForContractorCreateViewLiRateVRI("No Show"); ?> 
                                                <?php returnInputFieldForContractorCreateViewLiRateVRI("Cancelation"); ?> 
                                               <li class="backgrounded-li width100">
                                                <?php returnTextareaFieldForContractorCreateViewRateVRI("Other"); ?></li>    

                                                </ul>   
                                             </div>
                                             <div class="col-sm-4" id="rate4" style="display:none;">
                                                <h4 class="card-title crd-brdr">
                                                 TELEPHONIC  
                                                </h4>

                                                <ul class="contr-ul-list">

                                                <?php returnInputFieldForContractorCreateViewLiRateTelephonic("Per Minute"); ?>
                                                <?php returnInputFieldForContractorCreateViewLiRateTelephonic("Per Hour"); ?> 
                                                <?php returnInputFieldForContractorCreateViewLiRateTelephonic("Minimum"); ?> 
                                                <?php returnInputFieldForContractorCreateViewLiRateTelephonic("No Show"); ?> 
                                                <?php returnInputFieldForContractorCreateViewLiRateTelephonic("Cancelation"); ?> 
                                               <li class="backgrounded-li width100">
                                                <?php returnTextareaFieldForContractorCreateViewRateTelephonic("Other"); ?></li>   

                                                </ul>     
                                            </div>

                                    </div><!-- rates 2,3,4 -->
                                    <div class="row">
                                        
                                         <div class="col-sm-4" id="rate5" style="display:none;">
                                                <h4 class="card-title crd-brdr">
                                               TRANSLATION   
                                                </h4>

                                                <ul class="contr-ul-list">

                                                <?php returnInputFieldForContractorCreateViewLiRateTranslation("Per Word"); ?> 
                                                <?php returnInputFieldForContractorCreateViewLiRateTranslation("Per Page"); ?> 
                                                <?php returnInputFieldForContractorCreateViewLiRateTranslation("Per Hour"); ?>
                                                <?php returnInputFieldForContractorCreateViewLiRateTranslation("Repetition"); ?>
                                                <li class="backgrounded-li width100">
                                                <?php returnTextareaFieldForContractorCreateViewRateTranslation("RUSH JOBS"); ?></li>    
                                                <?php returnInputFieldForContractorCreateViewLiRateTranslationRush("Per Word"); ?> 
                                                <?php returnInputFieldForContractorCreateViewLiRateTranslationRush("Per Page"); ?> 
                                                <?php returnInputFieldForContractorCreateViewLiRateTranslationRush("Per Hour"); ?> 
                                                <?php returnInputFieldForContractorCreateViewLiRateTranslationRush("Repetition"); ?>
                                                <?php returnInputFieldForContractorCreateViewLiRateTranslationRush("Minimum Charge"); ?>
                                                 

                                                </ul>   
                                            </div>
                                            <div class="col-sm-4" id="rate6" style="display:none;">
                                                <h4 class="card-title crd-brdr">
                                                 TRANSCRIPTION     
                                                </h4>

                                                <ul class="contr-ul-list">

                                                <?php returnInputFieldForContractorCreateViewLiRateTranscription("Per Word"); ?> 
                                                <?php returnInputFieldForContractorCreateViewLiRateTranscription("Per Page"); ?> 
                                                <?php returnInputFieldForContractorCreateViewLiRateTranscription("Per Hour"); ?>
                                               
                                                <li class="backgrounded-li width100">
                                                <?php returnTextareaFieldForContractorCreateViewRateTranscrition("RUSH JOBS"); ?></li>    
                                                <?php returnInputFieldForContractorCreateViewLiRateTranscriptionRush("Per Word"); ?> 
                                                <?php returnInputFieldForContractorCreateViewLiRateTranscriptionRush("Per Page"); ?> 
                                                <?php returnInputFieldForContractorCreateViewLiRateTranscriptionRush("Per Hour"); ?> 
                                                <?php returnInputFieldForContractorCreateViewLiRateTranscriptionRush("Minimum Charge"); ?>
                                                 <li class="backgrounded-li width100">
                                                <?php returnTextareaFieldForContractorCreateViewRateTranscrition("Other"); ?></li>       

                                                </ul>   
                                             </div>
                                             <div class="col-sm-4" id="rate7" style="display:none;">
                                                <h4 class="card-title crd-brdr">
                                                Other Services: 
                                                </h4>

                                                <ul class="contr-ul-list">
                                                <li class="backgrounded-li width100">
                                                <?php returnTextareaFieldForContractorCreateViewRateOther("Other Services"); ?></li>     

                                                </ul>     
                                            </div>

                                    </div><!-- rates 2,3,4 -->
                                        
                                            <div style="width: 100%">
                                                <div class="my-2" style="width: 100%;display: inline-block;">
                                                    <label style="width: 100% !important;" for="selectize-dropdown-job-type">DIRECT DEPOSIT: If you are interested in taking advantage of our direct deposit option, complete the following fields and attach a copy of a void check.</label>
                                                </div>
                                                   <div class="my-auto" style="width: 70%;display: inline-block;margin-left: 15%;margin-right: 25%;">
                                                   <div class="dropzone clsbox border-dropzone" id="myDropzone2" name="">
                                                        {{csrf_field()}}
                                                       
                                                    
                                                    </div>
                                                </div>
                                       </div>

                                  
                                </div>
                            </div>

                    <!-- TABPANE DETAILS 4 -->
                     <!-- TABPANE DETAILS 5 -->        
             
                    <div class="tab-pane fade" id="nav-availability" role="tabpanel" aria-labelledby="nav-availability-tab">
                        <h4 class="card-title crd-brdr">Availability <a href="#" id="btn-toogle5" class="btn-toogle" ><i id="icon5" class="fa fa-plus-circle fa-5x" aria-hidden="true"></i></a>
                        </h4>

                         <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                              <div class="row">

                              <div class="col-md-6 col-xs-6 col-sm-6 col-lg-6">
                                  
                                    <ul class="job-details-ul">
                                                            <li><div class="checkbox">
                                                                <label>Monday
                                                                </label>
                                                                <label>
                                                                    <input name="check_day_monday" type="checkbox"  value="NO" id="check_day_monday">
                                                                    <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                                </label>
                                                            </div><br/>

                                                            <div id="content_monday" style="display: none;">
                                                            
                                                            <div><label for='contractor_Monday_Start_id'>Monday Start:</label>
                                                            <input type="text" name='contractor_Monday_Start' class='form-control' id='contractor_Monday_Start_id' style='width:120px;'>
                                                            </div><br/>
                                                            
                                                            <div><label for='contractor_Monday_End_id'>Monday End:</label>
                                                            <input type='text' name='contractor_Monday_End' class='form-control' id='contractor_Monday_End_id' style='width:120px;'>
                                                            </div><br/>

                                                            </div>

                                                            </li>
                                                            <li><div class="checkbox">
                                                                <label>Tuesday
                                                                </label>
                                                                <label>
                                                                    <input name="check_day_tuesday" type="checkbox"  value="NO" id="check_day_tuesday">
                                                                    <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                                </label>
                                                            </div>
                                                            <br/>

                                                            <div id="content_tuesday" style="display: none;">
                                                            
                                                            <div><label for='contractor_Tuesday_Start_id'>Tuesday Start:</label>
                                                            <input type="text" name='contractor_Tuesday_Start' class='form-control' id='contractor_Tuesday_Start_id' style='width:120px;'>
                                                            </div><br/>
                                                            
                                                            <div><label for='contractor_Tuesday_End_id'>Tuesday End:</label>
                                                            <input type='text' name='contractor_Tuesday_End' class='form-control' id='contractor_Tuesday_End_id' style='width:120px;'>
                                                            </div><br/>

                                                            </div>
                                                            </li>
                                                            <li><div class="checkbox">
                                                                <label>Wednesday
                                                                </label>
                                                                <label>
                                                                    <input name="check_day_wednesday" type="checkbox"  value="NO" id="check_day_wednesday">
                                                                    <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                                </label>
                                                            </div><br/>

                                                            <div id="content_wednesday" style="display: none;">
                                                            
                                                            <div><label for='contractor_Wednesday_Start_id'>Wednesday Start:</label>
                                                            <input type="text" name='contractor_Wednesday_Start' class='form-control' id='contractor_Wednesday_Start_id' style='width:120px;'>
                                                            </div><br/>
                                                            
                                                            <div><label for='contractor_Wednesday_End_id'>Wednesday End:</label>
                                                            <input type='text' name='contractor_Wednesday_End' class='form-control' id='contractor_Wednesday_End_id' style='width:120px;'>
                                                            </div><br/>

                                                            </div>
                                                            </li>
                                                    </ul>
                                                </div>
                                                  <div class="col-md-6 col-xs-6 col-sm-6 col-lg-6">
                                                    <ul class="job-details-ul">
                                                            <li><div class="checkbox">
                                                                <label>Thursday
                                                                </label>
                                                                <label >
                                                                    <input name="check_day_thursday" type="checkbox"  value="NO" id="check_day_thursday">
                                                                    <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                                </label>
                                                            </div><br/>

                                                            <div id="content_thursday" style="display: none;">
                                                            
                                                            <div><label for='contractor_Thursday_Start_id'>Thursday Start:</label>
                                                            <input type="text" name='contractor_Thursday_Start' class='form-control' id='contractor_Thursday_Start_id' style='width:120px;'>
                                                            </div><br/>
                                                            
                                                            <div><label for='contractor_Thursday_End_id'>Thursday End:</label>
                                                            <input type='text' name='contractor_Thursday_End' class='form-control' id='contractor_Thursday_End_id' style='width:120px;'>
                                                            </div><br/>

                                                            </div>
                                                            </li>
                                                            <li><div class="checkbox">
                                                                <label>Friday
                                                                </label>
                                                                <label>
                                                                    <input name="check_day_friday" type="checkbox"  value="NO" id="check_day_friday">
                                                                    <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                                </label>
                                                            </div><br/>

                                                            <div id="content_friday" style="display: none;">
                                                            
                                                            <div><label for='contractor_Friday_Start_id'>Friday Start:</label>
                                                            <input type="text" name='contractor_Friday_Start' class='form-control' id='contractor_Friday_Start_id' style='width:120px;'>
                                                            </div><br/>
                                                            
                                                            <div><label for='contractor_Friday_End_id'>Friday End:</label>
                                                            <input type='text' name='contractor_Friday_End' class='form-control' id='contractor_Friday_End_id' style='width:120px;'>
                                                            </div><br/>

                                                            </div>
                                                            </li>
                                            <div style="width: 28%;display: inline-block;">
                                                <label style="width: 100% !important;" for="selectize-dropdown-job-type">Attachments:</label>
                                            </div>
                                            <div class="my-2" style="width: 68%;display: inline-block;">
                                                <div class="dropzone clsbox border-dropzone" id="myDropzone3" name="">
                                                        {{csrf_field()}}
                                                </div>
                                            </div>
                                            <li class="backgrounded-li width100">
                                                <?php returnTextareaFieldForContractorCreateView("Additional Info"); ?></li>   


                                         </ul>
                                    </div>
                                </div>
                         </div>


                    </div>
                    <!-- TABPANE DETAILS 5 -->
                     <!-- TABPANE DETAILS 6 -->
                    <div class="tab-pane fade" id="nav-assined" role="tabpanel" aria-labelledby="nav-assined-tab">
                             <section id="tabs" class="project-tab">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Project Assigned Jobs</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Billing</a>
                               
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <table class="table" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Jobs_Status</th>
                                            <th>Job_Request_Date<th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><a href="#"># 1</a></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td><a href="#"># 2</a></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td><a href="#"># 3</a></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <table class="table" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Billing_Status</th>
                                            <th>Billing_Request_Date<th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><a href="#"># 1</a></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td><a href="#"># 2</a></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td><a href="#"># 3</a></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
                      
                    </div>
                    <!-- TABPANE DETAILS 6 -->
                     <!-- TABPANE DETAILS 7 -->
                    <div class="tab-pane fade" id="nav-aboutt" role="tabpanel" aria-labelledby="nav-aboutt-tab">
                      
                    </div>
                </div>
            <div class="row">
                <div class="container">

                    <div class="contractors_create_result_text"></div>

                    <div class="edit-job-submit-cl" >
                        {!! Form::submit('Create Contractor', ['class' => 'btn btn-success btn-edit-save', 'id'=>'create_contractor_id']) !!}
                    </div>
            
            
            {!! Form::close() !!}
            </div>
        </div>

   
    </div>
    <!-- Content Wrapper END -->
<script type="text/javascript">

    var selected = '';

    

   $(function(){

            titulo = $("#selectize-dropdown-contractor-title");


         
         $( "#create_contractor_id" ).click(function() {
           
            //alert(titulo.val());
            if(titulo.val()==null){
            
             $("#myModal").modal("show")
               
             return false;
            }
           
        });


         /*if(titulo != null) {
            alert("Debe Seleccionar una categoria");
            
            }*/


        $('#contractor_Monday_Start_id').timepicker({
             timeFormat: 'h:mm p',
            interval: 60,
            minTime: '00',
            maxTime: '11:00pm',
            defaultTime: '0',
            startTime: '00:00',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });

        $('#contractor_Monday_End_id').timepicker({
            timeFormat: 'h:mm p',
            interval: 60,
            minTime: '00',
            maxTime: '11:00pm',
            defaultTime: '12',
            startTime: '12:00',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });

        $('#contractor_Tuesday_Start_id').timepicker({
             timeFormat: 'h:mm p',
            interval: 60,
            minTime: '00',
            maxTime: '11:00pm',
            defaultTime: '0',
            startTime: '00:00',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });

        $('#contractor_Tuesday_End_id').timepicker({
            timeFormat: 'h:mm p',
            interval: 60,
            minTime: '00',
            maxTime: '11:00pm',
            defaultTime: '12',
            startTime: '12:00',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });

        $('#contractor_Wednesday_Start_id').timepicker({
             timeFormat: 'h:mm p',
            interval: 60,
            minTime: '00',
            maxTime: '11:00pm',
            defaultTime: '0',
            startTime: '00:00',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });

        $('#contractor_Wednesday_End_id').timepicker({
        timeFormat: 'h:mm p',
        interval: 60,
        minTime: '00',
        maxTime: '11:00pm',
        defaultTime: '12',
        startTime: '12:00',
        dynamic: false,
        dropdown: true,
        scrollbar: true
        });

        $('#contractor_Thursday_Start_id').timepicker({
             timeFormat: 'h:mm p',
            interval: 60,
            minTime: '00',
            maxTime: '11:00pm',
            defaultTime: '0',
            startTime: '00:00',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });

        $('#contractor_Thursday_End_id').timepicker({
        timeFormat: 'h:mm p',
        interval: 60,
        minTime: '00',
        maxTime: '11:00pm',
        defaultTime: '12',
        startTime: '12:00',
        dynamic: false,
        dropdown: true,
        scrollbar: true
        });

        $('#contractor_Friday_Start_id').timepicker({
             timeFormat: 'h:mm p',
            interval: 60,
            minTime: '00',
            maxTime: '11:00pm',
            defaultTime: '0',
            startTime: '00:00',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });

        $('#contractor_Friday_End_id').timepicker({
        timeFormat: 'h:mm p',
        interval: 60,
        minTime: '00',
        maxTime: '11:00pm',
        defaultTime: '12',
        startTime: '12:00',
        dynamic: false,
        dropdown: true,
        scrollbar: true
        });





        /*$('#contractor_Monday_End_id').timepicker({
            hourMin: 12,
            hourMax: 24,

        var fecha2 = new Date('1/1/1990 06:07');
        var fecha1 = new Date('1/1/1990 05:12');
 
        if(fecha2 <= fecha1) {return [false,'Hora final debe ser mayor a hora inicial']; }
         else {return [true,'']; }

            
        });*/



        $('.selectpicker').selectpicker({
      
            actionsBox: true,
            dropupAuto: true,
            size: 'auto',
            width: 500,

        });

         $('.selectpicker').change(function(){ 
            var arrayLanguage = $(this).val(); 
            console.log(arrayLanguage);

             var datosArray = arrayLanguage;
                datosArray = {'datos': datosArray};
                var dataString = JSON.stringify(datosArray);

                $.ajax({
                  headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },  
                  url: 'title',
                  type: 'POST',
                  dataType: 'json',
                  data: {data : dataString},
                  success: function(file, response) {
                      console.log(response);
                  },
                  error: function(data) {
                    console.log('error');
                  }
                 });

       

          });


        $('.select_referred').selectpicker({
      
            dropupAuto: true,
            size: 'auto',
            width: 500,

        });

         $('.select_referred').change(function(){ 
            var arrayReferred = $(this).val(); 
            interpreter ="Referred by an interpreter";
            other = "Other";

            console.log(arrayReferred);


            for (var i = 0; i < arrayReferred.length; i++) {

            
              if (interpreter == arrayReferred[i]) {
               //alert('Referred by a Interpreter');
               $('.name_referred').css('display','block');
                
              }
            
              if(other == arrayReferred[i]){
                //alert('Referred by a Other');
                 $('.other_referred').css('display','block');
               }

          }


             var datosArray = arrayReferred;
                datosArray = {'datos': datosArray};
                var dataString = JSON.stringify(datosArray);

                $.ajax({
                  headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },  
                  url: 'title',
                  type: 'POST',
                  dataType: 'json',
                  data: {data : dataString},
                  success: function(file, response) {
                      console.log(response);
                  },
                  error: function(data) {
                    console.log('error');
                  }
                 });

       

          });

      


         $('#selectize-dropdown-contractor-title').change(function(){ 
            var arr = $(this).val(); 
            console.log(arr);
              
                var datosArray = arr;
                datosArray = {'datos': datosArray};
                var dataString = JSON.stringify(datosArray);

                $.ajax({
                  headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },  
                  url: 'title',
                  type: 'POST',
                  dataType: 'json',
                  data: {data : dataString},
                  success: function(file, response) {
                      console.log(response);
                  },
                  error: function(data) {
                    console.log('error');
                  }
                 });

            });  

      });



var expanded = false;

function showCheckboxes() {
  var checkboxes = document.getElementById("checkboxes");
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}

var uploadedDocumentMap = {}; 
Dropzone.options.myDropzone =
         {
            headers: {
            //'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')'
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
             },
            url:"create/upload",
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
                 $('form').append('<input type="hidden" id="Input_Attachments_id" name="certification_create_contractor_file_upload[]" value="' + response.name + '"><br/>');
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

Dropzone.options.myDropzone2 =
         {
            headers: {
            //'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')'
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
             },
            url:"create/upload",
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
                 $('form').append('<input type="hidden" id="Input_Attachments_id" name="depost_create_contractor_file_upload[]" value="' + response.name + '"><br/>');
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

Dropzone.options.myDropzone3 =
         {
            headers: {
            //'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')'
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
             },
            url:"create/upload",
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
                 $('form').append('<input type="hidden" id="Input_Attachments_id" name="attachment_create_contractor_file_upload[]" value="' + response.name + '"><br/>');
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

