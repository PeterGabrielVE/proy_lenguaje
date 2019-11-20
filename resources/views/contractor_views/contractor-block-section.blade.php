<div class="card single-contractor-loop-card">
    <div class="card-heading card-heading-2">
        <div class="bulk-select-checkbox">
            <input type="checkbox" name="contractor_check_box" id="contractor_check_box_id" value="contractor_check_box_value_{{$contractor->ID}}" data-value="contractor_check_box_value_{{$contractor->ID}}" data-email="<?php echo str_replace("'", "", $contractor->Con_E_mail_Address); ?>">
        </div>
        Contractor Name: <h4 class="card-title card-title-2"><a href="{{url('/contractors/')}}/{{$contractor->ID}}"><?php 
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
            ?></a></h4> 
        


    </div>
    <div class="card-body card-body-2">
        <div class="row single-job-row-1">

            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                Contractor ID: <b><a href="{{url('/contractors/')}}/{{$contractor->ID}}">LLCTR{{ $contractor->ID }}</a></b>
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
                    <?php echo processStateWithAbb($contractor->Con_State); ?>
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
            </div>    
            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                Language 1: 
                <b>
                    <?php echo removeQuotes($contractor->Con_Language_1); ?>
                </b>
                <br/>
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
                    echo Form::open(array('url'=>'contractors/delete/'.$contractor->ID, 'method'=>'PUT', 'id'=>'delete_contractors_form_id'));
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