<?php
    use Illuminate\Support\Facades\Input;
    //if (!(Auth::check())) {
        //echo "MNot Loggedi in";
        //die();
        //return redirect('home');
    // } else {
    //     //do nothing
    // }
?>
@extends('layouts.app')

@section('content')
<body>
    <div class="app">
        <div class="layout">
            
            @include('sidebar')

            @include('header')

                <!-- Content Wrapper START -->
                <div class="main-content">
                    <div class="container-fluid">
                        <div class="page-title">
                            
                            <h1 style="text-align: center;">All Contractors</h1>

                            <div class="breadcrumbs">
                                <div class="fa fa-hand-o-right"></div> 
                                You are here: 
                                <a href="{{url('/')}}">Home </a>
                                    >
                                <a href="{{url('/contractors/')}}">All Contractors</a>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-3 card sidebar-card">
                                @include('contractor_views/contractor_sidebar')
                            </div>

                            <?php
                                // var_dump($contractor);
                                // die();
                            ?>
                           
                            

                            <div class="col-md-9">
                                <div class="card">
                                    <div class="card-block">
                                        <div class="bulk_email_box" id="bulk_email_box_id">
                                            <button class="btn btn-warning" id="add-selected-emails-id">Add Selected Emails</button>
                                            <div class="response_msg_0"></div>
                                            <?php
                                            echo Form::open(array('url'=>'contractors/sendbulkemail/', 'files'=>true, 'method'=>'GET', 'id'=>'bulk_email_contractor_form_id'));
                                            ?> 
                                                <input type="hidden" id="bulk_email_contractor_form_id_url" value="{{url('/contractors/sendbulkemail/')}}/">
                                                <label for="bulk_email_emails_id">Emails:</label>
                                                <textarea name="bulk_email_emails" id="bulk_email_emails_id" class="form-control bulk_email_emails_cl"></textarea>
                                                <br/>
                                                <label for="bulk_email_textarea_id">Message:</label>
                                                <textarea name="bulk_email_textarea" id="bulk_email_textarea_id" class="form-control bulk_email_textarea_cl"></textarea>
                                                <br/>
                                                <input type="submit" name="bulk_email_submit" class="btn btn-success btn-send-email" value="Send Email">
                                            </form>
                                        </div>
                                        <button class="btn btn-success" id="send-bulk-email-id-show">Click Here To Show Bulk Email Form</button>
                                        <button class="btn btn-danger" id="send-bulk-email-id-hide">Click Here To Hide Bulk Email Form</button>

                                        <div class="row">
                                            <div class="col-md-5 col-xs-12">
                                                <div class="pgnation-1">
                                                    Showing {{$get_showing_start_at}} to {{$get_showing_end_at}} of {{$total_number_of_entries}} entries
                                                </div>
                                            </div>
                                            <div class="col-md-7 col-xs-12">
                                                <?php
                                                    $query = htmlspecialchars(trim(stripcslashes(Input::get('s_city'))));
                                                    $main_url = url('/contractors/searchbycity?s_city=') . $query . "&pg=";
                                                    $prev_pg_url = $main_url . $get_previous_page_number;
                                                    $next_pg_url = $main_url . $get_next_page_number;
                                                ?>
                                                <div class="flt1a">
                                                    <a class="btn btn-default" href="<?php echo $prev_pg_url; ?>"> <i class="fa fa-arrow-left"></i> Previous</a>
                                                    Page {{$get_current_page_number}}
                                                    | {{$get_no_of_pages_left}} Pages(s) Left
                                                    <a class="btn btn-default" 
                                                        href="<?php echo $next_pg_url; ?>">
                                                        Next <i class="fa fa-arrow-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- start list of all contractors loop-->
                                            @foreach ($contractors as $contractor)
                                        <!-- start single contractor row -->
                                        <div class="card single-contractor-loop-card">
                                            <div class="card-heading card-heading-2">
                                                <div class="bulk-select-checkbox">
                                                    <input type="checkbox" name="contractor_check_box" id="contractor_check_box_id" value="contractor_check_box_value_{{$contractor->ID}}" data-value="contractor_check_box_value_{{$contractor->ID}}" data-email="<?php echo str_replace("'", "", $contractor->Con_E_mail_Address); ?>">
                                                </div>
                                                Contractor Name: <h4 class="card-title card-title-2"><a href="{{url('/contractors/')}}/{{$contractor->ID}}">
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
                                                </a></h4> 
                                                


                                            </div>
                                            <div class="card-body card-body-2">
                                                <div class="row single-job-row-1">

                                                    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                                                        Contractor ID: <b><a href="{{url('/contractors/')}}/{{$contractor->ID}}">{{ $contractor->ID }}</a></b>
                                                        
                                                        <br/>
                                                        DBA Name: 
                                                        <b>
                                                            <?php echo removeQuotes($contractor->Con_DBA); ?>
                                                        </b>

                                                        <br/>
                                                        Street Address 1: 
                                                        <b>
                                                            <?php echo removeQuotes($contractor->Con_Street_Address_1); ?>
                                                        </b>

                                                        <br/>
                                                        Street Address 2: 
                                                        <b>
                                                            <?php echo removeQuotes($contractor->Con_Street_Address_2); ?>
                                                        </b>

                                                        <br/>
                                                        City: 
                                                        <b>
                                                            <?php echo removeQuotes($contractor->Con_City); ?>
                                                        </b>

                                                        <br/>
                                                        State: 
                                                        <b>
                                                            <?php echo removeQuotes($contractor->Con_State); ?>
                                                        </b>

                                                        &nbsp; | &nbsp;

                                                        Zip Code: 
                                                        <b>
                                                            <?php echo removeQuotes($contractor->Con_Zip); ?>
                                                        </b>

                                                        &nbsp; | &nbsp;
                                                        County: 
                                                        <b>
                                                            <?php echo removeQuotes($contractor->Con_County); ?>
                                                        </b>

                                                        <br/>
                                                        Home Phone Number: 
                                                        <b>
                                                            <?php echo removeQuotes($contractor->Con_Home_Phone); ?>
                                                        </b>

                                                        <br/>
                                                        Fax: 
                                                        <b>
                                                            <?php echo removeQuotes($contractor->Con_Fax_Phone); ?>
                                                        </b>

                                                        <br/>
                                                        Cell Phone: 
                                                        <b><a href="tel:<?php echo removeQuotes($contractor->Con_Cell_Phone); ?>">
                                                            <?php echo removeQuotes($contractor->Con_Cell_Phone); ?>
                                                        </a></b>

                                                        <br/>
                                                        Language 1: 
                                                        <b>
                                                            <?php echo removeQuotes($contractor->Con_Language_1); ?>
                                                        </b>

                                                        

                                                    </div>    
                                                    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                                                        
                                                        Email Address: 
                                                        <b>
                                                            <a target="_blank" href="mailto:<?php echo removeQuotes($contractor->Con_E_mail_Address);?>?subject=Language Link Inquiry About Job"><?php echo removeQuotes($contractor->Con_E_mail_Address);?></a>
                                                        </b>

                                                        <br/>
                                                        Website: 
                                                        <b>
                                                            <?php echo removeQuotes($contractor->Con_Website); ?>
                                                        </b>

                                                        <br/>
                                                        Skype: 
                                                        <b>
                                                            <?php echo removeQuotes($contractor->Con_Skype); ?>
                                                        </b>

                                                        <br/>
                                                        SSN: 
                                                        <b>
                                                            <?php echo removeQuotes($contractor->Con_SSN); ?>
                                                        </b>

                                                        <br/>
                                                        TaxID: 
                                                        <b>
                                                            <?php echo removeQuotes($contractor->Con_TaxID); ?>
                                                        </b>

                                                        <br/>
                                                        Birthdate: 
                                                        <b>
                                                            <?php echo setDateValueInViewPretty($contractor->Con_Birthdate); ?>
                                                        </b>

                                                        <br/>
                                                        Sex: 
                                                        <b>
                                                            <?php echo removeQuotes($contractor->Con_Sex); ?>
                                                        </b>

                                                        <br/>
                                                        Originating Country: 
                                                        <b>
                                                            <?php echo removeQuotes($contractor->Con_Originating_Country); ?>
                                                        </b>

                                                        <br/>
                                                        Immigration Status: 
                                                        <b>
                                                            <?php echo removeQuotes($contractor->Con_USA_Immigration_Status); ?>
                                                        </b>

                                                        <br/>
                                                        Contractor An Agency?
                                                        <b>
                                                            <?php echo removeQuotes($contractor->Con_Agency_YesNo); ?>
                                                        </b>

                                                    </div>    
                                                </div>

                                                <div class="row single-job-row-2">
                                                    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                                                        
                                                    </div>  
                                                    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                                                       
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="card-footer border top">
                                                <ul class="list-unstyled list-inline text-right pdd-vertical-5">
                                                    <!-- <li>
                                                        <div class="contractors_delete_result_text"></div>
                                                    </li> -->
                                                    <li class="list-inline-item">
                                                        <a href="{{url('/contractors/')}}/{{$contractor->ID}}" class="btn btn-flat btn-view-cl"> 
                                                            <i class="fa fa-eye"></i> View
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a href="{{url('/contractors/edit')}}/{{$contractor->ID}}" class="btn btn-flat btn-edit-cl"> 
                                                            <i class="fa fa-pencil"></i> Edit
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <?php

                                                        if ( Auth::user()->is_admin == 1) {
                                                            echo Form::open(array('url'=>'contractors/delete/'.$contractor->ID, 'method'=>'PUT', 'id'=>'delete_contractors_form_id'))
                                                        ?>
                                                            <input type="hidden" name="get_the_id" value="<?php echo $contractor->ID; ?>">
                                                            <input 
                                                            type="submit" 
                                                            class="btn btn-flat btn-delete-cl"
                                                            id="delete_single_contractor" value="DELETE">
                                                        
                                                        <?php
                                                            }
                                                        ?>

                                                        {!! Form::close() !!}

                                                        
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>                                       
                                        <!-- end single contractor row -->

                                        @endforeach

                                        <div class="row">
                                            <div class="col-md-5 col-xs-12">
                                                <div class="pgnation-1">
                                                    Showing {{$get_showing_start_at}} to {{$get_showing_end_at}} of {{$total_number_of_entries}} entries
                                                </div>
                                            </div>
                                            <div class="col-md-7 col-xs-12">
                                                <?php
                                                    $query = htmlspecialchars(trim(stripcslashes(Input::get('s_city'))));
                                                    $main_url = url('/contractors/searchbycity?s_city=') . $query . "&pg=";
                                                    $prev_pg_url = $main_url . $get_previous_page_number;
                                                    $next_pg_url = $main_url . $get_next_page_number;
                                                ?>
                                                <div class="flt1a">
                                                    <a class="btn btn-default" href="<?php echo $prev_pg_url; ?>"> <i class="fa fa-arrow-left"></i> Previous</a>
                                                    Page {{$get_current_page_number}}
                                                    | {{$get_no_of_pages_left}} Pages(s) Left
                                                    <a class="btn btn-default" 
                                                        href="<?php echo $next_pg_url; ?>">
                                                        Next <i class="fa fa-arrow-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- end list of all contractors loop -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Content Wrapper END -->
@endsection
