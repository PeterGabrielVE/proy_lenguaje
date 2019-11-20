@extends('layouts.app')

@section('content')
            
    @include('sidebar')

    @include('header')

    <!-- Content Wrapper START -->
    <div class="main-content">
        <div class="container-fluid">
            
            <?php 
            // echo Form::open(array('url'=>'customers/create/', 'method'=>'PUT','files'=>true));
            echo Form::open(array('url'=>'customers/create/', 'method'=>'PUT', 'id'=>'create_customers_form_id', 'files'=>true));
            
            ?>
            
            <div class="customers_create_result_text"></div>
            
            <div class="page-title">
                <h1 class="crd-job-single">
                    <span class="crd-job-single-edit">You're creating a new customer entry:</span>
                </h1>

                <div class="breadcrumbs">
                    <div class="fa fa-hand-o-right"></div> 
                    You are here: 
                    <a href="{{url('/')}}">Home </a>
                        >
                    <a href="{{url('/customers/')}}">All Customers</a>
                        >
                    <a class="create_customers_page_url_a_cl" href="{{url('/customers/create')}}">Create New Customer</a>
                    <a class="all_customers_page_url_a_cl" href="{{url('/customers/')}}">Create New Customer</a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <!-- start displaying customer details here -->
                    
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                            <div class="card">
                                <div class="card-heading border bottom">
                                    <h4 class="card-title crd-brdr">Customer Details <i class="fa fa-user-times"></i></h4>
                                    <div class="row crd-job-details">
                                        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                                        <!-- <div class="col-md-6 col-xs-12 col-sm-12 col-lg-6"> -->
                                            <ul class="job-details-ul">
                                                <?php returnInputFieldForCreateViewLi("Customer First Name", "customer"); ?>
                                                <?php returnInputFieldForCreateViewLi("Customer Middle Name", "customer"); ?>
                                                <?php returnInputFieldForCreateViewLi("Customer Last Name", "customer"); ?>
                                                <?php returnInputFieldForCreateViewLi("Customer Company Name", "customer"); ?>
                                                <?php returnInputFieldForCreateViewLi("Customer Billing Street Address 1", "customer"); ?>
                                                <?php returnInputFieldForCreateViewLi("Customer Billing Street Address 2", "customer"); ?>
                                                <?php returnInputFieldForCreateViewLi("Customer Billing City", "customer"); ?>
                                                <?php returnInputFieldForCreateViewLi("Customer Billing State", "customer"); ?>
                                                <?php returnInputFieldForCreateViewLi("Customer Billing Zip", "customer"); ?>
                                                <?php returnInputFieldForCreateViewLi("Customer Notes", "customer"); ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>       
                        </div>
                        <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                            <div class="card">
                                <div class="card-heading border bottom">
                                    <h4 class="card-title crd-brdr">Customer Details 2 <i class="fa fa-user-times"></i></h4>
                                    <div class="row crd-job-details">
                                        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                                            <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                                                <ul class="job-details-ul">
                                                   <?php returnInputFieldForCreateViewLi("Customer Billing Notes", "customer"); ?>
                                                   <?php returnInputFieldForCreateViewLi("Customer Service", "customer"); ?>
                                                   <?php returnInputFieldForCreateViewLi("Customer Attachments", "customer"); ?>
                                                   <?php returnInputFieldForCreateViewLi("Customer Billing Term", "customer"); ?>
                                                   <?php returnInputFieldForCreateViewLi("Customer Phone Number", "customer"); ?>
                                                   <?php returnInputFieldForCreateViewLi("Customer Fax Number", "customer"); ?>
                                                   <?php returnInputFieldForCreateViewLi("Customer Phone Other", "customer"); ?>
                                                   <?php returnInputFieldForCreateViewLi("Customer WebSite", "customer"); ?>
                                                   <?php returnInputFieldForCreateViewLi("Customer Email Address", "customer"); ?>
                                                   <?php returnInputFieldForCreateViewLi("Customer LL Wiki", "customer"); ?>

                                                   <li>
                                                        <h4 class="card-title crd-brdr">
                                                            File Upload
                                                        </h4>

                                                        <div class="crd-job-details">
                                                            File Upload:
                                                            <input type="file" name="custmr_create_file_upload[]" class="form-control" id="Input_Attachments_id" multiple>
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
                        
                    <!-- end displaying customer details here -->
                </div>
            </div>

            <div class="customers_create_result_text"></div>

            <div class="edit-job-submit-cl">
                {!! Form::submit('Create Customer', ['class' => 'btn btn-success btn-edit-save', 'id'=>'create_customer_id']) !!}
            </div>

            
            {!! Form::close() !!}
            
        </div>
    </div>
    <!-- Content Wrapper END -->

@endsection