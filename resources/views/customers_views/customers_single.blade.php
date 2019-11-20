@extends('layouts.app')

@section('content')
            
    @include('sidebar')

    @include('header')

    <!-- Content Wrapper START -->
    <div class="main-content">
        <div class="container-fluid">
        
            <?php
                // if the array returns no value
                if ( count($customers) <= 0 ){
            ?>                    
                <div class='page-title'>
                    <h1 class='crd-job-single'>
                        No Customer To Display
                    </h1>
                    <h3 style="text-align: center;">
                        <a href="{{url('/')}}">Return Home</a>    
                    </h3>                            
                </div>
            <?php
                }
            ?>

            @foreach ($customers as $customer)
        
            
            <div class="page-title">

                <h1 class="crd-job-single">
                    <?php 
                        if ( 

                               (strlen($customer->Cus_Company_Name) <= 0 )
                            ){
                            echo "<span class='empty-job-name'><i class='fa fa-meh-o'></i> Empty Customer Name</span>";
                        } else {
                            echo removeQuotes($customer->Cus_Company_Name);

                        }
                    ?>
                </h1>

                <div class="breadcrumbs">
                    <div class="fa fa-hand-o-right"></div> 
                    You are here: 
                    <a href="{{url('/')}}">Home </a>
                        >
                    <a href="{{url('/customers/')}}">All Customers</a>
                        >
                    <a href="{{url('/customer/')}}/{{$customer->ID}}">Viewing Single Customer</a>
                </div>

            </div>

            <div class="row">
                <div class="col-md-3 card sidebar-card">
                    @include('customers_views/customers_sidebar')
                </div>
                <div class="col-md-9">
                    <!-- start displaying customer details here -->
                    
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                            <div class="card">
                                <div class="card-heading border bottom">
                                    <h4 class="card-title crd-brdr">Customer Details 1<i class="fa fa-user-times"></i></h4>
                                    <div class="row crd-job-details">
                                        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                                        <!-- <div class="col-md-6 col-xs-12 col-sm-12 col-lg-6"> -->
                                            <ul class="job-details-ul">
                                                <?php returnTextForModelSingleView("Customer ID", $customer->ID); ?>
                                                <?php returnTextForModelSingleView("Requester Name", $customer->Cus_First_Name); ?>
                                                <?php returnTextForModelSingleView("Customer Middle State", $customer->Cus_Middle_Name); ?>
                                                <?php returnTextForModelSingleView("LL Rep", $customer->Cus_Last_Name); ?>
                                                <?php returnTextForModelSingleView("Customer Company Name", $customer->Cus_Company_Name); ?>
                                                <?php returnTextForModelSingleView("Customer Billing Street Address 1", $customer->Cus_Billing_Street_Address_1); ?>
                                                <?php returnTextForModelSingleView("Customer Billing Street Address 2", $customer->Cus_Billing_Street_Address_2); ?>
                                                <?php returnTextForModelSingleView("Customer Billing City", $customer->Cus_Billing_City); ?>
                                                <?php returnTextForModelSingleView("Customer Billing State", $customer->Cus_Billing_State); ?>
                                                <?php returnTextForModelSingleView("Customer Billing Zip", $customer->Cus_Billing_Zip); ?>
                                               
                                                
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
                                    <h4 class="card-title crd-brdr">Customer Details 2 <i class="fa fa-user-times"></i></h4>
                                    <div class="row crd-job-details">
                                        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                                            <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                                                <ul class="job-details-ul">
                                                     <?php returnTextForModelSingleView("Customer Notes", $customer->Cus_Notes); ?>
                                                <?php returnTextForModelSingleView("Customer Billing Notes", $customer->Cus_Billing_Notes); ?>
                                                <?php returnTextForModelSingleView("Service", $customer->Cus_Service); ?>
                                                <?php returnTextForModelSingleView("Attachments", $customer->Cus_Attachments); ?>
                                                <?php returnTextForModelSingleView("Billing Term", $customer->Cus_Billing_Term); ?>
                                                <?php returnTextForModelSingleView("Phone Number", $customer->Cus_Phone_Number); ?>
                                                <?php returnTextForModelSingleView("Fax Number", $customer->Cus_Fax_Number); ?>
                                                <?php returnTextForModelSingleView("Other Phone", $customer->Cus_Phone_Other); ?>
                                                <?php returnTextForModelSingleView("WebSite", $customer->Cus_WebSite); ?>
                                                <?php returnTextForModelSingleView("Requester E-Mail Address", $customer->Cus_Email_Address); ?>
                                                <?php returnTextForModelSingleView("Customer LL Wiki", $customer->Cus_LL_Wiki); ?>
                                                <li>
                                                    <div class="single_job_view_img_cl_title">Attachment</div>
                                                    <?php 
                                                        processEchoFiles2($customer->attachments, false);
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
                        <div class="col-md-2 col-lg-2 col-xs-12 col-sm-12"></div>
                        <div class="col-md-8 col-lg-8 col-xs-12 col-sm-12">
                            <div class="card">
                                <div class="card-heading border bottom">
                                    <h4 class="card-title crd-brdr">Rate</h4>
                                    <div class="row crd-job-details">
                                        <?php
                                            $service_rates = getServiceRatesUsingIDOnly($customer->ID);
                                            echo "<table class='table table-striped'>";
                                                echo "<thead class='thead-dark'>";
                                                    echo "
                                                    <tr>
                                                        <td>ID</td>
                                                        <td>Name</td>
                                                        <td>Type</td>
                                                        <td>Rate($)</td>
                                                        <td>State</td>
                                                        <td>Actions</td>
                                                    </tr>
                                                    ";
                                                echo "</thead>";
                                            for ($i=0; $i < count($service_rates); $i++) { 
                                                echo "
                                                <tr>
                                                    <td>
                                                        <a target='_blank' href=".url('/')."/services/".$service_rates[$i]['ID'].">". $service_rates[$i]['ID']."</a>
                                                    </td>
                                                    <td>
                                                        <a target='_blank' href=".url('/')."/services/".$service_rates[$i]['ID'].">". $service_rates[$i]['Service_Name']."</a>
                                                    </td>
                                                    <td>". $service_rates[$i]['Service_Type'] ."</td>
                                                    <td>$". $service_rates[$i]['Service_Rate'] ."</td>
                                                    <td>". $service_rates[$i]['Service_State'] ."</td>
                                                    <td>
                                                        <a target='_blank' href=".url('/')."/services/edit/".$service_rates[$i]['ID']."><i class='fa fa-pencil'></i></a> | <a target='_blank' href=".url('/')."/services/".$service_rates[$i]['ID']."><i class='fa fa-eye'></i></a>
                                                    </td>
                                                </tr>
                                                ";
                                            }
                                            echo "</table>";
                                            echo "<div class='btn btn-default' style='margin:0 auto 20px;'><a target='_blank' href=".url('/')."/services/create>Add New Service</a></div>";
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-lg-2 col-xs-12 col-sm-12"></div>
                    </div>
                    <!-- end displaying customer details here -->
                </div>
            </div>

            <div class="single-job-edit">
                <ul class="list-unstyled list-inline text-right pdd-vertical-5">
                    <li class="list-inline-item">
                        <a href="{{url('/customers/edit')}}/{{$customer->ID}}" class="btn btn-flat btn-edit-cl"> 
                            <i class="fa fa-pencil"></i> Click Here To Edit Customer
                        </a>
                    </li>
                </ul>
            </div>

            <div class="row breadcrumbs-2">
                <?php
                    $next_con = $customer->ID + 1;
                    $previous_con = $customer->ID - 1;
                ?>
                <div class="col-md-6 breadcrumbs-2-prv">
                    <?php
                        if ( $customer->ID == 1 ) {
                            //do nothing
                        } else {
                            //display it
                    ?>
                            <a href="{{url('/customers/')}}/{{$previous_con}}">
                                <i class="fa fa-arrow-left"></i> Previous Customer
                            </a>
                    <?php
                        }
                    ?>
                </div>
                <div class="col-md-6 breadcrumbs-2-nxt">
                    <a href="{{url('/customers/')}}/{{$next_con}}">
                        Next Customer <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            
            @endforeach

        </div>
    </div>
    <!-- Content Wrapper END -->

@endsection