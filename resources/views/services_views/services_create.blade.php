@extends('layouts.app')

@section('content')
            
    @include('sidebar')

    @include('header')

    <!-- Content Wrapper START -->
    <div class="main-content">
        <div class="container-fluid">
            
            <?php 
            echo Form::open(array('url'=>'services/create/', 'method'=>'PUT', 'id'=>'create_services_form_id', 'files'=>true));
            // echo Form::open(array('url'=>'services/create/', 'method'=>'PUT', 'files'=>true));
            ?>
            
            <div class="services_create_result_text"></div>
            
            <div class="page-title">
                <h1 class="crd-job-single">
                    <span class="crd-job-single-edit">You're creating a new service entry:</span>
                </h1>

                <div class="breadcrumbs">
                    <div class="fa fa-hand-o-right"></div> 
                    You are here: 
                    <a href="{{url('/')}}">Home </a>
                        >
                    <a href="{{url('/services/')}}">All Services</a>
                        >
                    <a class="create_services_page_url_a_cl" href="{{url('/services/create')}}">Create New Service</a>
                    <a class="all_services_page_url_a_cl" href="{{url('/services/')}}">Create New Service</a>
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
                                                <li>
                                                    <?php returnInputFieldForServiceCreateView("Service Name"); ?>
                                                </li>
                                                <li>
                                                    <?php returnInputFieldForServiceCreateView("Service State"); ?>
                                                </li>
                                                <li>
                                                    <?php returnInputFieldForServiceCreateView("Service Code"); ?>
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
                                                    <?php returnInputFieldForServiceCreateView("Service Rate"); ?>
                                                </li>
                                                <li class="select-cutmn">
                                                    <label for="Customer_Company_id">Customer Name:</label>

                                                    <select id="slctz-customers" name="Service_Customer_ID">
                                                        <option value="" disabled selected>Select Customer Company...</option>
                                                        <?php
                                                            $get_all_the_customers_from_db = \DB::select('SELECT ID, Cus_Company_Name FROM customers');
                                                            foreach ($get_all_the_customers_from_db as $key => $value) {
                                                                $get_array = get_object_vars($value);
                                                                $c_id = trim($get_array['ID']);
                                                                $c_name = trim($get_array['Cus_Company_Name']);
                                                                echo "<option id='job-cr8-cstmr' value='".$c_id."'>".$c_name."</option>";
                                                            }   
                                                        ?>
                                                    </select>

                                                </li>
                                                <li>
                                                    <label for="Service-Type-id">Service Type</label>
                                                    <select name="Service_Type" for="Service-Type-id">
                                                        <option value="Service">Service</option>
                                                        <option value="Mileage">Mileage</option>
                                                        <option value="Other">Other</option>
                                                    </select>
                                                    <?php //returnInputFieldForServiceCreateView("Service Type"); ?>
                                                </li>
                                                <li>
                                                    <h4 class="card-title crd-brdr">
                                                        File Upload
                                                    </h4>

                                                    <div class="crd-job-details">
                                                        File Upload:
                                                        <input type="file" name="create_service_file_upload[]" class="form-control" id="Input_Attachments_id" multiple>
                                                        <br/>
                                                    </div>
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

            <div class="services_create_result_text"></div>

            <div class="edit-job-submit-cl">
                {!! Form::submit('Create Service', ['class' => 'btn btn-success btn-edit-save', 'id'=>'create_service_id']) !!}
            </div>

            
            {!! Form::close() !!}
            
        </div>
    </div>
    <!-- Content Wrapper END -->

@endsection