
@extends('layouts.app')

@section('content')
            
    @include('sidebar')

    @include('header')

    <!-- Content Wrapper START -->
    <div class="main-content">
        <div class="container-fluid">
            @foreach ($services_with_id as $service)

            <?php 
                echo Form::open(array('url'=>'services/edit/'.$service->ID, 'method'=>'PUT', 'files' => true, 'id'=>'edit_services_form_id'));
                // echo Form::open(array('url'=>'services/edit/'.$service->ID, 'method'=>'PUT', 'files' => true));
            ?>
            
            <div class="services_create_result_text"></div>
            
            <div class="page-title">
                <h1 class="crd-job-single">
                    <span class="crd-job-single-edit">You're editing a service:</span>
                    <br/>
                    <?php 
                        if ( 
                               (strlen($service->Service_Name) <= 0 )
                            ){
                            echo "<span class='empty-job-name'><i class='fa fa-meh-o'></i> Empty Service Name</span>";
                        } else {
                            echo removeQuotes($service->Service_Name);
                        }
                    ?>
                </h1>

                <div class="breadcrumbs">
                    <div class="fa fa-hand-o-right"></div> 
                    You are here: 
                    <a href="{{url('/')}}">Home </a>
                        >
                    <a class="all_services_page_url_a_cl" href="{{url('/services/')}}">Services</a>
                        >
                    <a class="edit_services_page_url_a_cl" href="{{url('/services/edit')}}/{{$service->ID}}">Edit Service</a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <!-- start displaying service details here -->
                    
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                            <div class="card">
                                <div class="card-heading border bottom">
                                    <h4 class="card-title crd-brdr">Service Details <i class="fa fa-user-times"></i></h4>
                                    <div class="row crd-job-details">
                                        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                                        <!-- <div class="col-md-6 col-xs-12 col-sm-12 col-lg-6"> -->
                                            <ul class="job-details-ul">

                                                <input type="hidden" name="service_id" 
                                                    value="<?php echo $service->ID; ?>">   
                                                <li>
                                                    <?php inputFieldServiceEditView("Service Name", $service->Service_Name); ?>
                                                </li>
                                                <li>
                                                    <?php inputFieldServiceEditView("Service State", $service->Service_State); ?>
                                                </li>
                                                <li>
                                                    <?php inputFieldServiceEditView("Service Code", $service->Service_Code); ?>
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
                                    <h4 class="card-title crd-brdr">Service Details 2 <i class="fa fa-user-times"></i></h4>
                                    <div class="row crd-job-details">
                                        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                                            <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                                                <ul class="job-details-ul">
                                                    <li>
                                                        <?php inputFieldServiceEditView("Service Rate", $service->Service_Rate); ?>
                                                    </li>
                                                    <li class="select-cutmn">
                                                        
                                                        <label>Customer Name:</label>
                                                        <?php //inputFieldServiceEditView("Service Customer Number", $service->Service_Cus_Number); ?>
                                                        
                                                        <input type="text" name="Customer_name" class="form-control" id="customer_name_id" value="<?php echo $service->Service_Cus_Number; ?>" disabled>
                                                        <input type="hidden" name="customer_id" value="<?php echo $service->customer_id; ?>">

                                                    </li>
                                                    <li>
                                                        <?php
                                                            // var_dump($service->Service_Type);
                                                        ?>
                                                        <label>Service Type</label>
                                                        
                                                        <?php
                                                            
                                                            if ( strval($service->Service_Type) === "Service" ) {
                                                                echo 
                                                                "<select name='Service_Type'> 
                                                                    <option value='Service'>Service</option>
                                                                    <option value='Mileage'>Mileage</option>
                                                                    <option value='Other'>Other</option>
                                                                </select> 
                                                                ";
                                                            } else if ( strval($service->Service_Type) == "Mileage") {
                                                                echo "
                                                                <select name='Service_Type'> 
                                                                    <option value='Mileage'>Mileage</option>
                                                                    <option value='Service'>Service</option>
                                                                    <option value='Other'>Other</option>
                                                                </select> 
                                                                ";
                                                            } else if ( $service->Service_Type === "Other" ) {
                                                                echo "
                                                                <select name='Service_Type'> 
                                                                    <option value='Other'>Other</option>
                                                                    <option value='Mileage'>Mileage</option>
                                                                    <option value='Service'>Service</option>
                                                                </select>
                                                                ";
                                                            } else {
                                                                echo 
                                                                "
                                                                <select name='Service_Type'> 
                                                                    <option value='".$service->Service_Type."'>".$service->Service_Type."</option>
                                                                    <option value='Mileage'>Mileage</option>
                                                                    <option value='Other'>Other</option>
                                                                </select>
                                                                ";
                                                            }
                                                            // $service->Service_Type
                                                            // $srv_type_arr = array("Service", "Mileage", "Other");

                                                            // for ($i=0; $i < count($srv_type_arr); $i++) { 
                                                                
                                                            // }
                                                            // var_dump($srv_type_arr);
                                                        ?>
                                                        <?php //inputFieldServiceEditView("Service Type", $service->Service_Type); ?>
                                                        </select>
                                                        

                                                    </li>

                                                     <li>
                                                        <div class="single_job_view_img_cl_title">Attachment</div>

                                                        File Upload:
                                                        <input type="file" name="edit_service_file_upload[]" class="form-control" id="Input_Attachments_id" multiple>
                                                        <br/>
                                                        <input type="hidden" name="edit_serv_old_vals" id="edit_serv_old_vals_id" value="<?php echo $service->attachments;?>">

                                                        <?php 
                                                            processEchoFiles($service->attachments, true);
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
                    <!-- end displaying service details here -->
                </div>
            </div>
            
            <div class="services_edit_result_text"></div>

            <div class="edit-job-submit-cl">
                {!! Form::submit('Save Changes', ['class' => 'btn btn-success btn-edit-save', 'id'=>'edit_service_id']) !!}
            </div>

            
            {!! Form::close() !!}

            <div class="row breadcrumbs-2">
                <?php
                    $next_service = $service->ID + 1;
                    $previous_service = $service->ID - 1;
                ?>
                <div class="col-md-6 breadcrumbs-2-prv">
                    <?php
                        if ( $service->ID == 1 ) {
                            //do nothing
                        } else {
                            //display it
                    ?>
                            <a href="{{url('/services/')}}/{{$previous_service}}">
                                <i class="fa fa-arrow-left"></i>Previous Service
                            </a>
                    <?php
                        }
                    ?>
                </div>
                <div class="col-md-6 breadcrumbs-2-nxt">
                    <a href="{{url('/services/')}}/{{$next_service}}">
                        Next Service <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            @endforeach
            
        </div>
    </div>
    <!-- Content Wrapper END -->

@endsection