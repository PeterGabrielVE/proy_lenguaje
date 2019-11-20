@extends('layouts.app')

@section('content')
            
    @include('sidebar')

    @include('header')

    <!-- Content Wrapper START -->
    <div class="main-content">
        <div class="container-fluid">
            @foreach ($customers_with_id as $customer)

            <?php 
                // echo Form::open(array('url'=>'customers/edit/'.$customer->ID, 'method'=>'PUT', 'files'=>true ));
                echo Form::open(array('url'=>'customers/edit/'.$customer->ID, 'method'=>'PUT', 'id'=>'edit_customers_form_id', 'files'=>true ));
            ?>
            
            <div class="customers_edit_result_text"></div>
            
            <div class="page-title">
                <h1 class="crd-job-single">
                    <span class="crd-job-single-edit">You're editing a customer:</span>
                    <br/>
                    <?php 
                        if ( 
                               (strlen($customer->Cus_First_Name) <= 0 )
                            && (strlen($customer->Cus_Middle_Name) <= 0 )
                            && (strlen($customer->Cus_Last_Name) <= 0 )
                            ){
                            echo "<span class='empty-job-name'><i class='fa fa-meh-o'></i> Empty Customer Name</span>";
                        } else {
                            echo removeQuotes($customer->Cus_First_Name);
                            echo " ";
                            echo removeQuotes($customer->Cus_Middle_Name);
                            echo " ";
                            echo removeQuotes($customer->Cus_Last_Name);

                        }
                    ?>
                </h1>

                <div class="breadcrumbs">
                    <div class="fa fa-hand-o-right"></div> 
                    You are here: 
                    <a href="{{url('/')}}">Home </a>
                        >
                    <a class="all_customers_page_url_a_cl" href="{{url('/customers/')}}">Customers</a>
                        >
                    <a class="edit_customers_page_url_a_cl" href="{{url('/customers/edit')}}/{{$customer->ID}}">Edit Customer</a>
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

                                                <input type="hidden" name="customer_id" 
                                                    value="<?php echo $customer->ID; ?>">

                                                <?php inputFieldModelEditViewLi("Customer First Name", $customer->Cus_First_Name, "customer"); ?>
                                                <?php inputFieldModelEditViewLi("Customer Middle Name", $customer->Cus_Middle_Name, "customer"); ?>
                                                <?php inputFieldModelEditViewLi("Customer Last Name", $customer->Cus_Last_Name, "customer"); ?>
                                                <?php inputFieldModelEditViewLi("Customer Company Name", $customer->Cus_Company_Name, "customer"); ?>
                                                <?php inputFieldModelEditViewLi("Customer Billing Street Address 1", $customer->Cus_Billing_Street_Address_1, "customer"); ?>
                                                <?php inputFieldModelEditViewLi("Customer Billing Street Address 2", $customer->Cus_Billing_Street_Address_2, "customer"); ?>
                                                <?php inputFieldModelEditViewLi("Customer Billing City", $customer->Cus_Billing_City, "customer"); ?>
                                                <?php inputFieldModelEditViewLi("Customer Billing State", $customer->Cus_Billing_State, "customer"); ?>
                                                <?php inputFieldModelEditViewLi("Customer Billing Zip", $customer->Cus_Billing_Zip, "customer"); ?>
                                                <?php inputFieldModelEditViewLi("Customer Notes", $customer->Cus_Notes, "customer"); ?>
                                                
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
                                                    <?php inputFieldModelEditViewLi("Customer Billing Notes", $customer->Cus_Billing_Notes, "customer"); ?>
                                                    <?php inputFieldModelEditViewLi("Customer Service", $customer->Cus_Service, "customer"); ?>
                                                    <?php inputFieldModelEditViewLi("Customer Attachments", $customer->Cus_Attachments, "customer"); ?>
                                                    <?php inputFieldModelEditViewLi("Customer Billing Term", $customer->Cus_Billing_Term, "customer"); ?>
                                                    <?php inputFieldModelEditViewLi("Customer Phone Number", $customer->Cus_Phone_Number, "customer"); ?>
                                                    <?php inputFieldModelEditViewLi("Customer Fax Number", $customer->Cus_Fax_Number, "customer"); ?>
                                                    <?php inputFieldModelEditViewLi("Customer Phone Other", $customer->Cus_Phone_Other, "customer"); ?>
                                                    <?php inputFieldModelEditViewLi("Customer WebSite", $customer->Cus_WebSite, "customer"); ?>
                                                    <?php inputFieldModelEditViewLi("Customer Email Address", $customer->Cus_Email_Address, "customer"); ?>
                                                    <?php inputFieldModelEditViewLi("Customer LL Wiki", $customer->Cus_LL_Wiki, "customer"); ?>
                                                    <li>
                                                        <div class="single_job_view_img_cl_title">Attachment</div>
                                                        <?php 
                                                            processEchoFiles($customer->attachments, true);
                                                        ?>
                                                        
                                                        <br/>
                                                        File Upload:
                                                        <input type="file" name="custmr_edit_file_upload[]" class="form-control" id="Input_Attachments_id" multiple>
                                                        <input type="hidden" name="edit_custmr_old_val" id="edit_custmr_old_val_id" value="<?php echo $customer->attachments; ?>">
                                                        <br/>
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
            
            <div class="customers_edit_result_text"></div>

            <div class="edit-job-submit-cl">
                {!! Form::submit('Save Changes', ['class' => 'btn btn-success btn-edit-save', 'id'=>'edit_customer_id']) !!}
            </div>

            
            {!! Form::close() !!}

            <div class="row breadcrumbs-2">
                <?php
                    $next_customer = $customer->ID + 1;
                    $previous_customer = $customer->ID - 1;
                ?>
                <div class="col-md-6 breadcrumbs-2-prv">
                    <?php
                        if ( $customer->ID == 1 ) {
                            //do nothing
                        } else {
                            //display it
                    ?>
                            <a href="{{url('/customers/')}}/{{$previous_customer}}">
                                <i class="fa fa-arrow-left"></i>Previous Customer
                            </a>
                    <?php
                        }
                    ?>
                </div>
                <div class="col-md-6 breadcrumbs-2-nxt">
                    <a href="{{url('/customers/')}}/{{$next_customer}}">
                        Next Customer <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            @endforeach
            
        </div>
    </div>
    <!-- Content Wrapper END -->

@endsection