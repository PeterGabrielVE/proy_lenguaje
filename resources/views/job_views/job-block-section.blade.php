<div class="card">
    <div class="card-heading card-heading-2">
         Name: <h4 class="card-title card-title-2"><a href="{{url('/jobs/')}}/{{$job->ID}}">
            <?php 
                if ( strlen($job->Jobs_Job_Name) <= 0 ){
                    echo "<span class='empty-job-name'><i class='fa fa-meh-o'></i> Empty Job Name</span>";
                } else {
                    echo removeQuotes( $job->Jobs_Job_Name);
                }
            ?>
        </a></h4>
    </div>
    <div class="card-body card-body-2">
        <div class="row single-job-row-1">
            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                ID: <b> LLJB{{ $job->ID }} </b> | 
                Status: <b>
                    <?php
                        echo removeQuotes( $job->Jobs_Status);
                    ?>
                </b>
                <br/>
                Request Date: 
                    <b>
                        
                        <?php 
                        echo setDateValueInViewPretty($job->Job_Request_Date);
                        ?>
                    </b>
                <br/>
                Type:  <b>
                    <?php
                        echo removeQuotes( $job->Jobs_Type );
                    ?>
                </b>
                <br/>
                Service Name: 
                <b>
                    <?php
                        echo removeQuotes( $job->Jobs_Service_Name );
                    ?>
                </b>
            </div>    
            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                Start Time: 
                <b>
                    <?php
                        echo setDateValueInViewPretty( $job->Jobs_Start_Time );
                    ?>
                </b>
                <br/>
                End Time: 
                <b>
                    <?php
                        echo setDateValueInViewPretty( $job->Jobs_End_Time );
                    ?>
                </b>
                <br/>
                Service Type: 
                <b>
                    <?php
                        echo removeQuotes( $job->Jobs_Service_Type );
                    ?>
                </b>
                <br/>
                Language: 
                <b>
                    <?php
                        echo removeQuotes( $job->Jobs_Language_Requested );
                    ?>
                </b>
            </div>    
        </div>

        <div class="row single-job-row-2">
            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                Customer Number: 
                <b>
                    <?php
                        echo removeQuotes( $job->Jobs_Customers_Cus_Number );
                    ?>
                </b>
                <br/>
                Customer Company: 
                <b>
                    <?php
                        echo removeQuotes( $job->Jobs_Customers_Company );
                    ?>
                </b>
                <br/>
                Assigment Location: 
                <b>
                    <?php
                        echo removeQuotes( $job->Jobs_Assignment_Location );
                    ?>
                </b>
                <br/>
                Contact Person: 
                <b>
                    <?php
                        echo removeQuotes( $job->Jobs_Assignment_Contact_Person );
                    ?>
                </b>
                <br/>
                LEP(Limited English Personnel) Name: 
                <b>
                    <?php
                        echo removeQuotes( $job->Jobs_LEP_Name );
                    ?>
                </b>
            </div>  
            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                Contractor ID: 
                <b>
                    <?php
                        $g_ctractor_id = processContractorID($job->Jobs_Contractor_ID, $job->Jobs_Contractor_Email);

                        if ( intval($g_ctractor_id) && is_numeric($g_ctractor_id) && (intval($g_ctractor_id) > 0) ){
                            echo "<a target='_blank' href='".url('/contractors/'). "/" . $g_ctractor_id . "'>". "LLCTR".$g_ctractor_id ."</a>";

                        } else {
                            echo $g_ctractor_id;
                        }
                    ?>
                </b>
                <br/>
                Contractor First Name: 
                <b>
                    <?php
                        echo removeQuotes( $job->Jobs_Contractor_First_Name );
                    ?>
                </b>
                <br/>
                Contractor Last Name: 
                <b>
                    <?php
                        echo removeQuotes( $job->Jobs_Contractor_Last_Name );
                    ?>
                </b>
                <br/>
                Language Requested: <b><?php
                        echo removeQuotes( $job->Jobs_Language_Requested);
                    ?></b>
                <br/>
                City: <b><?php echo removeQuotes( $job->Jobs_Assignment_City); ?></b> <br/>
                Zip Code: <b><?php echo removeQuotes( $job->Jobs_Assignment_Zip); ?></b> <br/>
                State: <b><?php echo processStateWithAbb($job->Jobs_Assignment_State); ?></b>

                <br/>
                Job Notes: 
                <b>
                    <?php
                        echo removeQuotes( $job->Jobs_Notes );
                    ?>
                </b>
            </div>

        </div>
    </div>
    <div class="card-footer border top">
        <ul class="list-unstyled list-inline text-right pdd-vertical-5">
            <li class="list-inline-item">
                <a href="{{url('/jobs/')}}/{{$job->ID}}" class="btn btn-flat btn-view-cl"> 
                    <i class="fa fa-eye"></i> View
                </a>
            </li>
            <li class="list-inline-item">
                <a href="{{url('/jobs/edit')}}/{{$job->ID}}" class="btn btn-flat btn-edit-cl"> 
                    <i class="fa fa-pencil"></i> Edit
                </a>
            </li>
            <?php        
            if ( Auth::user()->is_admin == 1) {
            ?>
                <li class="list-inline-item">
                    <?php
                        echo Form::open(array('url'=>'jobs/delete/'.$job->ID, 'method'=>'PUT', 'id'=>'delete_job_form_id'))
                    ?>
                        <input type="hidden" name="get_the_id" value="<?php echo $job->ID; ?>">
                        <input 
                        type="submit" 
                        class="btn btn-flat btn-delete-cl"
                        id="delete_single_job" value="DELETE">
                    {!! Form::close() !!}
                </li>
            <?php        
            }
            ?>
        </ul>
    </div>
</div>